<?php

namespace App\Http\Controllers\Auth;

use session;
use RobThree\Auth\TwoFactorAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA setup page and generate the QR code.
     */
    public function show2FASetup()
    {
        // Create a new instance of TwoFactorAuth class
        $tfa = new TwoFactorAuth(env('APP_NAME'));  // This can be your application name

        // Get the currently authenticated user
        $user = Auth::user();

        // Generate a new 2FA secret
        $secret = $tfa->createSecret();

        // Save the secret to the session (or the database if you want to persist it)
        session(['2fa_secret' => $secret]);

        // Generate the QR code image data URI
        $qrCode = $tfa->getQRCodeImageAsDataUri($user->email, $secret);

        // Return the view with the QR code and setup instructions
        return view('auth.2fa-setup', compact('qrCode'));
    }

    public function verify2FA(Request $request)
    {
        $tfa = new TwoFactorAuth(env('APP_NAME'));
        $user = Auth::user();
        $secret = session('2fa_secret');

        // Validate the code entered by the user
        $valid = $tfa->verifyCode($secret, $request->input('code'));

        if ($valid) {
            // Save the secret in the user's database record
            $user->two_factor_enabled = true;
            $user->two_factor_secret = $secret;
            $user->save();

            $message = 'Status, ' . $user->name . '2FA has been enabled.';

             // 🔥 Flash for Livewire or Blade-based alerts
            session()->flash('message', $message);

            if($user->hasRole('admin')) {
                return redirect()->route(route: 'admin.dashboard');
            } elseif ($user->hasRole('program-manager')){
                return redirect()->route(route: 'pm.dashboard');
            } elseif($user->hasRole('care-support')) {
                return redirect()->route(route: 'care.dashboard');
            }
        } else {
            return back()->withErrors(['code' => 'Invalid code, please try again.']);
        }
    }

}