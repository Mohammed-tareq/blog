<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function App\Http\Helper\apiResponse;

class UserActive
{

    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->guard('web')->check() && auth()->guard('web')->user()->status === 0){
            return redirect()->route('front.wait');
        }

        if(Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->status === 0)
        {
            Auth::guard('sanctum')->user()->CurrentAccessToken()->delete();
            return apiResponse(401,'Your account is not active contact with admin');
        }
        return $next($request);
    }
}
