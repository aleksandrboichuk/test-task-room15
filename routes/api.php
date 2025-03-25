<?php

use App\Http\Controllers\Api\Resource\ProductController;
use App\Interfaces\ApiAuthInterface;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiAuthInterface::class, 'login']);

Route::resource('products', ProductController::class)->middleware('auth:api');


