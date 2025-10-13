<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:30'
        ]);

        if(empty($request->search)){
            Session::flash('error', 'Please enter a search term');
            return redirect()->back();
        }

        $cleanData = strip_tags($request->search);

        $posts = Post::active()->where('title', 'like', "%$cleanData%")
            ->orWhere('description', 'like', "%$cleanData%")
            ->paginate(9);

        return view('frontend.search', compact('posts'));
    }
}
