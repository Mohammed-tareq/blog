<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedSite;
use Illuminate\Support\ServiceProvider;

class ShareDataProvider extends ServiceProvider
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
        $relateSite = RelatedSite::select('name', 'url')->get();
        $categories = Category::ActiveCategory()->select('name', 'slug', 'id')->get();


        view()->share([
            'relateSite' => $relateSite,
            "categories" => $categories
        ]);
    }
}
