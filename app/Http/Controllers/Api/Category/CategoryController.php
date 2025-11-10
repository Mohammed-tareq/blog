<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Post\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::active()->get();

        if (!$categories) {
            return apiResponse(404, 'Categories Not Found');
        }

        return apiResponse(200, 'Categories Found', new CategoryCollection($categories));
    }

    public function getCategoryPosts($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();
        if (!$category) {
            return apiResponse(404, 'Category Not Found');
        }
        $posts = $category->posts;
        if (!$posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return apiResponse(200, 'Posts Found', new PostCollection($posts));
    }

    public function getCategoryPostsExcept($category,$slug)
    {
        $categoryTarget = Category::active()->whereSlug($category)->first();
        if(!$categoryTarget){
            return apiResponse(404, 'Category Not Found');
        }
        $posts = $categoryTarget->posts()->where('slug','!=',$slug)->get();
        if (!$posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return apiResponse(200, 'Posts Found', new PostCollection($posts));
    }
}
