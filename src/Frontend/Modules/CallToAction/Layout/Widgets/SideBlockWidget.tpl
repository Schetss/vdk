{*
    variables that are available:
    - {$widgetCallToActionSideBlock}:
*}

{option:widgetCallToActionSideBlock}
  {iteration:widgetCallToActionSideBlock}
  <div class="grid-item">
			  <div class="block">

		<a href="{$widgetCallToActionSideBlock.link}">
		<figure class="banner">
		     <img src="{$SITE_URL}/src/Frontend/Files/CallToAction/afbeelding/400x200/{$widgetCallToActionSideBlock.img}" class="stacked">
		    <figcaption id="maincontent_0_contentgrid_0_column2_5_FgCaption">
		        <div class="stacked"><p><span class="bold">{$widgetCallToActionSideBlock.title}: </span> {$widgetCallToActionSideBlock.linktext}</p></div>
		    </figcaption>
		</figure>

		</a>
	</div></div>
  {/iteration:widgetCallToActionSideBlock}
{/option:widgetCallToActionSideBlock}