<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;



// home page route
Route::get('/', [HomeController::class,'index'])->name('home');









Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
