<?php

namespace App\Http\Controllers\Api\Account\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class NotificationController extends Controller
{
    public function getAllNotifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications;
        if (!$notifications) {
            return apiResponse(404, 'Notifications Not Found');
        }
        if ($notifications->isEmpty()) {
            return apiResponse(200, 'User Not Have Notifications');
        }
        return apiResponse(200, 'User Have Notifications', NotificationResource::collection($notifications));

    }

    public function getUnreadNotifications()
    {

        $user = auth()->user();
        $notifications = $user->unreadNotifications;
        if (!$notifications) {
            return apiResponse(404, 'Notifications Not Found');
        }
        if ($notifications->isEmpty()) {
            return apiResponse(200, 'User Dont Have UnRead Notifications');
        }
        return apiResponse(200, 'User Have Notifications', NotificationResource::collection($notifications));

    }

    public function getReadNotifications()
    {

        $user = auth()->user();
        $notifications = $user->readNotifications;
        if (!$notifications) {
            return apiResponse(404, 'Notifications Not Found');
        }
        if ($notifications->isEmpty()) {
            return apiResponse(200, 'User is read all Notifications');
        }
        return apiResponse(200, 'User Have Notifications', NotificationResource::collection($notifications));
    }

    public function readNotification($id)
    {
        $notification = auth()->user()->unreadNotifications()->find($id);
        if (!$notification) {
            return apiResponse(404, 'Notification Not Found');
        }
        $notification->markAsRead();
        return apiResponse(200, 'Notification Read');
    }

    public function readAllNotification()
    {
        $notifications = auth()->user()->unreadNotifications;
        if (!$notifications) {
            return apiResponse(404, 'Notifications Not Found');
        }
        $notifications->markAsRead();
        return apiResponse(200, 'All Notifications Read');
    }
}
