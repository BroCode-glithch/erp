<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();


        if ($user->hasRole('admin')) {
            notify()->success('Welcome back, ' . $user->name . '!', 'Success');
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('program-manager')) {
            notify()->success('Welcome back, ' . $user->name . '!', 'Success');
            return redirect()->route('pm.dashboard');
        } elseif ($user->hasRole('support')) {
            notify()->success('Welcome back, ' . $user->name . '!', 'Success');
            return redirect()->route('care.dashboard');
        } else {
            notify()->error('Oops! User has no role.', 'error');
            return redirect()->route('user.dashboard');
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        notify()->success('Logout successful.', 'Success');
        return redirect('/');
    }
}
