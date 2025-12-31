<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\NoReason;
use Carbon\Carbon;
use DB;

class BackofficeController extends Controller
{
    public function backofficeDashboard(): View
    {
        // Total Nos
        $totalNos = NoReason::count();

        // Nos today
        $nosToday = NoReason::whereDate('created_at', today())->count();

        // DB Check + Latenz
        $start = microtime(true);
        try {
            \DB::select('SELECT 1');
            $dbOk = true;
        } catch (\Throwable $e) {
            $dbOk = false;
        }
        $dbMs = round((microtime(true) - $start) * 1000);

        // Queue (minimal)
        try {
            $queueSize = \Queue::size('default');
            $queueStatus = $queueSize . ' jobs';
        } catch (\Throwable $e) {
            $queueStatus = 'not available';
        }

        // Last 10 Nos
        $lastNos = NoReason::orderByDesc('id')->limit(10)->get()->sortBy('id');

        return view('backoffice.index', compact('totalNos', 'nosToday', 'dbOk', 'dbMs', 'queueStatus', 'lastNos'));
    } // End Method
}
