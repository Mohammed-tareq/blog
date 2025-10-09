<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $greatest_posts_view = Post::with('images')
            ->orderBy('num_of_views', 'desc')
            ->take(3)->get();

        $oldest_posts = Post::with('images')->oldest()->take(3)->get();
        $greatest_posts_comments = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        $categories = Category::latest()->take(4)->get();
        $categories_with_posts = $categories->map(function($category){
            $category->posts = $category->posts()->with('images')->take(4)->get();
            return $category;

        });


        return view('frontend.home', compact('posts',
            'greatest_posts_view', 'greatest_posts_comments','oldest_posts','categories_with_posts'));
    }
}
