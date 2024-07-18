<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($guard === 'cat') {
                return redirect()->route('cat.home');
            } else {
                return redirect()->route('user.home');
            }
        }

        return $next($request);
    }
}
