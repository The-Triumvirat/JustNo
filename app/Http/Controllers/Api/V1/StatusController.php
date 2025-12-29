<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function index()
    {
        $db = 'ok';

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $e) {
            $db = 'error';
        }

        return response()->json([
            'service' => 'JustNo',
            'status' => 'ok',
            'version' => 'v1',
            'uptime' => now()->diffInSeconds(app()->make('startTime') ?? now()),
            'db' => $db,
            'time' => now()->toIso8601String()
        ]);
    }
}
