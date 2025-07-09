<?php

namespace App\Http\Controllers\Auth;

use session;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\LoginNotification;
use RealRashid\SweetAlert\Facades\Alert;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        // If the user has 2FA enabled but hasn't verified it yet
        if ($user->two_factor_secret && !$user->hasVerifiedTwoFactor()) {
            // Redirect to the 2FA setup/verification page
            return redirect()->route('2fa.setup'); // Ensure this route exists
        }

        // Get IP and location
        $ip = $request->ip();
        $location = $this->getUserLocation($ip);

        // Send notification
        $user->notify(new LoginNotification($location));

        $message = 'Welcome, ' . $user->name . '! You have successfully logged in.';

        // Flash for Livewire or Blade-based alerts
        session()->flash('message', $message);

        // SweetAlert UI
        Alert::html('Welcome, ' . $user->name . '!', '<p>You have successfully logged in.</p>', 'success')
            ->showConfirmButton('Cool');

        // Role-based redirects
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('program-manager')) {
            return redirect()->route('pm.dashboard');
        } elseif ($user->hasRole('support')) {
            return redirect()->route('care.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }


    // protected function getUserLocation($ip)
    // {
    //     $key = env('IPSTACK_KEY');
    //     $response = Http::get("https://api.ipstack.com/{$ip}?access_key={$key}");

    //     if ($response->ok()) {
    //         $data = $response->json();
    //         $city = $data['city'] ?? 'Unknown City';
    //         $region = $data['region_name'] ?? 'Unknown Region';
    //         $country = $data['country_name'] ?? 'Unknown Country';
    //         $time = Carbon::now()->toDayDateTimeString();

    //         return "{$time} from {$city}, {$region}, {$country}";
    //     }

    //     return Carbon::now()->toDayDateTimeString() . " from Unknown Location";
    // }

    // For Testing
    protected function getUserLocation($ip)
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return Carbon::now()->toDayDateTimeString() . " from Localhost";
        }

        $key = env('IPSTACK_KEY');
        $response = Http::withoutVerifying()->get("https://api.ipstack.com/{$ip}?access_key={$key}");

        if ($response->ok()) {
            $data = $response->json();
            $city = $data['city'] ?? 'Unknown City';
            $region = $data['region_name'] ?? 'Unknown Region';
            $country = $data['country_name'] ?? 'Unknown Country';
            $time = Carbon::now()->toDayDateTimeString();

            return "{$time} from {$city}, {$region}, {$country}";
        }

        return Carbon::now()->toDayDateTimeString() . " from Unknown Location";
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🔥 Flash for Livewire support
        session()->flash('message', 'You have been logged out.');

        // 🎉 SweetAlert
        Alert::html('Logout Successful!', '<p>You have successfully logged out.</p>', 'success')
            ->showConfirmButton('Cool');

        return redirect('/');
    }
}
