<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->Notifications()->latest()->take(7)->get();
        return view('frontend.dashboard.notification', compact('notifications'));
    }

    public function markSingleNotifiyAsRead($id)
    {
        if (!empty($id)) {
            $notification = auth()->user()->unreadNotifications()->where('id', $id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
           return redirect()->back();
        }
        return redirect()->back()->with('error', 'Notification not found');

    }

    public function markAllNotificationsAsRead()
    {
        $notification = auth()->user()->unreadNotifications;
        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->markAsRead();

       return redirect()->back()->with('success', 'All notifications marked as read');
    }

    public function deleteSingleNotifiy($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
        }
        return redirect()->back()->with('success', 'Notification deleted successfully');
    }

    public function deleteAllNotifications()
    {
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('success', 'All notifications deleted successfully');

    }


}
