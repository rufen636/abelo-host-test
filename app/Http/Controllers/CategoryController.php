<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Services\CategoryService;


class CategoryController extends BaseController
{
    public static function categoriesWithPosts()
    {
        header('Content-Type: application/json');
        return json_encode(CategoryService::categoriesWithPosts());
    }
}