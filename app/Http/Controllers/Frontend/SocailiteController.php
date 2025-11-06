<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ImageManegment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;


class SocailiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $userProvider = Socialite::driver($provider)->user();

            $userCheck = User:: whereEmail($userProvider->getEmail())->first();

            if ($userCheck) {
                auth()->login($userCheck);
                Session::flash('success', 'You have successfully logged in');
                return redirect()->intended('/home');
            }


            $user = User::create([
                'name' => $userProvider->getName(),
                'user_name' =>$this->createUserName($userProvider->getName()),
                'email' => $userProvider->getEmail(),
                'country' => '',
                'city' => '',
                'street' => '',
                'image' => $userProvider->getAvatar(),
                'email_verified_at' => now(),
                'status' => true,
                'phone' => '',
                'password' => bcrypt(Str::random(8)),
            ]);
            auth()->login($user);
            Session::flash('success', 'You have successfully registered');
            return redirect()->route('front.dashboard.profile.setting.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Something went wrong');
            return redirect()->route('login');
        }

    }

    private function createUserName($name)
    {
        $userName = Str::slug($name);
        while(User::where('user_name', $userName)->exists()){
            $userName = $userName.rand(1,1000);
        }
        return $userName;
    }
}
