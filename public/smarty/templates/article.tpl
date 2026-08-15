{extends file='layouts/main.tpl'}

{block name=title}{$article.title}{/block}

{block name=content}
    <article class="article-detail">
        <a href="/" class="back-link">&larr; На главную</a>

        {if $article.image}
            <img src="{$article.image}" alt="{$article.title}" class="article-detail__img">
        {/if}

        <h1 class="article-detail__title">{$article.title}</h1>

        <div class="article-detail__meta">
            {if $article.published_at}
                <span>{$article.published_at|date_format:"d.m.Y"}</span>
            {/if}
            <span>Просмотров: {$article.views}</span>
        </div>

        {if $article.categories}
            <div class="article-detail__categories">
                {foreach from=$article.categories item=cat}
                    <a href="/category/{$cat.id}" class="tag">{$cat.name}</a>
                {/foreach}
            </div>
        {/if}

        {if $article.description}
            <p class="article-detail__desc">{$article.description}</p>
        {/if}

        <div class="article-detail__content">
            {$article.content}
        </div>
    </article>

    {if $relatedArticles}
        <section class="related-articles">
            <h2 class="related-articles__title">Похожие статьи</h2>
            <div class="articles-grid">
                {foreach from=$relatedArticles item=article}
                    {include file='partials/article_card.tpl' article=$article}
                {/foreach}
            </div>
        </section>
    {/if}
{/block}