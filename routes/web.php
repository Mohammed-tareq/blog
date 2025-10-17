<?php

use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\SettingUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscribeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\ProfileController;




Route::redirect('/', '/home');


Route::name('front.')->group(function () {
    // home page route
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    //new subscribes route in home page
    Route::post('home/new-subscribe', NewSubscribeController::class)->name('new-subscribe');
    //category route
    Route::get('category/{slug}', CategoryController::class)->name('category');


    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
    //single post route
    Route::get('/{slug}',  'singlePost')->name('single-post');
    //get all comments by ajax for single post
    Route::get('/{slug}/comments',  'getComments')->name('getAllComments');
    //store comment
    Route::post('/comment/store',  'storeComment')->name('comment.store');
    });


    Route::name('contact.')->prefix('contact-us')->group(function () {
        Route::get('/', [ContactUsController::class, 'index'])->name('index');
        Route::post('/store', [ContactUsController::class, 'store'])->name('store');
    });


    Route::prefix('account')->name('dashboard.')->middleware(['auth:web' , 'verified'])->group(function () {

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('profile');
            Route::post('/post/store', 'store')->name('post.store');
            Route::get('/edit/{slug}', 'edit')->name('post.edit');
            Route::put('/edit/{id}', 'update')->name('post.update');
            Route::delete('/destroy', 'destroy')->name('post.destroy');
            Route::post('/post/delete-image/{id}', 'deleteImagePost')->name('post.destroy-image');
            Route::get('/get-comments/{id}','getComments')->name('post.getComments');
        });

        Route::prefix('/setting')->name('profile.setting.')->controller(SettingUserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'update')->name('update');
            Route::put('/update-password', 'updatePassword')->name('update-password');
        });

        Route::controller(NotificationController::class)->prefix('notification')->name('profile.notification.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/mark-single-notification/{id}', 'markSingleNotifiyAsRead')->name('mark-single-notify');
            Route::get('/mark-all-notifications', 'markAllNotificationsAsRead')->name('markAll');
            Route::get('/delete-all-notifications-as-read', 'deleteAllNotifications')->name('deleteAll');
            Route::get('/delete-single-notification-as-read/{id}', 'deleteSingleNotifiy')->name('delete');
        });
    });

    Route::match(['get', 'post'], '/search', SearchController::class)->name('search');
});




Route::get('/dashboard', function (){
    return view('frontend.dashboard.index');
});



// this routes is not work in package ui so make over write in web.php
Route::controller(VerificationController::class)->prefix('email')->name('verification.')->group(function () {
    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('/resend', 'resend')->name('resend');

});

Auth::routes();

