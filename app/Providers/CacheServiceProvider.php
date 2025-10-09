<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
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
        if(!Cache::has('read_more_posts')){

            $read_more_posts = Post::select('id' , 'title','slug')->latest()->take(10)->get();
            Cache::remember('read_more_posts', 3600, fn()=>$read_more_posts);
        }

        $read_more_posts =Cache::get('read_more_posts');

        if(!Cache::has('greatest_posts_comments')){

            $greatest_posts_comments = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();

            Cache::remember('greatest_posts_comments', 3600, fn()=>$greatest_posts_comments);
        }
        $greatest_posts_comments = Cache::get('greatest_posts_comments');
        if(!Cache::has('latest_posts')){
            $latest_posts = Post::with('images')->latest()->take(5)->get();
            Cache::remember('latest_posts', 3600, fn()=>$latest_posts);
        }
        $latest_posts = Cache::get('latest_posts');


        view()->share([
           'read_more_posts' => $read_more_posts,
            'greatest_posts_comments' => $greatest_posts_comments,
            'latest_posts' => $latest_posts,
        ]);
    }
}
