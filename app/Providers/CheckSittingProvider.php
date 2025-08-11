<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSittingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $setting  = Setting::firstOr(function () {
            Setting::create([
                'site_name' => 'news',
                'email' => 'Laravel@gmail.com',
                'favicon' => 'logo.png',
                'logo' => "logo.png",
                'facebook' => 'https://www.facebook.com',
                'instagram' => 'https://www.instagram.com',
                'youtube' => 'https://www.youtube.com',
                'twitter' => 'https://www.twitter.com',
                'phone' => '01111',
                'country' => 'Egypt',
                'city' => 'Cairo',
                'street' => 'street',
            ]);
        });



        view()->share([
            'setting' => $setting,
        ]);
    }
}
