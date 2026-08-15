<?php


use App\Http\Controllers\HomeController;
use Framework\Route\Route;
use App\Http\Controllers\CategoryController;

//web
Route::get('/',  [HomeController::class, 'index']);

//api
Route::get('/api/categories-with-posts',[CategoryController::class, 'categoriesWithPosts']);

