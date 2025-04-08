<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated and if they have the correct role
        if (!Auth::check() || !$request->user()->hasRole($role)) {
            // If they don't have the role, abort with a 403 Forbidden response
            abort(403, 'Unauthorized');
        }

        return $next($request);  // Allow the request to continue if they have the role
    }
}
