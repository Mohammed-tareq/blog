<?php

use App\Http\Controllers\Admin\AdminProfile\AdminProfileController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Authoriz\AuthorizController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactAdminCotroller;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Notification\NotificationAdminController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => "admin."], function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.show');
        Route::post('/login/check', 'login')->name('login.check');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::name('password.')->prefix('password')->controller(ForgetPasswordController::class)->group(function () {
        Route::get('/email', 'showResetFormEmail')->name('reset.show.email');
        Route::post('/email', 'sendOtp')->name('send.otp');
        Route::get('/verify/{email}', 'verifyOtp')->name('verify.otp');
        Route::post('/verify', 'verifyOtpCheck')->name('verify.otp.check');
    });

    Route::name('password.reset.')->prefix('reset')->controller(ResetPasswordController::class)->group(function () {
        Route::get('/{email}', 'showResetForm')->name('show');
        Route::post('/', 'resetPassword')->name('update');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        //  routes for CRUD
        Route::resource('authorizations', AuthorizController::class)->except('show');
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class)->except('show', 'edit', 'create');
        Route::resource('posts', PostController::class);
        Route::resource('admins', AdminController::class)->except('show');

        Route::get('/user/status/{id}', [UserController::class, 'changeStatus'])->name('users.status');
        Route::get('/category/status/{id}', [CategoryController::class, 'changeStatus'])->name('categories.status');
        Route::get('/post/status/{id}', [PostController::class, 'changeStatus'])->name('posts.status');
        Route::get('/post/comments/{id}', [PostController::class, 'showAllComments'])->name('post.comments');
        Route::get('/post/comment/delete/{id}', [PostController::class, 'deleteComment'])->name('post.comment.delete');
        Route::post('/post/image/delete', [PostController::class, 'deleteSingleImage'])->name('posts.delete-image');
        Route::get('/admin/status/{id}', [AdminController::class, 'changeStatus'])->name('admins.status');

        //===================== setting =========================//
        Route::controller(SettingController::class)->name('setting.')->prefix('setting')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update/{id}', 'update')->name('update');
        });

        //===================== contact =========================//
        Route::controller(ContactAdminCotroller::class)->name('contacts.')->prefix('contacts')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        //===================== Profile Admin =========================//
        Route::controller(AdminProfileController::class)->name('profile.')->prefix('profile')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/check-email', 'checkEmail')->name('check.email');
            Route::post('/email-update', 'checkOrUpdate')->name('check.and.update');
        });

        //=====================Notification========================//
        Route::controller(NotificationAdminController::class)->name('notification.')->prefix('notification')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/delete-notify/{id}', 'deleteNotify')->name('delete');
            Route::get('/delete-all-notifications', 'deleteAllNotify')->name('delete-all');

        });


    });


});

