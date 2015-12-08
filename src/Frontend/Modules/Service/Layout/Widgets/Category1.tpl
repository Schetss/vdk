{*
    variables that are available:
    - {$widgetServiceCategory1}:
*}

{option:widgetServiceCategory1}

	<section>
		<ul class="matrix-list matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3 reset-list listBlock">


	{iteration:widgetServiceCategory1}<li>
			<div class="entry entry-box box entry-alt group">
        		<h3><a href="{$widgetServiceCategory1.link}">{$widgetServiceCategory1.title}</a></h3>
    			<p></p>
    			<div>
    				<a href="{$widgetServiceCategory1.link}">
    				<img height="200" alt="PACCAR Genuine Parts Packaging" width="400" src="{$SITE_URL}/src/Frontend/Files/Service/afbeelding/400x300/{$widgetServiceCategory1.img}"></a>
    				<div>
						{$widgetServiceCategory1.content}
					</div>
					<p></p>
					<a href="{$widgetServiceCategory1.link}" target="" title="" class="button button-att" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetServiceCategory1.linktext}</a>
				</div>
			</div>
		</li>{/iteration:widgetServiceCategory1}
    

    </ul>    
    </section>

{/option:widgetServiceCategory1}

