<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoReason;

class NoReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noReasons = NoReason::all();
        return view('backoffice.no_reasons.index', compact('noReasons'));
    }
}
