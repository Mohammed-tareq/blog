<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\ContactUs\ContactController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\Search\SearchController;
use App\Http\Controllers\Api\Setting\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    //    ========================  Register  ======================== //
    Route::controller(RegisterController::class)->prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('register-only', 'registerOnly');
    });

    Route::controller(VerifyEmailController::class)->prefix('auth')->middleware('auth:sanctum')->group(function () {
        Route::post('verify-email', 'verifyEmail');
        Route::get('send-otp', 'sendOtpAgain');
    });

    //    ========================  Login  ======================== //
    Route::post('auth/login', LoginController::class);
    //    ========================  Logout  ======================== //
    Route::controller(LogoutController::class)->prefix('auth')->middleware('auth:sanctum')->group(function () {
        Route::delete('logout', 'logout');
        Route::delete('logout-all', 'logoutAll');
    });
//    ========================  General  ======================== //
    Route::get('/posts/{keyword?}', [GeneralController::class, 'index']);
//    ========================  Post  ======================== //
    Route::controller(PostController::class)->group(function () {
        Route::get('/post/show/{slug}', 'index');
        Route::get('/post/comments/{slug}', 'getComments');
    });
//    ========================  Search  ======================== //
    Route::controller(SearchController::class)->group(function () {
        Route::get('/search/posts/{keyword?}', 'getPosts');
        Route::post('/search/posts', 'getPostsForm');
    });
//    ========================  Category  ======================== //
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'getCategories');
        Route::get('/category/{slug}/posts', 'getCategoryPosts');
        Route::get('/category/{category}/posts/except/{slug}', 'getCategoryPostsExcept');;
    });
    //    ========================  Setting  ======================== //
    Route::get('/settings', SettingController::class);

    //    ========================  Contact  ======================== //
    Route::post('/contact', [ContactController::class, 'store']);


    // ========================== protected routes ========================== //
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return request()->user();
        });
    });
});
