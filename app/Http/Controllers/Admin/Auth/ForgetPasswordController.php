<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpAdmin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected $otp;

    public function __construct()
    {

        $this->otp = new Otp();
    }

    public function showResetFormEmail()
    {
        return view('admin.auth.passwords.forget-pass');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
        ]);

        $email = Admin::where('email', $request->email)->first();
        if (!$email) {
            return back()->withErrors([
                'email' => 'try again later',
            ]);
        }
        $email->notify(new SendOtpAdmin());

        return redirect()->route('admin.password.verify.otp', ['email' => $email->email]);
    }

    public function verifyOtp($email)
    {
        return view('admin.auth.passwords.verify-email', compact('email'));
    }

    public function verifyOtpCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|exists:admins,email',
            'otp' => 'required|string|min:6|max:6',
        ]);

        $otp = $this->otp->validate($request->email, $request->otp);
        if ($otp->status === false) {
            if ($otp->message === 'OTP Expired') {
                noty()->error('OTP Expired Please try again');
                return redirect()->route('admin.login.show');
            }
            return back()->withErrors(['otp' => $otp->message]);
        }

        return redirect()->route('admin.password.reset.show', ['email' => $request->email]);

    }

}
