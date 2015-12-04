{*
	variables that are available:
	- {$items}: contains an array with all posts, each element contains data about the post
*}

{option:items}

<div class="block gridMasonry">	
	<div class="grid-item floatGrid"><ul class="reset-list matrix-list listMasonry listOver matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3">{iteration:items}<li class=><div class="floatGridSizer"></div><div class="box"><div class="box-inner box-inner-header"><img src="{$SITE_URL}/src/Frontend/Files/OverOns/afbeelding/600x600/{$items.afbeelding}" /></div><div class="box-header box-footer"><h2 class="alphabeta">{$items.datum}</h2><p class="boldSub">{$items.titel}</p>{$items.tekst}</div></div></li>{/iteration:items}<div class="clear"></div></ul></div>
</div>

{/option:items}
