{*
    variables that are available:
    - {$widgetAfleveringLarge}:
*}
<div class="block">	

	<div class="grid-item">
		<h2>Laatste Afleveringen</h2>
	</div>

	<div class="grid-item">
		{option:widgetAfleveringLarge}
		 	<ul class="reset-list matrix-list matrix-list-xs-1">{iteration:widgetAfleveringLarge}<li><div class="box"><a href="#"><div class="box-inner box-inner-header"><img src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/800x600/{$widgetAfleveringLarge.img}" /></div><div class="box-header box-footer"><h2 class="alphabeta">{$widgetAfleveringLarge.title}</h2></div></a></div></li>{/iteration:widgetAfleveringLarge}</ul>
		{/option:widgetAfleveringLarge}
	 <a href="{$SITE_URL}/nieuws-media/afleveringen" class="more">ontdek al onze afleveringen</a>
	</div>

</div>