<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Http\Helper\apiResponse;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::guard('sanctum')->user()->currentAccessToken()->delete();
        return apiResponse('200', 'Logout Successfully');
    }

    public function logoutAll()
    {
        Auth::guard('sanctum')->user()->tokens()->delete();
        return apiResponse('200', 'Logout All Successfully');
    }
}
