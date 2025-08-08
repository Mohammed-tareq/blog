<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.index');
});

Route::get("/contact", function () {
    return view('front.contact');
})->name('contact');
