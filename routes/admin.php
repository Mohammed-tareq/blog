<?php

use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Authoriz\AuthorizController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Post\PostController;
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

    Route::middleware('auth:admin')->group(function () {
        //  routes for CRUD
        Route::resource('roles',AuthorizController::class);
        Route::resource('users', UserController::class);
        Route::resource ('categories' , CategoryController::class)->except('show','edit','create');
        Route::resource ('posts' , PostController::class);
        Route::resource('admins', AdminController::class);

        Route::get('/user/status/{id}',[UserController::class ,'changeStatus'])->name('users.status');
        Route::get('/category/status/{id}',[CategoryController::class ,'changeStatus'])->name('categories.status');
        Route::get('/post/status/{id}',[PostController::class ,'changeStatus'])->name('posts.status');
        Route::post('/post/image/delete',[PostController::class ,'deleteSingleImage'])->name('posts.delete-image');
        Route::get('/admin/status/{id}',[AdminController::class ,'changeStatus'])->name('admins.status');

        //===================== setting =========================//
        Route::controller(SettingController::class)->name('setting.')->prefix('setting')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update/{id}', 'update')->name('update');
        });


    });



    Route::middleware('auth:admin')->group(function () {

        Route::get('/home', function () {
            return view('admin.index');
        })->name('home');
    });

});

