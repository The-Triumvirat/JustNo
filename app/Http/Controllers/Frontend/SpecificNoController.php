<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpecificNoController extends Controller
{
    public function show($id): View
    {
        return view('frontend.specific-no', [
            'id' => $id
        ]);
    }
}
