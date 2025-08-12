<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowSinglePostController extends Controller
{
    public function showSinglePost($slug)
    {

        $post = Post::with(['comments'=> fn($q)=>  $q->take(3)])->whereSlug($slug)->firstOrFail();
        $post->increment('nums_of_view');
        $category = $post->category;
        $posts_of_category = $category->posts()->where('slug', '!=', $post->slug)->latest()->take(6)->get();

        $latest_post = Post::latest()->take(5)->get();
        $gretest_post_news = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();




        return view('front.show-post', [
            'post' => $post,
            'posts_of_category' => $posts_of_category,
            'latest_post' => $latest_post,
            'gretest_post_news' => $gretest_post_news
            ]);
    }
}
