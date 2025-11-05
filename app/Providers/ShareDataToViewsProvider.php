<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedSite;
use Illuminate\Support\ServiceProvider;

class ShareDataToViewsProvider extends ServiceProvider
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
         $related_sites = RelatedSite::select('name', 'url')->latest()->take(5)->get();
         $categories_share = Category::active()->select('name', 'slug','id')->get();


         view()->share([
             'related_sites' => $related_sites,
             'categories_share' => $categories_share,

         ]);

    }
}
