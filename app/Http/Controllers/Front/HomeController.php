<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $most_view = Post::orderBy('nums_of_view', 'desc')->take(3)->get();
        $oldes_news = Post::oldest()->take(3)->get();
        $gretest_post_news = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();

        // $categories = Category::all();
        // $category_with_posts = $categories->map(function ($category){
        //     $category->posts = $category->posts()->take(4)->get();
        //     return $category;
        // });

        // $categories = Category::with('posts')->get();
        // $categories->each(function ($category) {
        //     $category->setRelation('posts', $category->posts->take(4));
        // });

        $categories = Category::with(['posts' => function ($query) {
            $query->take(4);
        }])->latest()->take(4)->get();

        return view('front.index', [
            'posts' => $posts,
            'most_view' => $most_view,
            'oldes_news' => $oldes_news,
            'gretest_post_news' => $gretest_post_news,
            'categories' => $categories,
        ]);
    }
}
