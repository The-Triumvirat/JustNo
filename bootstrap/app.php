<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use App\Http\Middleware\Role;
use App\Http\Middleware\BackofficeAuth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => Role::class,
            'auth' => BackofficeAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TooManyRequestsHttpException $e, $request) {
        
        $messages = [
            "Woah… slow down",
            "You're trying a bit *too* hard",
            "Even No needs a cooldown.",
            "Veyon says no",
            "Kaiya and Abynox think that's too much",
        ];

        return response()->json([
            'reason' => $messages[array_rand($messages)],
            'retry_after' => $e->getHeaders()['Retry-After'] ?? 60,
        ], 429);
    });
    })->create();
