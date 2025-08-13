<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowSinglePostController extends Controller
{
    public function showSinglePost($slug)
    {

        $main_post = Post::with(['comments' => fn($q) => $q->take(3)])->whereSlug($slug)->firstOrFail();
        $main_post->increment('nums_of_view');
        $category = $main_post->category;
        $posts_of_category = $category->posts()->where('slug', '!=', $main_post->slug)->latest()->take(6)->get();

        $latest_post = Post::latest()->take(5)->get();
        $gretest_post_news = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();


        return view('front.show-post', [
            'main_post' => $main_post,
            'posts_of_category' => $posts_of_category,
            'latest_post' => $latest_post,
            'gretest_post_news' => $gretest_post_news
        ]);
    }

    public function showPostComments($slug)
    {
        $post_comments = Post::whereSlug($slug)->first();

        $comment = $post_comments->comments()->with(['user' => fn($q) => $q->select('id', 'name', 'image')])->get();
        return response()->json($comment);
    }

    public function storePostComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required | exists:posts,id',
            'user_id' => 'required | exists:users,id',
        ]);

        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'ip_address' => $request->ip(),
        ])->load(['user' => fn($q) => $q->select('id', 'name', 'image')]);
        if (!$comment) {
            return response()->json([
                'status' => 403,
                'message' => 'Something went wrong'
            ]);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Comment added successfully',
            "comment" => $comment
        ]);
    }
}
