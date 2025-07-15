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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if user has 2FA enabled and has a secret, but hasn't verified this session
        if (
            $user &&
            $user->two_factor_enabled &&
            $user->two_factor_secret &&
            !session()->has('2fa_verified')
        ) {
            // Redirect to the 2FA verification route
            return redirect()->route('2fa.verify'); // <-- Add this route
        }

        // If the user has verified 2FA or does not have it enabled, continue with the request
        if ($user && $user->two_factor_enabled && $user->two_factor_secret) {
            // Mark the session as verified
            session(['2fa_verified' => true]);
        } elseif ($user && !$user->two_factor_enabled) {
            // If the user does not have 2FA enabled, we can also consider the session verified
            session(['2fa_verified' => true]);
        }

        
        // Proceed with the request
        return $next($request);
    }
}
