<?php

namespace App\Http\Controllers\Api\Account\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Models\User;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class PostAccountController extends Controller
{

    public function getPosts()
    {
        $user = User::where('id', auth()->id())->first();
        if ($user->status == 0) {
            return apiResponse(401, "Your Account is Inactive");
        }
        if (!$user) {
            return apiResponse(404, "User Not Found");
        }
        $posts = $user->posts()->activeUser()->activeCategory()->active()->get();
        if (!$posts) {
            return apiResponse(404, "Posts Not Found");
        }
        return apiResponse(200, "Posts Found", new PostCollection($posts));
    }

    public function getPostsComments()
    {
        $user = User::where('id', auth()->id())->first();
        if ($user->status == 0) {
            return apiResponse(401, "Your Account is Inactive");
        }
        if (!$user) {
            return apiResponse(404, "User Not Found");
        }
        $posts = $user->posts()->with('comments')->active()->get();
        return apiResponse(200, "Posts Found", new PostCollection($posts));
    }
}
