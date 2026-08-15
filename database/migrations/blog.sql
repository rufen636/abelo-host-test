CREATE TABLE IF NOT EXISTS categories
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL
    );

CREATE TABLE IF NOT EXISTS articles
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(500) NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    content LONGTEXT NOT NULL,
    published_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    views INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS article_categories
(
    article_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY(article_id,category_id),
    FOREIGN KEY(article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY(category_id) REFERENCES categories(id)ON DELETE CASCADE
);