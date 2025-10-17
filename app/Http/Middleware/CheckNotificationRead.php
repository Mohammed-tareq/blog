<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notifiy')){
            $notification = auth()->user()->unreadNotifications()->where('id' , $request->query('notifiy'))->first();
          if($notification){
            $notification->markAsRead();
          }
        }
        return $next($request);
    }
}
