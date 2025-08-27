<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category =Category::ActiveCategory()->whereSlug($slug)->firstOrFail();
        $post = $category->posts()->latest()->paginate(9);
        return view('front.category-posts',compact('post' , 'category'));
    }
}
