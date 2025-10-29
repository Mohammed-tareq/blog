<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm($email)
    {
        return view('admin.auth.passwords.reset-pass', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|exists:admins,email',
            'password' => 'required|string|min:7|confirmed',
            'password_confirmation' => 'required|string|min:7',
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            noty()->error('Try again later');
            return redirect()->route('admin.login.show');
        }
        $admin->update([
            'password' => Hash::make($request->password),
        ]);
        noty()->success('Password has been reset successfully');
        return redirect()->route('admin.login.show');
    }
}
