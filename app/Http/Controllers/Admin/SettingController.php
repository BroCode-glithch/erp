<?php

namespace App\Http\Controllers\Admin;

use id;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // show all users except admin
        return view('admin.settings', compact('users'));
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
