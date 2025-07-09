<?php

namespace App\Http\Controllers\Auth;

use session;
use RobThree\Auth\TwoFactorAuth;
use App\Providers\GdQrCodeProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RobThree\Auth\Providers\Qr\BaconQrCodeProvider;
use RobThree\Auth\Providers\Qr\IQRCodeProvider;


class TwoFactorController extends Controller
{
    /**
     * Show the 2FA setup page and generate the QR code.
     */
    public function show2FASetup()
    {
        $qrProvider = new BaconQrCodeProvider(); // or new GdQrCodeProvider();
        $tfa = new TwoFactorAuth($qrProvider, env('APP_NAME'));

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $secret = $tfa->createSecret();
        session(['2fa_secret' => $secret]);

        $qrCode = $tfa->getQRCodeImageAsDataUri($user->email, $secret);

        return view('auth.2fa-setup', compact('qrCode'));
    }

    public function verify2FACode(Request $request)
    {
        $qrProvider = new BaconQrCodeProvider(); // or your own GdQrCodeProvider
        $tfa = new TwoFactorAuth($qrProvider, env('APP_NAME'));

        $user = Auth::user();
        $secret = session('2fa_secret');

        $valid = $tfa->verifyCode($secret, $request->input('code'));

        if ($valid) {
            $user->update([
                'two_factor_secret' => $secret,
                'two_factor_enabled' => true,
                'two_factor_verified_at' => now(),
            ]);

            session()->forget('2fa_secret');

            return redirect()->route('dashboard')->with('message', '2FA successfully verified.');
        }

        return back()->withErrors(['code' => 'Invalid code. Please try again.']);
    }


}
