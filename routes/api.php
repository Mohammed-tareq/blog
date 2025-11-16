<?php

use App\Http\Controllers\Api\Account\Posts\PostMangeController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\ContactUs\ContactController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\Search\SearchController;
use App\Http\Controllers\Api\Setting\SettingController;
use App\Http\Controllers\Api\Account\ProfileController;
use App\Http\Controllers\Api\Account\Posts\PostAccountController;
use App\Http\Controllers\Api\Account\Notification\NotificationController;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {

        //    ========================  Register  ======================== //
        Route::controller(RegisterController::class)->middleware('throttle:auth')->group(function () {
            Route::post('register', 'register');
            Route::post('register-only', 'registerOnly');
        });
        //  ========================  Verify Email  ======================== //
        Route::controller(VerifyEmailController::class)->middleware(['auth:sanctum','throttle:auth'])->group(function () {
            Route::post('verify-email', 'verifyEmail');
        });
        //  ========================  Forget Password  ======================== //
        Route::controller(ForgetPasswordController::class)->middleware('throttle:auth')->group(function () {
            Route::post('forget-password', 'forgetPassword');
        });
        //  ========================  Reset Password  ======================== //
        Route::controller(ResetPasswordController::class)->middleware('throttle:auth')->group(function () {
            Route::post('reset-password', 'resetPassword');
        });

        //    ========================  Login  ======================== //
        Route::post('login', LoginController::class);
        //    ========================  Logout  ======================== //
        Route::controller(LogoutController::class)->middleware(['auth:sanctum','throttle:auth'])->group(function () {
            Route::delete('logout', 'logout');
            Route::delete('logout-all', 'logoutAll');
        });
    });

//    ========================  General  ======================== //
    Route::get('/posts/{keyword?}', [GeneralController::class, 'index']);
//    ========================  Post  ======================== //
    Route::controller(PostController::class)->group(function () {
        Route::get('/post/show/{slug}', 'index')->name('post.show');
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
    Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:contact');


    // ========================== protected routes ========================== //
    Route::middleware(['auth:sanctum','user.active','verifyEmailUser'])->prefix('account')->group(function () {
        Route::get('/user', function (Request $request) {
            return UserResource::make(request()->user());
        });
    //======================= update data user ==========================
        Route::controller(ProfileController::class)->group(function () {
            Route::put('/setting/update/', 'update');
            Route::put('/setting/update/password', 'updatePassword');
        });
    //======================= posts data user ==========================
        Route::controller(PostAccountController::class)->prefix('posts')->group(function () {
            Route::get('/', 'getPosts');
            Route::get('/comments', 'getPostsComments');
        });
    //======================= posts data user ==========================
        Route::controller(PostMangeController::class)->prefix('post')->group(function () {
            Route::get('{id}/comments',"getPostComments");
            Route::middleware('throttle:auth')->group(function () {
                Route::post('/store', 'store');
                Route::put('/{id}/update', 'update');
                Route::delete('/destroy/{id} ', 'destroy');
                Route::post('/{id?}/comment/store', 'storePostComment');
            });
        });

        Route::controller(NotificationController::class)->prefix('notifications')->group(function () {
            Route::get('/', 'getAllNotifications');
            Route::get('/unread ','getUnreadNotifications');
            Route::get('/read ','getReadNotifications');
            Route::get('/read/{id}', 'readNotification');
            Route::get('/read-all', 'readAllNotification');
        });
    });
});
