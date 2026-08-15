{extends file='layouts/main.tpl'}

{block name=title}Главная{/block}

{block name=content}
    <h1 class="page-title">Категории и последние статьи</h1>

    {if $categories}
        {foreach from=$categories item=category}
            <section class="category-block">
                <div class="category-block__header">
                    <h2 class="category-block__title">
                        <a href="/category/{$category.id}">{$category.name}</a>
                    </h2>
                    {if $category.description}
                        <p class="category-block__desc">{$category.description}</p>
                    {/if}
                </div>

                <div class="articles-grid">
                    {if $category.articles}
                        {foreach from=$category.articles item=article}
                            {include file='partials/article_card.tpl' article=$article}
                        {/foreach}
                    {else}
                        <p>Нет статей в этой категории</p>
                    {/if}
                </div>

                <a href="/category/{$category.id}" class="btn btn--outline">Все статьи</a>
            </section>
        {/foreach}
    {else}
        <p>Категории не найдены</p>
    {/if}
{/block}