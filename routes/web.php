<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Front\NewsSubscribeController;
use App\Http\Controllers\Front\ShowSinglePostController;

Route::redirect('/', '/home');

Route::group(['as' => 'front.'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('new-subscribe', [NewsSubscribeController::class, 'subscribe'])->name('news.subscribe');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    Route::controller(ShowSinglePostController::class)->name('show.')->prefix('post')->group(function () {

        Route::get('{slug}', 'showSinglePost')->name('post');
        Route::get('comments/{slug}', 'showPostComments')->name('comments');
        Route::post('comments/store', 'storePostComment')->name('store.comments');
    });

    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
    });

    Route::match(["get", "post"], 'search', SearchController::class)->name('search');
});

Route::prefix('email')->controller(VerificationController::class)->name('verification.')->group(function () {


    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('/resend', 'resend')->name('resend');
});




Auth::routes();

Route::get('/profile', function(){
    return view('front.dashboard.profile');
} )->name('home');
