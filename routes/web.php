<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
    
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
