<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StorePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->active()->with('images')->latest()->paginate(9);
        return view('frontend.dashboard.index', compact('posts'));
    }

    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
            $post = auth()->user()->posts()->create($request->except('_token', 'images'));

            ImageManegment::storeImage($request, $post);
            DB::commit();

            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::alert($e->getMessage());

        }
        Session::flash('success', 'Post created successfully');
        return redirect()->back();
    }

    public function update(StorePostRequest $request)
    {

    }

    public function destroy(Request $request)
    {
        $post = Post::with('images')->findOrFail($request->id);
        $post->load('comments');
        ImageManegment::deleteImage($post);
        $post->delete();
        Session::flash('success', 'Post deleted successfully');
        return redirect()->back();
    }


    public function getComments($id)
    {
        $comment = Comment::with('user')->active()->where('post_id', $id)->latest()->get();

        if (!$comment) {
            return response()->json([
                'status' => '404',
                'data' => 'No comments found'], 404);
        }


        return response()->json([
            'status' => '200',
            'comments' => $comment,
        ], 200);
    }
}










