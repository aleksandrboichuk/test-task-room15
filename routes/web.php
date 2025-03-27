<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Resource\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login', [], 301);
});

Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('email')
    ->controller(VerificationController::class)
    ->middleware('auth')
    ->group(function() {

    Route::get('/verify', 'show')->name('verification.notice');
    Route::post('/verify/resend', 'resend')->name('verification.resend');
    Route::get('/verify/{id}/{hash}', 'verify')
        ->middleware('signed')
        ->name('verification.verify');
});

Route::controller(ForgotPasswordController::class)->group(function() {
    Route::get('/forgot-password', 'forgotPasswordForm')->name('forgot.password');
    Route::post('/forgot-password', 'sendResetLink')->name('password.reset.link');
});

Route::controller(ResetPasswordController::class)->group(function() {
    Route::get('/reset-password/{token}', 'resetPasswordForm')
        ->name('reset.password')
        ->where(['token' => '[a-zA-Z0-9]{60}']);
    Route::post('/reset-password', 'reset')->name('password.update');
});

Auth::routes();

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
