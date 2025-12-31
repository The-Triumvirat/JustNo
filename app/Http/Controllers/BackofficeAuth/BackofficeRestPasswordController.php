<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class BackofficeRestPasswordController extends Controller
{
    public function backofficeResetPassword(Request $request)
    {
        return view('backoffice.auth.backoffice_reset_password', ['request' => $request]);
    } // End Method
}
