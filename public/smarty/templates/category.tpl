{extends file='layouts/main.tpl'}

{block name=title}{$category.name}{/block}

{block name=content}
    <div class="category-header">
        <h1 class="page-title">{$category.name}</h1>
        {if $category.description}
            <p class="category-header__desc">{$category.description}</p>
        {/if}
    </div>

    <div class="sort-bar">
        <span class="sort-bar__label">Сортировка:</span>
        <a href="/category/{$category.id}?sort=date{if $currentPage > 1}&page={$currentPage}{/if}"
           class="sort-bar__link{if $sort == 'date'} sort-bar__link--active{/if}">По дате</a>
        <a href="/category/{$category.id}?sort=views{if $currentPage > 1}&page={$currentPage}{/if}"
           class="sort-bar__link{if $sort == 'views'} sort-bar__link--active{/if}">По просмотрам</a>
    </div>

    {if $articles}
        <div class="articles-grid">
            {foreach from=$articles item=article}
                {include file='partials/article_card.tpl' article=$article}
            {/foreach}
        </div>
    {else}
        <p class="empty-state">В этой категории пока нет статей</p>
    {/if}

    {if $totalPages > 1}
        <nav class="pagination">
            {if $currentPage > 1}
                <a href="/category/{$category.id}?sort={$sort}&page={$currentPage - 1}"
                   class="pagination__link">&laquo; Назад</a>
            {/if}

            {for $p = 1 to $totalPages}
                {if $p == $currentPage}
                    <span class="pagination__link pagination__link--active">{$p}</span>
                {else}
                    <a href="/category/{$category.id}?sort={$sort}&page={$p}"
                       class="pagination__link">{$p}</a>
                {/if}
            {/for}

            {if $currentPage < $totalPages}
                <a href="/category/{$category.id}?sort={$sort}&page={$currentPage + 1}"
                   class="pagination__link">Вперёд &raquo;</a>
            {/if}
        </nav>
    {/if}
{/block}