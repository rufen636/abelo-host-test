$(document).ready(function () {
    $.getJSON('/api/categories-with-posts', function (categories) {
        var $container = $('#categoriesContainer');
        $container.empty();

        categories.forEach(function (category) {
            var $block = $('<div class="category-block">');
            $block.append('<h2>' + category.name + '</h2>');
            $block.append('<p>' + (category.description || '') + '</p>');

            var $articles = $('<div class="articles-list">');

            if (category.articles.length === 0) {
                $articles.append('<p>Нет статей в этой категории</p>');
            } else {
                category.articles.forEach(function (article) {
                    var $item = $('<div class="article-item">');

                    if (article.image) {
                        $item.append('<img src="' + article.image + '" alt="' + article.title + '" width="100">');
                    }

                    $item.append('<h3>' + article.title + '</h3>');
                    $item.append('<p>' + (article.description || '') + '</p>');
                    $item.append('<span>Просмотров: ' + (article.views || 0) + '</span>');

                    $articles.append($item);
                });
            }

            $block.append($articles);
            $container.append($block);
        });
    }).fail(function (jqXHR, textStatus, error) {
        $('#categoriesContainer').html('<p style="color:red;">Ошибка загрузки: ' + error + '</p>');
    });
});