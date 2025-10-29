<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('auth:admin')->only('logout');
    }
    public function showLoginForm()

    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate($this->filter());

        if(Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)){
            noty()->success('You have logged in successfully!');
            return redirect()->intended('admin/home');
        }
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }

    private function filter()
    {
        return[
            'email' => 'required|email|string|exists:admins,email',
            'password' => 'required|string|min:7',
            'remember' => 'nullable|in:on',
        ];
    }

}
