<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => "nullable | max: 50 "
        ]);
        $keyword = strip_tags($request->search);
        $posts = Post::ActivePost()->when($keyword,function($q)use ($keyword){
            $q->where('title', 'like', "%$keyword%")
            ->orWhere('desc', 'like', "%$keyword%");

        })->latest()->paginate(12);
        return view('front.searchResult', compact('posts'));
    }
}
