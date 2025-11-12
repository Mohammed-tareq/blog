<?php

namespace App\Http\Controllers\Api\Account\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PostUpdateRequest;
use App\Http\Requests\Front\StorePostRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Http\Helper\apiResponse;

class PostMangeController extends Controller
{

    public function getPostComments($id)
    {
        $comments = auth()->user()->posts()->find($id)->comments;

        if (!$comments) {
            return apiResponse('404', 'Comments Not Found');
        }
        if ($comments->isEmpty()) {
            return apiResponse('200', 'Comments Less Than 0');
        }
        return apiResponse('200', 'Comments Found', new CommentCollection($comments));

    }

    public function store(StorePostRequest $request)
    {
        try {
            $request->validated();
            $this->checktages($request);

            DB::beginTransaction();

            $user = auth()->user();
            if (!$user) {
                return apiResponse('404', "User Not Found");
            }

            $post = $user->posts()->create($request->except('images'));
            ImageManegment::storeImage($request, $post);
            DB::commit();
            return apiResponse('200', 'Post Created Successfully');


        } catch (\Exception $e) {
            DB::rollBack();
            return apiResponse('500', 'Something went wrong');

        }
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $request->validated();
            $this->checktages($request);
           DB::beginTransaction();
            $post = auth()->user()->posts()->find($id);
            if (!$post) {
                return apiResponse('404', 'Post Not Found');
            }
            $post->update($request->except('images', '_method'));
            if ($request->hasFile('images')) {
                ImageManegment::storeImage($request, $post);
            }
            DB::commit();
            return apiResponse('200', 'Post Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return apiResponse('500', 'Something went wrong', $e->getMessage());
        }

    }

    public function destroy($id)
    {

        $post = auth()->user()->posts()->find($id);
        if (!$post) {
            return apiResponse('404', 'Post Not Found');
        }
        ImageManegment::deleteImagesForPost($post);
        $post->delete();
        return apiResponse('200', 'Post Deleted Successfully');
    }

    private function checktages($request)
    {
        if (!empty($request->tags)) {
            $tags = collect(json_decode($request->tags))->pluck('value')->toArray();
            return $request->merge(['tags' => $tags]);
        }

        return $request->merge(['tags' => explode(' ', $request->title)]);
    }
}
