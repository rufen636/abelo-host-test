{extends file='layouts/main.tpl'}

{block name=title}404 — Страница не найдена{/block}

{block name=content}
    <div class="error-page">
        <h1 class="error-page__code">404</h1>
        <p class="error-page__message">Страница не найдена</p>
        <a href="/" class="btn btn--primary">На главную</a>
    </div>
{/block}