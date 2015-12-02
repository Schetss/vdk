{*
    variables that are available:
    - {$widgetCallToActionMainWidget}:
*}

{option:widgetCallToActionMainWidget}
	{iteration:widgetCallToActionMainWidget}
	<div class="block">
		<div class="grid-item">
		    <div class="entry entry-box group">
		        <h3>
	            	<a id="maincontent_0_contentgrid_0_column1_3_HypTeaserTitle" href="{$widgetCallToActionMainWidget.link}">{$widgetCallToActionMainWidget.title}</a>
		        </h3>
		            
		        <a href="{$widgetCallToActionMainWidget.link}">
		        <img src="{$SITE_URL}/src/Frontend/Files/CallToAction/afbeelding/400x200/{$widgetCallToActionMainWidget.img}" alt="{$widgetCallToActionMainWidget.title}" class="fl">
		        </a>
		        
		        {$widgetCallToActionMainWidget.content}

		        <a href="{$widgetCallToActionMainWidget.link}" target="" title="" class="button button-att" text="" parameters="System.Collections.Specialized.NameValueCollection">Lees meer</a>

		        
		    </div>
		</div>
	</div>
{/iteration:widgetCallToActionMainWidget}
{/option:widgetCallToActionMainWidget}