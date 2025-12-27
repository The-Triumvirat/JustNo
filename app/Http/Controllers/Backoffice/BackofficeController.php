<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function backofficeDashboard()
    {
        return view('backoffice.index');
    } // End Method
}
