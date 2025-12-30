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
                'id' => null,
                'reason' => 'Fine... yes. Just this once. (Nah, still no. uwu)'
            ]);
        }
        
        $reason = NoReason::inRandomOrder()->first(['id', 'reason']);

        return response()->json([
            'id' => $reason->id ?? null,
            'reason' => $reason->reason ?? 'No reasons available yet.'
        ]);
    }

    public function show($id)
    {
        $reason = NoReason::findOrFail($id);

        return response()->json([
            'id' => $reason->id,
            'reason' => $reason->reason
        ]);
    }

    /**
     * Count total No Reasons.
     */
    public function count()
    {
        return response()->json([
            'count' => NoReason::count()
        ]);
    }
}
