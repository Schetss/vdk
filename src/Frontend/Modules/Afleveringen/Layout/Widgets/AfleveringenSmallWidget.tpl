{*
    variables that are available:
    - {$widgetAfleveringenSmall}:
*}
<div class="block">	

	<div class="grid-item">
		<h2>Laatste Afleveringen</h2>
	</div>

	<div class="grid-item">
		{option:widgetAfleveringenSmall}
		 	<ul class="reset-list matrix-list matrix-list-xs-1 matrix-list-s-2 afl-widget-list">{iteration:widgetAfleveringenSmall}<li><div class="box"><a href="#"><div class="box-inner box-inner-header"><img src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/800x600/{$widgetAfleveringenSmall.img}" /></div><div class="box-header box-footer"><h2 class="alphabeta">{$widgetAfleveringenSmall.title}</h2></div></a></div></li>{/iteration:widgetAfleveringenSmall}</ul>
		{/option:widgetAfleveringenSmall}
	 <a href="{$SITE_URL}/nieuws-media/afleveringen" class="more">ontdek al onze afleveringen</a>
	</div>

</div>


<div class="page-overlay displayNone">
	<div class="clickRegistration">
	</div>
	<div class="page-overlay-outer">
		<div class="page-overlay-inner">
			<div class="dialog">
				<div id="maincontent_0_RepMediaInfo_slMediaInfo_2_PnlMediaItem_2" class="box media-lightbox" data-behaviour="daf.ui.DialogMedia"  data-processed="true" data-initialized="true" tabindex="-1">
			   		<div class="box-inner box-inner-small">
			            <h2 class="delta stacked">Test titel</h2>
			        </div>
			        <div class="media-lightbox-img"><div class="prev-arrow-widget"></div><img class="media-preview" src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/Source/vrd.jpg"><div class="next-arrow-widget"></div>
			        </div>
			    </div>
    			<button class="close close-overlay">close</button>
    		</div>
    	</div>
    </div> 
</div>
