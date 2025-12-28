<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\Api\V1\NoReasonApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')
    ->middleware('throttle:justno')
    ->group(function () {
    Route::get('no', [NoReasonApiController::class, 'index']);

    Route::get('tea', function () {
        return response()->json([
            'message' => "Nope. I'm a teapot",
        ], 418);
    });

    Route::get('health', fn() =>
        response()->json(['status' => 'ok', 'mood' => 'still saying no to everything'])
    );
});
