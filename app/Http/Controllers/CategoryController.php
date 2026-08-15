<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;

class CategoryController extends BaseController
{
    public static function index(int $id)
    {
        parent::initSmarty();

        $category = CategoryService::getCategoryById($id);

        if (!$category) {
            http_response_code(404);
            return parent::$smarty->display('404.tpl');
        }

        $sort = $_GET['sort'] ?? 'date';
        $page = (int)($_GET['page'] ?? 1);

        $result = CategoryService::getArticlesByCategory($id, $sort, $page, 5);

        parent::$smarty->assign('category', $category);
        parent::$smarty->assign('articles', $result['articles']);
        parent::$smarty->assign('totalPages', $result['totalPages']);
        parent::$smarty->assign('currentPage', $result['currentPage']);
        parent::$smarty->assign('sort', $sort);

        return parent::$smarty->display('category.tpl');
    }

    public static function categoriesWithPosts()
    {
        header('Content-Type: application/json');
        return json_encode(CategoryService::categoriesWithPosts());
    }
}