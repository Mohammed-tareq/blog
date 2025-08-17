<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\NewsSubscribeController;
use App\Http\Controllers\Front\ShowSinglePostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'front.'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('new-subscribe', [NewsSubscribeController::class, 'subscribe'])->name('news.subscribe');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    Route::get('post/{slug}', [ShowSinglePostController::class, 'showSinglePost'])->name('show.post');
    Route::get('post/comments/{slug}', [ShowSinglePostController::class, 'showPostComments'])->name('show.post.comments');
    Route::post('post/comments/store', [ShowSinglePostController::class, 'storePostComment'])->name('store.post.comments');
});


Route::get('/contact', function () {
    return view('front.contact');
})->name('front.contact');
