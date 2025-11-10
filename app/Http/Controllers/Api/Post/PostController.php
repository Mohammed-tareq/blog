<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class PostController extends Controller
{
    public function index($slug)
    {
        $post = Post::with(['user', 'category', 'admin', 'images', 'comments'])
            ->activeUser()
            ->activeCategory()
            ->active()
            ->whereSlug($slug)->first();

        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }
        return apiResponse(200, 'Post Found', PostResource::make($post));
    }

    public function getComments($slug)
    {
        $post = Post::activeUser()
            ->activeCategory()
            ->active()
            ->whereSlug($slug)->first();
        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }
        $comments = $post->comments()->with('user')->latest()->get();

        if (!$comments) {
            return apiResponse(404, 'Comments Not Found');
        }
        return apiResponse(200, 'Comments Found', new CommentCollection($comments));
    }
}
