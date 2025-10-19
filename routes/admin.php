<?php

use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => "admin."], function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.show');
        Route::post('/login/check', 'login')->name('login.check');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::name('password.')->prefix('password')->controller(ForgetPasswordController::class)->group(function () {
        Route::get('/email', 'showResetForm')->name('reset.show');
        Route::post('/email', 'sendOtp')->name('send.otp');
        Route::get('/verify/{email}', 'verifyOtp')->name('verify.otp');
        Route::post('/verify', 'verifyOtpcheck')->name('verify.otp.check');
    });

    Route::name('reset.')->prefix('reset')->controller(ResetPasswordController::class)->group(function () {
        Route::get('/', 'showResetForm')->name('reset.show');
        Route::post('/', 'resetPassword')->name('reset.update');
    });

    Route::middleware('auth-admin')->group(function () {

        Route::get('/home', function () {
            return view('admin.index');
        })->name('home');
    });

});

