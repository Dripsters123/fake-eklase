<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        // Optionally mark all as read
        auth()->user()->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('status', 'Paziņojums dzēsts.');
    }
}
