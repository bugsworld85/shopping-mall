<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyHasCapability
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * TODO:
         * This middleware supposedly overrides role permissions in case a specific permission was assigned to a user.
         */
        return $next($request);
    }
}
