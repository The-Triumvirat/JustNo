<?php

namespace App\Http\Controllers\BackofficeUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\BackofficeProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BackofficeProfileController extends Controller
{
    public function backofficeProfile(): View
    {
        $profileData = User::find(Auth::id());

        return view('backoffice.profile.backoffice_profile_view', compact('profileData'));
    }

    public function backofficeProfileStore(BackofficeProfileRequest $request): RedirectResponse
    {
        $id = Auth::id();
        $validated = $request->validated();

        $data = User::findOrFail($id);
        $data->name = $validated['name'];
        $data->email = $validated['email'];
        $data->phone = $validated['phone'] ?? null;
        $data->address = $validated['address'] ?? null;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            File::delete(public_path('upload/profile_images/' . $data->photo));
            $filename = now()->format('YmdHis') . '_' . $file->hashName();
            $file->move(public_path('upload/profile_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
