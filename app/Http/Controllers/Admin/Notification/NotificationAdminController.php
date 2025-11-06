<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationAdminController extends Controller
{
    public function __construct(){
        $this->middleware('can:notification.read')->only('index');
        $this->middleware('can:notification.delete')->only('deleteNotify','deleteAllNotify');
    }

    public function index(){

       Auth::guard('admin')->user()->unreadNotifications->markAsRead();

        $notifications = Auth::guard('admin')->user()->notifications()->get();
        return view('admin.notification.notification',compact('notifications'));
    }
    public function deleteNotify($id)
    {
        $notification = Auth::guard('admin')->user()->notifications()->find($id);
        if (!$notification) {
            noty()->error('Try again later');
            return redirect()->back();
        }
        $notification->delete();
        noty()->success('Notification deleted successfully');
        return redirect()->back();
    }

    public function deleteAllNotify()
    {
        Auth::guard('admin')->user()->notifications()->delete();
        noty()->success('All notifications deleted successfully');
        return redirect()->back();
    }
}
