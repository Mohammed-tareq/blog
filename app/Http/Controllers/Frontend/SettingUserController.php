<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\SettingProfileUserRequest;
use App\Models\User;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SettingUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting' , compact('user'));
    }
    public function update( SettingProfileUserRequest $request)
    {
        $request->validated();
        $user = auth()->user();
        $user->update($request->except('_token','image'));

        ImageManegment::storeImage($request,null,$user);

        Session::flash('success', 'Your profile has been updated successfully');

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if(!Hash::check($request->current_password, auth()->user()->password)){
            Session::flash('error', 'Current password is incorrect');
            return redirect()->back();
        }

         auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);
        Session::flash('success', 'Your password has been updated successfully');

        return redirect()->back();


    }
}
