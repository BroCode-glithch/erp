<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Validate the email verification request
        $request->fulfill();

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // If the email is not verified, mark it as verified
        // and fire the Verified event
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        

        
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
