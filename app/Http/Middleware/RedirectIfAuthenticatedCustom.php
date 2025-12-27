<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::check() && Auth::user()->role == 'user') {
                    return redirect('/dashboard');
                }
                // if you had another roles put it here
                if (Auth::check() && Auth::user()->role == 'admin') {
                    return redirect('/backoffice/dashboard');
                }
            }
        }
        return $next($request);
    }
}
