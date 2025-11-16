<?php

namespace App\Http\Controllers\Api\Account\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PostUpdateRequest;
use App\Http\Requests\Front\StorePostRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
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

            if(RateLimiter::tooManyAttempts( $request->ip(), 3 ))
            {
                $time = RateLimiter::availableIn($request->ip());
                return apiResponse('429', 'You are sending too many requests please try again in ' . $time . ' seconds');
            }
            RateLimiter::increment($request->ip());
            $remin = RateLimiter::remaining($request->ip(), 3);

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
            return apiResponse('500', 'Something went wrong', ['remaining' => $remin]);

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

    public function storePostComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'post_id' => 'sometimes|exists:posts,id',
        ]);
        $user = auth()->user()->id;
        $post = Post::activeUser()
            ->activeCategory()
            ->active()
            ->where(fn($q) => $q->where('id', $id)->orWhere('id', $request->post_id))
            ->first();
        if (!$post) {
            return apiResponse('404', 'Post Not Found');
        }
        $comment = $post->comments()->create([
            'user_id' => $user,
            'comment' => $request->comment,
            'ip_address' => $request->ip(),
        ]);
        if (!$comment) {
            return apiResponse('400', 'Comment Not Created please try again later');
        }
        if (auth()->user()->id !== $post->user_id) {
            $post->user->notify(new NewCommentNotification($comment, $post));
        }
        return apiResponse('200', 'Comment Created Successfully');
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
