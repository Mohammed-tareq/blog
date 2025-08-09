<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get("/", [HomeController::class ,"index"])->name("home");
Route::get("/contact", function () {
    return view('front.contact');
})->name('contact');

