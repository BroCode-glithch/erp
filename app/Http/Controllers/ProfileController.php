<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Return the view for editing the admin profile
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]); // Pass the authenticated user to the view
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validate and update the user's profile information
        $request->user()->fill($request->validated());

        // If the email is changed, set email_verified_at to null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the updated user information
        $request->user()->save();

        // Flash a success message
        Session::flash('success', 'Profile updated successfully.');

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the user's password before deletion
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Log out the user
        Auth::logout();

        // Delete the user account
        $user->tokens()->delete(); // Delete all personal access tokens
        $user->currentAccessToken()?->delete(); // Delete the current access token if it
        $user->delete();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return Redirect::to('/');
    }
}
