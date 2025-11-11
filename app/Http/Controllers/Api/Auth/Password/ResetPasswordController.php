<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Http\Helper\apiResponse;

class ResetPasswordController extends Controller
{
    protected $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function resetPassword(Request $request)
    {
        $this->validateData($request);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return apiResponse('404', 'User Not Found');
        }

        $otpCheck = $this->otp->validate($user->email, $request->token);
        if ($otpCheck->status === false) {
            return apiResponse('400', 'OTP Expired');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return apiResponse('200', 'Password Reset Successfully');
    }

    private function validateData($request)
    {
        $request->validate([
            'email' => 'required|email|string|max:50|exists:users,email',
            'token' => 'required|string|min:6|max:6',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        return $request;
    }
}
