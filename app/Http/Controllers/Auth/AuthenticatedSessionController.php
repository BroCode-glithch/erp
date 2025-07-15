<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
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
        // Return the login view
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
        // Regenerate the session to prevent session fixation attacks
        $request->session()->invalidate();
        // Regenerate the CSRF token
        $request->session()->regenerate();


        // Get the authenticated user
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
        Session::flash('message', $message);

        // Role-based redirects
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('program-manager')) {
            return redirect()->route('pm.dashboard');
        } elseif ($user->hasRole('support')) {
            return redirect()->route('care.dashboard');
        } else {
            return redirect()->back();
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
        // If the IP is localhost, return a simple message
        if ($ip === '127.0.0.1' || $ip === '::1') {
            // Return a message indicating the location is localhost
            return Carbon::now()->toDayDateTimeString() . " from Localhost";
        }

        // If the IP is not localhost, proceed with the API request
        $key = env('IPSTACK_KEY');

        // Made the API request to get the location data
        // Used Http::withoutVerifying() to ignore SSL verification if needed
        $response = Http::withoutVerifying()->get("https://api.ipstack.com/{$ip}?access_key={$key}");

        // Check if the response is successful
        if ($response->ok()) {
            $data = $response->json();
            $city = $data['city'] ?? 'Unknown City';
            $region = $data['region_name'] ?? 'Unknown Region';
            $country = $data['country_name'] ?? 'Unknown Country';
            $time = Carbon::now()->toDayDateTimeString();

            // Return the formatted location string
            return "{$time} from {$city}, {$region}, {$country}";
        }

        // If the API request fails, return a default message
        return Carbon::now()->toDayDateTimeString() . " from Unknown Location";
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::guard('web')->logout();
        // Invalidate the session to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash a success message
        Session::flash('message', 'You have been logged out.');

        // Redirect to base_url
        return redirect('/');
    }
}
