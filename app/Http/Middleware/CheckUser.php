<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user()->pendingAuthTokens()->exists()) {
            return to_route('verify.token');
        }

        return $next($request);
    }
}
