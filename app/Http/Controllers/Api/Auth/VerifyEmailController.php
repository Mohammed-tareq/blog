<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendOtpVerifyEmail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class VerifyEmailController extends Controller
{
    protected $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function verifyEmail(Request $request)
    {

        $request->validate([
            'token' => 'required|string|min:6|max:6',
        ]);

        $user = auth()->user();
        $otpCheck = $this->otp->validate($user->email, $request->token);
        if ($otpCheck->status === false) {
            return apiResponse('400', 'OTP Expired');
        }

        $user->update([
            'email_verified_at' => now()
        ]);
        return apiResponse('200', 'Email Verified Successfully');
    }

    public function sendOtpAgain()
    {
        $user = auth()->user();
        $user->notify(new SendOtpVerifyEmail());
        return apiResponse('200', 'OTP Send Successfully');
    }

}
