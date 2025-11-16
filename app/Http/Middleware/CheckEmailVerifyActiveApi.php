<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function App\Http\Helper\apiResponse;

class CheckEmailVerifyActiveApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->email_verified_at === null){
            return apiResponse(401,'Your email is not verified');
        }
        return $next($request);
    }
}
