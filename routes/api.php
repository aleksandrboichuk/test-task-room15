<?php

use App\Http\Controllers\Api\Resource\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);

Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::resource('products', ProductController::class)->middleware('auth:api');


