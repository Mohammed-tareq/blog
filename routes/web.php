<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscribeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;


// home page route

Route::name('front.')->group(function () {
    // home page route
    Route::get('/', [HomeController::class, 'index'])->name('index');
    //new subscribes route in home page
    Route::post('/new-subscribe', NewSubscribeController::class)->name('new-subscribe');
    //category route
    Route::get('category/{slug}', CategoryController::class)->name('category');
    //single post route
    Route::get('post/{slug}', [PostController::class, 'singlePost'])->name('single-post');
    //get all comments by ajax for single post
    Route::get('post/{slug}/comments', [PostController::class, 'getComments'])->name('getAllComments');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
