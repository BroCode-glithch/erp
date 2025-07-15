<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        // Fetch all users except the currently authenticated user (admin)
        $users = User::where('id', '!=', Auth::id())->get(); // show all users except admin

        // Return the view with users data
        return view('admin.settings.index', compact('users'));
    }

    public function general()
    {
        // Fetch general settings with default values
        $settings = [
            'site_name' => setting('general.site_name', config('app.name')),
            'admin_email' => setting('general.admin_email', config('mail.from.address')),
            'contact_phone' => setting('general.contact_phone'),
            'timezone' => setting('general.timezone', config('app.timezone')),
            'date_format' => setting('general.date_format', 'Y-m-d'),
            'currency_symbol' => setting('general.currency_symbol', '$'),
            'maintenance_mode' => setting('general.maintenance_mode', false),
            'site_logo' => setting('general.site_logo', null),
        ];

        // Check if site logo exists and get its URL
        if ($settings['site_logo']) {
            $settings['site_logo_url'] = Storage::disk('public')->url($settings['site_logo']);
        } else {
            $settings['site_logo_url'] = null;
        }

        // Return the view with settings data
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        // Validate the request data
        $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'timezone' => 'required|timezone',
            'date_format' => 'required|string|max:20',
            'currency_symbol' => 'required|string|max:10',
            'maintenance_mode' => 'nullable|boolean',
            'site_logo' => 'nullable|image|max:2048', // max 2MB
        ]);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            setting(['general.site_logo' => $path]);
        }

        // Update general settings
        setting([
            'general.site_name' => $request->site_name,
            'general.admin_email' => $request->admin_email,
            'general.contact_phone' => $request->contact_phone,
            'general.timezone' => $request->timezone,
            'general.date_format' => $request->date_format,
            'general.currency_symbol' => $request->currency_symbol,
            'general.maintenance_mode' => $request->boolean('maintenance_mode'),
        ]);

        // Flash success message
        Session::flash('status', 'General settings updated successfully.');

        // Redirect back to the settings page
        return back()
            ;
    }

    public function appearance()
    {
        // Fetch appearance settings with default values
        $settings = [
            'system_default_direction' => setting('appearance.direction', 'ltr'),
            'system_default_language' => setting('appearance.language', 'en'),
        ];


        // Return the view with settings data
        return view('admin.settings.appearance', compact('settings'));
    }

    public function updateAppearance(Request $request)
    {
        // Validate the request data
        $request->validate([
            'direction' => ['required', 'in:ltr,rtl'],
            'language'  => ['required', 'in:en,ar,fr'],
        ]);

        // Update appearance settings
        setting([
            'appearance.direction' => $request->direction,
            'appearance.language' => $request->language,
        ]);

        // Flash success message
        Session::flash('status', 'Appearance settings updated successfully.');

        // Redirect back to the settings page
        return back()
            ;
    }

    
    public function toggle2FA(User $user)
    {
        // Check if the user is authorized to update 2FA settings
        $user->two_factor_enabled = !$user->two_factor_enabled;

        // If 2FA is disabled, clear the secret
        if (!$user->two_factor_enabled) {
            $user->two_factor_secret = null;
        }

        // Save the updated user model
        $user->save();

        // Flash success message
        Session::flash('status', '2FA status updated for ' . $user->name);
        return back();
    }

}
