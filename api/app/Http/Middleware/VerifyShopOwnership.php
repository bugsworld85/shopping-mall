<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedShopAccessException;
use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;

class VerifyShopOwnership
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
        if (!$request->user()->isOwner($request->route('shop'))) {
            throw new UnauthorizedShopAccessException();
        }
        return $next($request);
    }
}
