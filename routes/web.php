<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsSubscribeController;
use App\Http\Controllers\Front\ShowSinglePostController;
use App\Http\Controllers\Front\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'front.'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('new-subscribe', [NewsSubscribeController::class, 'subscribe'])->name('news.subscribe');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    Route::controller(ShowSinglePostController::class)->name('show.')->prefix('post')->group(function () {
        Route::get('{slug}', 'showSinglePost')->name('post');
        Route::get('comments/{slug}', 'showPostComments')->name('post.comments');
        Route::post('comments/store', 'storePostComment')->name('store.post.comments');
    });

    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
    });

});


