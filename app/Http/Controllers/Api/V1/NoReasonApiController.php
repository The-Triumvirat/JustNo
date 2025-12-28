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
        // 1% Easter Egg Chance
        if (rand(1, 100) === 1) {
            return response()->json([
                'reason' => 'Fine... yes. Just this once. (Nah, still no. uwu)'
            ]);
        }
        
        $reason = NoReason::inRandomOrder()->value('reason');

        return response()->json([
            'reason' => $reason ?? 'No reasons available yet.'
        ]);
    }
}
