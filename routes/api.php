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
});
