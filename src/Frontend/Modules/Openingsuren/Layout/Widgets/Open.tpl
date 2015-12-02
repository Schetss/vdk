{*
    variables that are available:
    - {$widgetOpeningsurenOpen}:
*}

{option:widgetOpeningsurenOpen}
    <section id="SelectielijstCategoriesWidget" class="mod">
        <div class="inner">
            <header class="hd">
                <h3>{$lblCategories|ucfirst}</h3>
            </header>
            <div class="bd content">
                <ul>
                    {iteration:widgetOpeningsurenOpen}
                        <li>
                            {$widgetOpeningsurenOpen.name}
                            <h3>GREEN</h3>

                        </li>
                    {/iteration:widgetOpeningsurenOpen}
                </ul>
            </div>
        </div>
    </section>
{/option:widgetOpeningsurenOpen}


{option:!widgetOpeningsurenOpen}
<h3>RED</h3>
{/option:!widgetOpeningsurenOpen}