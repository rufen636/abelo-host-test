<?php


use App\Http\Controllers\HomeController;
use Framework\Route\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

//web
Route::get('/',  [HomeController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'index']);
Route::get('/article/{id}', [ArticleController::class, 'index']);

//api
Route::get('/api/categories-with-posts',[CategoryController::class, 'categoriesWithPosts']);

