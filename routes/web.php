<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscribeController;
use App\Http\Controllers\Frontend\CategoryController;


// home page route

Route::name('front.')->group(function () {
    // home page route
    Route::get('/', [HomeController::class, 'index'])->name('index');
    //new subscribes route in home page
    Route::post('/new-subscribe', NewSubscribeController::class)->name('new-subscribe');
    //category route
    Route::get('category/{slug}', CategoryController::class)->name('category');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
