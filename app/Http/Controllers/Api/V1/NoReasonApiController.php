<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoReason;

class NoReasonApiController extends Controller
{
    /**
     * Display a random No Reason.
     */
    public function index()
    {
        $reason = NoReason::inRandomOrder()->value('reason');

        return response()->json([
            'reason' => $reason ?? 'No reasons available yet.'
        ]);
    }
}
