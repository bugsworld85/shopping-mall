<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAuthorizedException;
use Closure;
use Illuminate\Http\Request;

class AllowedRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRoles = $request->user()->getRoleNames();

        if ($userRoles->contains(function ($role) use ($roles) {
            return collect($roles)->contains($role);
        })) {
            return $next($request);
        }

        throw new NotAuthorizedException();
    }
}
