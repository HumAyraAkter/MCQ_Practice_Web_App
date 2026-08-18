<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPremium
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isPremium()) {
            abort(403, 'This is a premium feature. Please subscribe.');
        }

        return $next($request);
    }
}