<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function singlePost($slug)
    {
        $post = Post::whereSlug($slug)->with(['images',
            'comments'=>function($q){
            $q->latest()->take(3);

        }])->firstOrFail();

        $category = $post->category;
        $category_with_posts = $category->posts()
                            ->with('images')
                            ->latest()
                            ->select('id', 'title', 'slug')
                            ->take(5)
                            ->get();

        return view('frontend.single-post', compact('post', 'category_with_posts'));
    }

    public function getComments($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $comments = $post->comments()->with('user')->latest()->get();

        return response()->json($comments);
    }
}
