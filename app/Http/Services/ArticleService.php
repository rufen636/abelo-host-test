<?php

namespace App\Http\Services;

use Connection;

class ArticleService
{
    public static function getArticleById(int $id): ?array
    {
        $db = Connection::getInstance();

        $article = $db->fetchOne(
            "SELECT id, image, title, description, content, views, published_at
             FROM articles
             WHERE id = :id",
            ['id' => $id]
        );

        if (!$article) {
            return null;
        }

        $categories = $db->fetchAll(
            "SELECT c.id, c.name
             FROM categories c
             INNER JOIN article_categories ac ON c.id = ac.category_id
             WHERE ac.article_id = :article_id",
            ['article_id' => $id]
        );

        $article['categories'] = $categories;

        return $article;
    }

    public static function getRelatedArticles(int $articleId, int $limit = 3): array
    {
        $db = Connection::getInstance();

        return $db->fetchAll(
            "SELECT DISTINCT a.id, a.title, a.image, a.description, a.views, a.published_at
             FROM articles a
             INNER JOIN article_categories ac1 ON a.id = ac1.article_id
             INNER JOIN article_categories ac2 ON ac1.category_id = ac2.category_id
             WHERE ac2.article_id = :article_id
               AND a.id != :exclude_id
             ORDER BY a.published_at DESC
             LIMIT :limit",
            [
                'article_id' => $articleId,
                'exclude_id' => $articleId,
                'limit' => $limit,
            ]
        );
    }

    public static function incrementViews(int $articleId): void
    {
        $db = Connection::getInstance();
        $db->query(
            "UPDATE articles SET views = views + 1 WHERE id = :id",
            ['id' => $articleId]
        );
    }
}