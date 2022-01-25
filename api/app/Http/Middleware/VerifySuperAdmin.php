<?php

namespace App\Http\Middleware;

use App\Exceptions\OnlySuperAdminException;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifySuperAdmin
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
        $userRoles = Auth::user()->userRoles;

        if ($userRoles->firstWhere('role_code', Role::SUPER_ADMIN)) {
            return $next($request);
        }
        throw new OnlySuperAdminException();
    }
}
