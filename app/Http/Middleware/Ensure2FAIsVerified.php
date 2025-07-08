<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Ensure2FAIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if user has 2FA enabled and has a secret, but hasn't verified this session
        if (
            $user &&
            $user->two_factor_enabled &&
            $user->two_factor_secret &&
            !session()->has('2fa_verified')
        ) {
            return redirect()->route('2fa.verify'); // <-- Add this route
        }

        return $next($request);
    }
}
