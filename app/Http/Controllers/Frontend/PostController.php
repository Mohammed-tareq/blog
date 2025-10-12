<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function singlePost($slug)
    {
        $post = Post::active()->whereSlug($slug)->with(['images',
            'comments' => function ($q) {
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
        $post = Post::active()->whereSlug($slug)->firstOrFail();
        $comments = $post->comments()->with('user')->latest()->get();

        return response()->json($comments);
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:300|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment = Comment::create([
            'comment' => strip_tags($request->comment),
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'ip_address' => $request->ip(),
        ])->load('user');

        if (!$comment) {
            return response()->json([
                'status' => '403',
                'data' => 'Something went wrong'
            ]);
        }
        return response()->json([
            'status' => '201',
            'comment' => $comment
        ]);

    }
}
