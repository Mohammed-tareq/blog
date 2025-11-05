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
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('notifiy')) {
            $notifiyId = $request->query('notifiy');
            $user = auth('admin')->user();
            if (!$user) {
                $user = auth()->user();
            }
            $notification = $user->unreadNotifications()->where('id', $notifiyId)->first();
            if (!$notification) {
                abort(404);
            }
            $notification->markAsRead();

        }
        return $next($request);
    }
}
