<?php

namespace App\Http\Controllers\BackofficeAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackofficeLoginController extends Controller
{
    public function backofficeLogin()
    {
        return view('backoffice.auth.backoffice_login');
    } // End Method
}
