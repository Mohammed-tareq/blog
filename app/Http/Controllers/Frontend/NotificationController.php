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
            return response()->json([
                'success' => 'Notification marked as read',
                'data' => auth()->user()->notifications()->latest()->take(7)->get(),
                'count' => auth()->user()->unreadNotifications()->count()
            ], 200);
        }
        return response()->json(['error' => 'Notification not found'], 404);

    }

    public function markAllNotificationsAsRead()
    {
        $notification = auth()->user()->unreadNotifications;
        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'success' => 'Notification marked as read',
            'count' => auth()->user()->unreadNotifications()->count()
        ]);
    }

    public function deleteSingleNotifiy($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
        }
        return response()->json([
            'success' => 'Notification delete successfully',
            'data' => auth()->user()->notifications()->latest()->take(7)->get(),
        ], 200);
    }

    public function deleteAllNotifications()
    {
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('success', 'All notifications deleted successfully');

    }


}
