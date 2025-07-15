<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        // Check if there are any unread notifications
        $unreadNotifications = Auth::user()->unreadNotifications;

        if ($unreadNotifications->count() > 0) {
            // Mark all unread notifications as read
            $unreadNotifications->markAsRead();

            // Flash a success message if there is at least one unread notification
            Session::flash('message', 'All notifications marked as read.');

            return back(); // Redirect back after marking notifications as read
        } else {

            // Flash a message if there are no unread notifications
            Session::flash('message', 'Nothing to mark as read.');

            return back(); // Redirect back after attempting to mark notifications as read
        }
    }

    public function markAsRead($notificationId)
    {
        // Find the specific notification by ID
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        
        // Mark a single notification as read
        $notification->markAsRead();


        // Flash a success message for marking a single notification as read
        Session::flash('message', 'Notification marked as read.');

        return back(); // Redirect back after marking notification as read
    }
}
