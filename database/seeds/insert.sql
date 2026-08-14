INSERT INTO categories (name, description)
VALUES ('Технологии', 'Статьи о технологиях и IT'),
       ('Путешествия', 'Статьи о путешествиях'),
       ('Кулинария', 'Кулинарные рецепты');

INSERT INTO articles (image, title, description, content, views)
VALUES ('/images/some.png', 'Искусственный интеллект', 'Кратко об ИИ', 'lorem', 150),
       ('/images/some.png', 'Путешествие в Италию', 'Мои приключения', 'lorem', 85),
       ('/images/some.png', 'Вкусная пицца', 'Секреты приготовления', 'lorem', 230);

INSERT INTO article_categories (article_id, category_id)
VALUES (1, 1),
       (1, 2),
       (2, 2),
       (3, 3),
       (3, 1);