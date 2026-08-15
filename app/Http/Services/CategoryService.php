<?php

namespace App\Http\Services;

use Connection;

class CategoryService
{
    public static function categoriesWithPosts(): array
    {
        $db = Connection::getInstance();
        $sql = "
            SELECT 
                c.id as category_id,
                c.name as category_name,
                c.description as category_description,
                a.id as article_id,
                a.title,
                a.image,
                a.description as article_description,
                a.content,
                a.views
            FROM categories c
            LEFT JOIN article_categories ac ON c.id = ac.category_id
            LEFT JOIN articles a ON ac.article_id = a.id
            ORDER BY c.id, a.id
        ";

        $rows = $db->fetchAll($sql);
        $categories = [];

        foreach ($rows as $row) {
            $categoryId = $row['category_id'];

            if (!isset($categories[$categoryId])) {
                $categories[$categoryId] = [
                    'id' => $row['category_id'],
                    'name' => $row['category_name'],
                    'description' => $row['category_description'],
                    'articles' => []
                ];
            }

            if ($row['article_id'] !== null) {
                $categories[$categoryId]['articles'][] = [
                    'id' => $row['article_id'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'description' => $row['article_description'],
                    'content' => $row['content'],
                    'views' => $row['views']
                ];
            }
        }

        return array_values($categories);
    }

    public static function getCategoriesWithLatestArticles(int $limit = 3): array
    {
        $db = Connection::getInstance();

        $categories = $db->fetchAll(
            "SELECT DISTINCT c.id, c.name, c.description
             FROM categories c
             INNER JOIN article_categories ac ON c.id = ac.category_id
             ORDER BY c.id"
        );

        $result = [];
        foreach ($categories as $cat) {
            $articles = $db->fetchAll(
                "SELECT a.id, a.title, a.image, a.description, a.views, a.published_at
                 FROM articles a
                 INNER JOIN article_categories ac ON a.id = ac.article_id
                 WHERE ac.category_id = :category_id
                 ORDER BY a.published_at DESC
                 LIMIT :limit",
                [
                    'category_id' => $cat['id'],
                    'limit' => $limit,
                ]
            );

            $cat['articles'] = $articles;
            $result[] = $cat;
        }

        return $result;
    }

    public static function getCategoryById(int $id): ?array
    {
        $db = Connection::getInstance();
        return $db->fetchOne(
            "SELECT id, name, description FROM categories WHERE id = :id",
            ['id' => $id]
        );
    }

    public static function getArticlesByCategory(int $categoryId, string $sort = 'date', int $page = 1, int $perPage = 5): array
    {
        $db = Connection::getInstance();

        $orderBy = match ($sort) {
            'views' => 'a.views DESC',
            'date' => 'a.published_at DESC',
            default => 'a.published_at DESC',
        };

        $offset = ($page - 1) * $perPage;

        $total = $db->fetchOne(
            "SELECT COUNT(*) as cnt
             FROM articles a
             INNER JOIN article_categories ac ON a.id = ac.article_id
             WHERE ac.category_id = :category_id",
            ['category_id' => $categoryId]
        );

        $totalArticles = (int)($total['cnt'] ?? 0);
        $totalPages = max(1, (int)ceil($totalArticles / $perPage));

        $articles = $db->fetchAll(
            "SELECT a.id, a.title, a.image, a.description, a.content, a.views, a.published_at
             FROM articles a
             INNER JOIN article_categories ac ON a.id = ac.article_id
             WHERE ac.category_id = :category_id
             ORDER BY {$orderBy}
             LIMIT :perPage OFFSET :offset",
            [
                'category_id' => $categoryId,
                'perPage' => $perPage,
                'offset' => $offset,
            ]
        );

        return [
            'articles' => $articles,
            'totalArticles' => $totalArticles,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
    }
}