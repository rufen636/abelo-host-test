<?php

namespace App\Http\Controllers;

use App\Http\Services\ArticleService;

class ArticleController extends BaseController
{
    public static function index(int $id)
    {
        parent::initSmarty();

        $article = ArticleService::getArticleById($id);

        if (!$article) {
            http_response_code(404);
            return parent::$smarty->display('404.tpl');
        }

        ArticleService::incrementViews($id);
        $article['views']++;

        $relatedArticles = ArticleService::getRelatedArticles($id, 3);

        parent::$smarty->assign('article', $article);
        parent::$smarty->assign('relatedArticles', $relatedArticles);

        return parent::$smarty->display('article.tpl');
    }
}