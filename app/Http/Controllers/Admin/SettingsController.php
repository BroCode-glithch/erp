<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // show all users except admin
        return view('admin.settings.index', compact('users'));
    }

    public function general()
    {
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

        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
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

        setting([
            'general.site_name' => $request->site_name,
            'general.admin_email' => $request->admin_email,
            'general.contact_phone' => $request->contact_phone,
            'general.timezone' => $request->timezone,
            'general.date_format' => $request->date_format,
            'general.currency_symbol' => $request->currency_symbol,
            'general.maintenance_mode' => $request->boolean('maintenance_mode'),
        ]);

        return back()->with('status', 'General settings updated successfully.');
    }

    public function appearance()
    {
        $settings = [
            'system_default_direction' => setting('appearance.direction', 'ltr'),
            'system_default_language' => setting('appearance.language', 'en'),
        ];

        return view('admin.settings.appearance', compact('settings'));
    }

    public function updateAppearance(Request $request)
    {
        $request->validate([
            'direction' => ['required', 'in:ltr,rtl'],
            'language'  => ['required', 'in:en,ar,fr'],
        ]);

        setting([
            'appearance.direction' => $request->direction,
            'appearance.language' => $request->language,
        ]);

        return back()->with('status', 'Appearance settings updated successfully.');
    }

    
    public function toggle2FA(User $user)
    {
        $user->two_factor_enabled = !$user->two_factor_enabled;

        if (!$user->two_factor_enabled) {
            $user->two_factor_secret = null;
        }

        $user->save();

        session()->flash('status', '2FA status updated for ' . $user->name);
        return back();
    }

}
