<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirect if the request path is the root
        if ($request->is('/')) {
            return redirect('/login');
        }

        return $next($request);
    }
}

