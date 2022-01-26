<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidRequestException;
use Closure;
use Illuminate\Http\Request;

class OnlyAcceptsJson
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
        if (!$request->wantsJson()) {
            throw new InvalidRequestException();
        }
        return $next($request);
    }
}
