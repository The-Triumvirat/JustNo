<?php

namespace App\Http\Controllers\BackofficeUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class BackofficeChangePasswordController extends Controller
{
    public function backofficeChangePassword(): View
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backoffice.profile.backoffice_change_password', compact('profileData'));
    } // End Method

    public function backofficePasswordUpdate(ChangePasswordRequest $request): RedirectResponse
    {
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->validated('new_password'))
        ]);

        return back()->with('success', 'Password changed successfully.');
    } // End Method
}
