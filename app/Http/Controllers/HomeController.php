<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;

class HomeController extends BaseController
{
    public static function index()
    {
        parent::initSmarty();

        $categories = CategoryService::getCategoriesWithLatestArticles(3);

        parent::$smarty->assign('categories', $categories);

        return parent::$smarty->display('index.tpl');
    }
}