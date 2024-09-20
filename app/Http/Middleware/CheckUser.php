<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->route()->getName() === 'verify.token') {
            return $next($request);
        }

        if ($request->user()->pendingAuthTokens()->exists()) {
            return to_route('verify.token');
        }

        return $next($request);
    }
}
