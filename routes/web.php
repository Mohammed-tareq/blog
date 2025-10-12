<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscribeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\SearchController;


Auth::routes();


Route::name('front.')->group(function () {
    // home page route
    Route::get('/', [HomeController::class, 'index'])->name('index');
    //new subscribes route in home page
    Route::post('/new-subscribe', NewSubscribeController::class)->name('new-subscribe');
    //category route
    Route::get('category/{slug}', CategoryController::class)->name('category');


    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
    //single post route
    Route::get('/{slug}',  'singlePost')->name('single-post');
    //get all comments by ajax for single post
    Route::get('/{slug}/comments',  'getComments')->name('getAllComments');
    //store comment
    Route::post('/comment/store',  'storePost')->name('comment.store');
    });


    Route::name('contact.')->prefix('contact-us')->group(function () {
        Route::get('/', [ContactUsController::class, 'index'])->name('index');
        Route::post('/store', [ContactUsController::class, 'store'])->name('store');
    });

    Route::match(['get', 'post'], '/search', SearchController::class)->name('search');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
