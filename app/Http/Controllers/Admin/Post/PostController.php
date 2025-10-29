<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Front\PostUpdateRequest;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $searchBy = request()->keyword;
        $sortBy = request()->sort_by ?? 'id';
        $orderBy = request()->order ?? 'desc';
        $status = request()->status;
        $limit = request()->paginate ?? 10;
        $posts = Post::when($searchBy, fn($q) => $q->where('title', 'like', "%".$searchBy."%")
            ->OrWhereHas('user', fn($q) => $q->where('name', 'like', "%".$searchBy."%"))
            ->OrWhereHas('category', fn($q) => $q->where('name', 'like', "%".$searchBy."%")))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sortBy, $orderBy)
            ->paginate($limit);

        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        return view('admin.post.create');
    }

    public function store(StorePostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $this->checkCommantAble($request);
            $this->checktages($request);
            $post = Auth::guard('admin')->user()->posts()->create($request->except('_token', 'images'));

            ImageManegment::storeImage($request, $post, null);

            DB::commit();

            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');

        } catch (Exception $e) {
            DB::rollBack();
            noty()->error('Something went wrong');
            return redirect()->back();
        }
        noty()->success('Post Created Successfully');
        return redirect()->route('admin.posts.index');

    }

    public function show(string $id)
    {
        $post = Post::withCount('comments')->find($id);
        return view('admin.post.show', compact('post'));
    }


    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, string $id)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $post = Post::findOrFail($id);
            $this->checkCommantAble($request);
            $this->checktages($request);
            $post->update($request->except('_token', 'images'));

            if ($request->hasFile('images')) {
                ImageManegment::storeImage($request, $post);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            noty()->error('Something went wrong');
            return redirect()->back();
        }
        noty()->success('Post Updated Successfully');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        ImageManegment::deleteImagesForPost($post);
        $post->delete();
        noty()->success('Post Deleted Successfully');
        return redirect()->route('admin.posts.index');

    }

    public function changeStatus($id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'status' => !$post->status,
        ]);
        noty()->success('Post Status Updated Successfully');
        return redirect()->back();
    }

    public function deleteSingleImage(Request $request)
    {
        if ($request->has('key')) {
            $image = Image::findOrFail($request->key);
            if (!$image) {
                return response()->json(['message' => 'Image not found'], 404);
            }
            ImageManegment::deleteImageFormLocal($image->path);
            $image->delete();
            return response()->json(['message' => 'Image deleted successfully'], 200);
        }
        return response()->json(['message' => 'Invalid request'], 400);

    }

    private function checkCommantAble($request)
    {

        return $request->merge([
            'comment_able' => $request->comment_able == 'on' ? 1 : 0,
        ]);
    }

    private function checktages($request)
    {
        if (!empty($request->tages)) {

            $tages = collect(json_decode($request->tages))->plunk('value')->toArray();
            return $request->merge(['tages' => $tages]);
        }
        return $request->merge(['tags' => explode(' ', $request->title)]);
    }
}
