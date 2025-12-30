<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class BackofficeLoginController extends Controller
{
    public function backofficeLogin()
    {
        return view('backoffice.auth.backoffice_login');
    } // End Method

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $url = '';
        if($request->user()->role === 'admin'){
            $url = '/backoffice/dashboard';
        } 
        // if you had another roles put it here
        elseif($request->user()->role === 'user'){
            $url = '/dashboard';
        }

        $id = Auth::user()->id;
        $adminData = User::find($id);
        $username = $adminData->name;

        $notification = array(
            'message' => 'User ' . $username . ' Login Successfully',
            'alert-type' => 'info'
        );

        return redirect()->intended($url)->with($notification);
    }
}
