{*
    variables that are available:
    - {$widgetCallToActionFacebook}:
*}

{option:widgetCallToActionFacebook}
	{iteration:widgetCallToActionFacebook}

		<div class="grid-item">
				<div class="block">
			<a href="{$widgetCallToActionFacebook.link}">
			<figure class="banner fbBanner">
			     <img src="{$SITE_URL}/src/Frontend/Files/CallToAction/afbeelding/400x200/{$widgetCallToActionFacebook.img}" class="stacked fbImage">
			   
			        <a href="{$widgetCallToActionFacebook.link}" target="" title="" class="button button-att button-banner" text="" parameters="System.Collections.Specialized.NameValueCollection">{$widgetCallToActionFacebook.linktext}</a>
			   		
			</figure>

			</a>
		</div>
		</div>
	{/iteration:widgetCallToActionFacebook}
{/option:widgetCallToActionFacebook}



		        