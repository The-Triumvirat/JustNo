<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NoReasonApiController;
use App\Http\Controllers\Api\V1\StatusController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')
    ->middleware('throttle:justno')
    ->group(function () {
    Route::get('no', [NoReasonApiController::class, 'index']);
    Route::get('/no/count', [NoReasonApiController::class, 'count']);
    Route::get('/no/{id}', [NoReasonApiController::class, 'show']);

    Route::get('tea', function () {
        return response()->json([
            'id' => 42,
            'reason' => "Nope. I'm a teapot",
        ], 418);
    });

    Route::get('health', fn() =>
        response()->json(['status' => 'ok', 'mood' => 'still saying no to everything'])
    );

    Route::get('/status', [StatusController::class, 'index']);
});
