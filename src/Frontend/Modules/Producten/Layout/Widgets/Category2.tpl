{*
    variables that are available:
    - {$widgetProductenCategory2}:
*}

{option:widgetProductenCategory2}

   <section>
        <ul class="matrix-list matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3 reset-list listBlock">


    {iteration:widgetProductenCategory2}<li>
            <div class="entry entry-box box group">
                <h3><a href="{$widgetProductenCategory2.link}">{$widgetProductenCategory2.title}</a></h3>
                <p></p>
                <div>
                    <div>
                        {$widgetProductenCategory2.content}
                    </div>
                    <p></p>
                    <a href="{$widgetProductenCategory2.link}" target="" title="" class="button" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetProductenCategory2.linktext}</a>
                </div>
            </div>
        </li>{/iteration:widgetProductenCategory2}
    

    </ul>    
    </section>

{/option:widgetProductenCategory2}
