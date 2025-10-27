<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StorePostRequest;
use App\Http\Requests\Front\PostUpdateRequest;
use App\Models\Comment;
use App\Models\Image;
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
            $request->validated();
        try {
            DB::beginTransaction();

            $this->commentable($request);
            $this->checktages($request);
            $post = auth()->user()->posts()->create($request->except('_token', 'images'));

            ImageManegment::storeImage($request, $post, null);
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

    public function edit($slug)
    {
        $post = Post::with('images')->where('slug', $slug)->first();
        return view('frontend.dashboard.edit-post', compact('post'));
    }

    public function update(PostUpdateRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();
            $this->commentable($request);
            $this->checktages($request);
            $post = Post::active()->findOrFail($request->id);
            $post->update($request->except('_token', 'images'));

            if($request->hasFile('images')){
                ImageManegment::storeImage($request, $post);
            }

            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        Session::flash('success', 'Post updated successfully');
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        $post = Post::with('images')->findOrFail($request->id);
        $post->load('comments');
        ImageManegment::deleteImagesForPost($post);
        $post->delete();
        Session::flash('success', 'Post deleted successfully');
        return redirect()->back();
    }

    public function deleteImagePost(Request $request)
    {
        $request->validate([
            'key' => 'required|string|exists:images,id'
        ]);

        $image = Image::find($request->id);
        if(!$image){
            return response()->json([
                'status' => '404',
                'data' => 'Image not found'], 404);
        }
        ImageManegment::deleteImageFormLocal($image->path);
        $image->delete();
        return response()->json([
            'status' => '200',
            'data' => 'Image deleted successfully'], 200);

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

    private function commentable($request)
    {
      return  $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);

    }
    private function checktages($request)
    {
        if(!empty($request->tags)){
            $tags = collect(json_decode($request->tags))->pluck('value')->toArray();
           return $request->merge(['tags' => $tags]);
        }

        return $request->merge(['tags' => explode(' ', $request->title)]);
    }

}










