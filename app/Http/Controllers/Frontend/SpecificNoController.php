<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecificNoController extends Controller
{
    public function show($id)
    {
        return view('frontend.specific-no', [
            'id' => $id
        ]);
    }
}
