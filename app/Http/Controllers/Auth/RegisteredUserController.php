<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Return the registration view
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,program-manager,care-support'],
            'enable_2fa' => ['nullable', 'in:0,1'],
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role based on the provided role in the request
        if (Role::where('name', $request->role)->exists()) {
            $user->assignRole($request->role);
        }

        // Fire the Registered event
        event(new Registered($user)); 

        // Log in the user
        Auth::login($user);

        // If 2FA is enabled, redirect to the 2FA setup page
        if ($request->input('enable_2fa') === '1') {
            // Redirect to the 2FA setup page
            return redirect()->route('2fa.setup');
        }

        // Flash a success message
        session()->flash('message', 'Registration successful! Welcome, ' . $user->name . '!');

        // Redirect to the appropriate dashboard based on the user's role
        return $this->redirectToRoleDashboard($user);
    }

    protected function redirectToRoleDashboard($user)
    {
        // Redirect based on the user's role
        if ($user->hasRole('admin')) {

            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');

        } elseif ($user->hasRole('program-manager')) {

            // Redirect to program manager dashboard
            return redirect()->route('program-manager.dashboard');

        } elseif ($user->hasRole('care-support')) {

            // Redirect to care support dashboard
            return redirect()->route('care-support.dashboard');

        }

        // Default redirect if no specific role matches
        return redirect()->route('dashboard');
    }
}
