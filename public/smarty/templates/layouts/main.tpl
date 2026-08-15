<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name=title}Default Title{/block}</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="/css/app.css">
    {block name=styles}{/block}
</head>
<body>
    <header>
        <nav>
            <a href="/" class="logo">Test</a>
            <ul class="nav-links">
                <li><a href="/">Главная</a></li>
            </ul>
        </nav>
    </header>

    <main>
        {block name=content}{/block}
    </main>

    <footer>
        <p>&copy; 2026 Test. All rights reserved.</p>
    </footer>
</body>
</html>