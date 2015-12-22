{*
    variables that are available:
    - {$widgetVacaturesCategories}:
*}

{option:widgetVacaturesCategories}
    <section id="VacaturesCategoriesWidget" class="mod">
        <div class="inner">
            <header class="hd">
                <h3>{$lblCategories|ucfirst}</h3>
            </header>
            <div class="bd content">
                <ul>
                    {iteration:widgetVacaturesCategories}
                        <li>
                            <a href="{$widgetVacaturesCategories.url}">
                                {$widgetVacaturesCategories.label}&nbsp;({$widgetVacaturesCategories.total})
                            </a>
                        </li>
                    {/iteration:widgetVacaturesCategories}
                </ul>
            </div>
        </div>
    </section>
{/option:widgetVacaturesCategories}
