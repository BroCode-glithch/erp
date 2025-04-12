<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        // Check if there are any unread notifications
        $unreadNotifications = Auth::user()->unreadNotifications;

        if ($unreadNotifications->count() > 0) {
            // Mark all unread notifications as read
            $unreadNotifications->markAsRead();

            // 🔥 Flash for Livewire or Blade-based alerts
            session()->flash('message', 'All notifications marked as read.');

            return back(); // Redirect back after marking notifications as read
        } else {
            // 🔥 Flash for Livewire or Blade-based alerts
            session()->flash('message', 'Nothing to mark as read.');

            return back(); // Redirect back after attempting to mark notifications as read
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        
        // Mark a single notification as read
        $notification->markAsRead();

        // 🔥 Flash for Livewire or Blade-based alerts
        session()->flash('message', 'Notification marked as read.');

        return back(); // Redirect back after marking notification as read
    }
}
