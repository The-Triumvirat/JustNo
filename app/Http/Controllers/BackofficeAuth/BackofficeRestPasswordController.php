<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackofficeRestPasswordController extends Controller
{
    public function backofficeForgetPassword()
    {
        return view('backoffice.auth.backoffice_forgot_password');
    } // End Method

    public function backofficeResetPassword(Request $request)
    {
        return view('backoffice.auth.backoffice_reset_password', ['request' => $request]);
    } // End Method
}
