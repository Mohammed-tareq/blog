<?php

namespace App\Http\Controllers\Admin\AdminProfile;

use App\Http\Controllers\Controller;
use App\Notifications\SendOtpAdmin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminProfileController extends Controller
{
    protected $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function show()
    {
        return view('admin.profile-admin.show');
    }

    public function edit()
    {
        return view('admin.profile-admin.edit');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.auth('admin')->user()->id,
            'user_name' => 'required|string|unique:admins,user_name,'.auth('admin')->user()->id,
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        session()->put('adminData', $data);
        $admin = auth('admin')->user();
        $admin->notify(new SendOtpAdmin());
        return view('admin.profile-admin.check-otp', compact('admin'));
    }

    public function checkOrUpdate(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|min:6|max:6',
            'email' => 'required|email|string|exists:admins,email',
        ]);

        $otpAdmin = $this->otp->validate($request->email, $request->otp);
        if ($otpAdmin->status === false) {
            if ($otpAdmin->message === 'OTP Expired') {
                noty()->error('OTP Expired Please try again');
                session()->forget('adminData');
                return redirect()->route('admin.login.show');
            }
            noty()->error($otpAdmin->message);
            session()->forget('adminData');
            return redirect()->route('admin.login.show');
        }

        $admin = auth('admin')->user();
        $data = session()->get('adminData');
        $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'password' => bcrypt($data['password']),
        ]);
        noty()->success('Admin Updated Successfully');
        session()->forget('adminData');
        return redirect()->route('admin.profile.show');
    }

}
