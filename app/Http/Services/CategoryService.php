<?php

namespace App\Http\Services;

use Connection;

class CategoryService
{
    public static function categoriesWithPosts()
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
}