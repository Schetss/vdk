{*
    variables that are available:
    - {$widgetOpeningsurenCategories}:
*}

{option:widgetOpeningsurenCategories}
    <section id="OpeningsurenCategoriesWidget" class="mod">
        <div class="inner">
            <header class="hd">
                <h3>{$lblCategories|ucfirst}</h3>
            </header>
            <div class="bd content">
                <ul>
                    {iteration:widgetOpeningsurenCategories}
                        <li>
                            <a href="{$widgetOpeningsurenCategories.url}">
                                {$widgetOpeningsurenCategories.label}&nbsp;({$widgetOpeningsurenCategories.total})
                            </a>
                        </li>
                    {/iteration:widgetOpeningsurenCategories}
                </ul>
            </div>
        </div>
    </section>
{/option:widgetOpeningsurenCategories}
