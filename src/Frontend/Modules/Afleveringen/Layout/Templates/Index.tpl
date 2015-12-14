{option:items}
	<!-- {include:Modules/Afleveringen/Layout/Templates/Hover.tpl} -->

	<div class="block gridMasonry">	
		<div class="grid-item floatGrid"><div class="masonryWrapper"><ul class="reset-list matrix-list listMasonry listOver matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3">{iteration:items}<li><a href="/#{$items.id}"><div class="floatGridSizer"></div><div class="box"><div class="box-inner box-inner-header"><img src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/Source/{$items.afbeelding}" /></div><div class="box-header box-footer"><h2 class="alphaBeta2">{$items.titel}</h2></div></div></a></li>{/iteration:items}<div class="clear"></div></ul></div></div>
	</div>

{/option:items}
