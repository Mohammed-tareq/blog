<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpResetPassword;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return apiResponse('404', 'User Not Found');
        }

        $user->notify(new SendOtpResetPassword());
        return apiResponse('200', 'OTP Send Successfully');
    }
}
