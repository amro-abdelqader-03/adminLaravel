<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
    
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
Route::resource('sellers', SellerController::class);
Route::resource('products', ProductController::class);
