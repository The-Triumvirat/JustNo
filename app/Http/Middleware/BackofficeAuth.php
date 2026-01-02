<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class BackofficeAuth extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('backoffice.login');
        }

        return null;
    }
}
