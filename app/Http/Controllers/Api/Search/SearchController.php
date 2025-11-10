<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class SearchController extends Controller
{
    public function getPosts()
    {
        $posts = Post::query()
            ->with(['user', 'category', 'admin', 'images', 'comments'])
            ->activeUser()
            ->activeCategory()
            ->active();

        if (request()->query('keyword')) {
            $posts->where('title', 'like', '%' . request()->query('keyword') . '%');
        }

        $posts = $posts->latest()->paginate(9);
        if (!$posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return apiResponse(200, 'Posts Found', new PostCollection($posts)->response()->getData(true));
    }

    public function getPostsForm(Request $request)
    {
        if (!$request->keyword) {
            return apiResponse(404, 'Posts Not Found');
        }
        $keyword = strip_tags($request->keyword);

        $posts = Post::query()
            ->with(['user', 'category', 'admin', 'images', 'comments'])
            ->activeUser()
            ->activeCategory()
            ->active()
            ->where('title', 'like', '%' . $keyword . '%')
            ->latest()
            ->paginate(9);
        if (!$posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return apiResponse(200, 'Posts Found', new PostCollection($posts)->response()->getData(true));

    }
}
