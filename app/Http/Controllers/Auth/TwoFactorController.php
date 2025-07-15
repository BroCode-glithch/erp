<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use RobThree\Auth\TwoFactorAuth;
use App\Providers\GdQrCodeProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use RobThree\Auth\Providers\Qr\IQRCodeProvider;
use RobThree\Auth\Providers\Qr\BaconQrCodeProvider;


class TwoFactorController extends Controller
{
    /**
     * Show the 2FA setup page and generate the QR code.
     */
    public function show2FASetup()
    {
        // Use the BaconQrCodeProvider or GdQrCodeProvider for QR code generation
        $qrProvider = new BaconQrCodeProvider(); // or new GdQrCodeProvider();
        $tfa = new TwoFactorAuth($qrProvider, env('APP_NAME'));

        // Get the authenticated user
        $user = Auth::user();

        // If the user is not authenticated, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }

        // Generate a new secret for the user
        // Store the secret in the session for later verification
        $secret = $tfa->createSecret();
        session(['2fa_secret' => $secret]);

        // Generate the QR code image data URI
        $qrCode = $tfa->getQRCodeImageAsDataUri($user->email, $secret);

        // Return the 2FA setup view with the QR code
        return view('auth.2fa-setup', compact('qrCode'));
    }

    public function verify2FACode(Request $request)
    {
        // Validate the 2FA code input
        $qrProvider = new BaconQrCodeProvider(); // or your own GdQrCodeProvider
        $tfa = new TwoFactorAuth($qrProvider, env('APP_NAME'));

        // Validate the request input
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Retrieve the secret from the session
        if (!session()->has('2fa_secret')) {
            // If the secret is not found in the session, redirect to the setup page
            Session::flash('error', '2FA secret not found. Please set up 2FA first.');
            return redirect()->route('2fa.setup');
        }

        // Verify the 2FA code
        $secret = session('2fa_secret');

        // Check if the code is valid
        if (!$secret) {
            // If the secret is not found, return an error
            return back()->withErrors(['code' => '2FA secret not found. Please set up 2FA first.']);
        }

        // Verify the code using the secret
        $valid = $tfa->verifyCode($secret, $request->input('code'));

        // If the code is valid, update the user's 2FA settings
        // and redirect to the dashboard or desired page
        if ($valid) {
            $user->update([
                'two_factor_secret' => $secret,
                'two_factor_enabled' => true,
                'two_factor_verified_at' => now(),
            ]);

            session()->forget('2fa_secret');

            return redirect()->route('dashboard')->with('message', '2FA successfully verified.');
        }

        // If the code is invalid, return an error
        Session::flash('error', 'Invalid code. Please try again.');
        // Redirect back to the 2FA setup page
        return back()
            ;

    }


}
