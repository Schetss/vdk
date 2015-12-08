{*
    variables that are available:
    - {$widgetProductenCategory1}:
*}

{option:widgetProductenCategory1}

    <section>
        <ul class="matrix-list matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3 reset-list listBlock">


    {iteration:widgetProductenCategory1}<li>
            <div class="entry entry-box box entry-alt group">
                <h3><a href="{$widgetProductenCategory1.link}">{$widgetProductenCategory1.title}</a></h3>
                <p></p>
                <div>
                    <a href="{$widgetProductenCategory1.link}">
                    <img height="200" alt="PACCAR Genuine Parts Packaging" width="400" src="{$SITE_URL}/src/Frontend/Files/Producten/afbeelding/400x300/{$widgetProductenCategory1.img}"></a>
                    <div>
                        {$widgetProductenCategory1.content}
                    </div>
                    <p></p>
                    <a href="{$widgetProductenCategory1.link}" target="" title="" class="button button-att" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetProductenCategory1.linktext}</a>
                </div>
            </div>
        </li>{/iteration:widgetProductenCategory1}
    

    </ul>    
    </section>

{/option:widgetProductenCategory1}

