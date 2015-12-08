{*
    variables that are available:
    - {$widgetServiceCategory2}:
*}

{option:widgetServiceCategory2}

   <section>
		<ul class="matrix-list matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3 reset-list listBlock">


	{iteration:widgetServiceCategory2}<li>
			<div class="entry entry-box box group">
        		<h3><a href="{$widgetServiceCategory2.link}">{$widgetServiceCategory2.title}</a></h3>
    			<p></p>
    			<div>
    				<div>
						{$widgetServiceCategory2.content}
					</div>
					<p></p>
					<a href="{$widgetServiceCategory2.link}" target="" title="" class="button" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetServiceCategory2.linktext}</a>
				</div>
			</div>
		</li>{/iteration:widgetServiceCategory2}
    

    </ul>    
    </section>

{/option:widgetServiceCategory2}
