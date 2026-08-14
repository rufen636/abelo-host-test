<?php


use App\Http\Controllers\HomeController;
use Framework\Route\Route;

Route::get('/',  [HomeController::class, 'index']);

