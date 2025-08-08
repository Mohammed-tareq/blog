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
        Setting::firstOr(function () {
            Setting::create([
                'site_name' => 'news',
                'email' => 'Laravel@gmail.com',
                'favicon' => 'favicon.png',
                'logo' => 'logo.png',
                'facebook' => 'default',
                'instagram' => 'default',
                'youtube' => 'default',
                'twitter' => 'default',
                'phone' => 'default',
                'country' => 'default',
                'city' => 'default',
                'street' => 'default',
            ]);
        });
    }
}
