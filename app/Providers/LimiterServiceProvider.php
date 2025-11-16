<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use function App\Http\Helper\apiResponse;


class LimiterServiceProvider extends ServiceProvider
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
         $this->limiter();
    }

    protected  function limiter()
    {
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinutes(5,2)->by($request->ip())->response(function () {
                return apiResponse(429,'You are sending too many requests please try again in 5 minutes');
            });
        });

        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinutes(5,3)->by($request->ip())->response(function () {
                return apiResponse(429,'You are sending too many requests please try again in 5 minutes');
            });
        });

        RateLimiter::for('comment', function (Request $request) {
            return Limit::perMinutes(5,5)->by($request->ip())->response(function () {
                return apiResponse(429,'You are sending too many requests please try again in 5 minutes');
            });
        });

    }
}
