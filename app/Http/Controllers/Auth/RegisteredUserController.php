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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,program-manager,care-support'], // Allow only specific roles
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role based on the provided role in the request
        $role = $request->role;

        // Ensure the role exists before assigning
        if (Role::where('name', $role)->exists()) {
            $user->assignRole($role);
        } else {
            return redirect()->route('register')->with('error', 'Invalid Role'); // log or notify that an invalid role was sent
        }

        event(new Registered($user));

        // Login the user
        Auth::login($user);

        // Redirect based on the role
        if ($user->hasRole('admin')) {
            notify()->info('Account registered successfully!');
            notify()->success('Welcome ' . $user->name);
            return redirect()->route('admin.dashboard'); // Redirects user to the admin dashboard based on role
        } elseif ($user->hasRole('program-manager')) {
            notify()->info('Account registered successfully!');
            notify()->success('Welcome ' . $user->name);
            return redirect()->route('program-manager.dashboard'); // Redirects user to program manager dashboard based on role
        } elseif ($user->hasRole('support')) {
            notify()->info('Account registered successfully!');
            notify()->success('Welcome ' . $user->name);
            return redirect()->route('support.dashboard'); // Redirects user to care support dsahboard based on role
        } else {
            notify()->error('Oops! User has no role.', 'error');
            return redirect()->route('dashboard'); // default laravel dashboard
        }
    }
}
