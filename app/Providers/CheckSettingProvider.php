<?php

namespace App\Providers;

use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
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
        $setting = Setting::firstOr(function () {
            Setting::create([
                'site_name' => 'Blog',
                'logo' => 'img/logo.png',
                'favicon' => 'favicon.png',
                'phone' => '0123456789',
                'email' => 'Laravel_Blog@gmail.com',
                'city' => 'Cairo',
                'street' => ' 91 Street',
                'country' => 'Egypt',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://www.twitter.com/',
                'instagram' => 'https://www.instagram.com/',
                'linkedin' => 'https://www.linkedin.com/',
                'youtube' => 'https://www.youtube.com/',
                'desc_for_site' => 'Welcome to our blog — discover the latest articles, tutorials, and insights about web development, Laravel, PHP, and modern programming practices. Stay updated and keep learning!',

            ]);
        });

        $setting->whatsapp = 'https://wa.me/' . $setting->phone;


        view()->share('setting', $setting);
    }
}
