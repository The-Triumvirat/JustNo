<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackofficeLogoutController extends Controller
{
    public function backofficeLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Backoffice Logout Successfully',
            'alert-type' => 'success'
        ); 
        
        return redirect('/backoffice/login')->with($notification);
    } // End Method
}
