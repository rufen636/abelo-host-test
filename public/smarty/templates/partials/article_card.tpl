<div class="article-card">
    {if $article.image}
        <a href="/article/{$article.id}">
            <img src="{$article.image}" alt="{$article.title}" class="article-card__img">
        </a>
    {/if}
    <div class="article-card__body">
        <h3 class="article-card__title">
            <a href="/article/{$article.id}">{$article.title}</a>
        </h3>
        {if $article.description}
            <p class="article-card__desc">{$article.description}</p>
        {/if}
        <div class="article-card__meta">
            {if $article.published_at}
                <span class="article-card__date">{$article.published_at|date_format:"d.m.Y"}</span>
            {/if}
            <span class="article-card__views">Просмотров: {$article.views|default:0}</span>
        </div>
    </div>
</div>