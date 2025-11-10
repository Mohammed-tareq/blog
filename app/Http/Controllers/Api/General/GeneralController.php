<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;
use function PHPUnit\Framework\isEmpty;

class GeneralController extends Controller
{
    public function index()
    {
        $query = Post::query()
            ->with(['user', 'category', 'admin', 'images', 'comments'])
            ->activeUser()
            ->activeCategory()
            ->active();

        if (request()->query('keyword')) {
            $query->where('title', 'like', '%' . request()->query('keyword') . '%');
        }

        // get data
        $posts = clone $query->latest()->paginate(9);
        $latest_posts = $this->latestPosts(clone $query);
        $popular_posts = $this->popularPosts(clone $query);
        $oldest_posts = $this->oldestPosts(clone $query);
        $category_posts = $this->categoryPosts();

        $data = [
            'all_posts' => (new PostCollection($posts))->response()->getData(true),
            'popular_posts' => new PostCollection($popular_posts),
            'latest_posts' => new PostCollection($latest_posts),
            'oldest_posts' => new PostCollection($oldest_posts),
            'category_posts' => new CategoryCollection($category_posts),
        ];
        return apiResponse(200, 'Success Response', $data);
    }


    private function popularPosts($query)
    {
        $popular_posts = $query->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)->get();
        if (!$popular_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $popular_posts;

    }

    private function latestPosts($query)
    {
        $latest_posts = $query->latest()->take(3)->get();
        if (!$latest_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $latest_posts;
    }

    private function oldestPosts($query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if (!$oldest_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $oldest_posts;
    }

    private function categoryPosts()
    {
        $categories = Category::active()->withCount('posts')->has('posts', '>=', 3)->get();
        if (!$categories) {
            return apiResponse(404, 'Categories Not Found');
        }
        $category_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->take(3)->get();
            return $category;
        });
        if (!$category_posts) {
            return apiResponse(404, 'Category Posts Not Found');
        }
        return $category_posts;
    }
}
