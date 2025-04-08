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
            'role' => ['required', 'string', 'in:admin,program-manager,support'], // Allow only specific roles
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
            $user->assignRole('user'); // Default role if invalid role provided
        }

        event(new Registered($user));

        // Login the user
        Auth::login($user);

        // Redirect based on the role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('program-manager')) {
            return redirect()->route('program-manager.dashboard'); // Assuming this is your route
        } elseif ($user->hasRole('support')) {
            return redirect()->route('support.dashboard'); // Assuming this is your route
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}
