{*
	variables that are available:
	- {$items}: contains an array with all posts, each element contains data about the post
*}

{option:items}

	<div class="block gridMasonry">	
		<div class="grid-item floatGrid"><div class="masonryWrapper"><ul class="reset-list matrix-list listMasonry listOver matrix-list-xs-1 matrix-list-s-2 matrix-list-m-3">{iteration:items}<li><div class="floatGridSizer"></div><div class="box"><div class="box-inner box-inner-header"><img src="{$SITE_URL}/src/Frontend/Files/OverOns/afbeelding/Source/{$items.afbeelding}" /></div><div class="box-header box-footer"><h2 class="alphaBeta">{$items.datum}</h2><p class="boldSub">{$items.titel}</p>{$items.tekst}</div></div></li>{/iteration:items}<div class="clear"></div></ul></div></div>
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
				        <div class="media-lightbox-img"><div class="prev-arrow"></div><img class="media-preview" src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/Source/vrd.jpg"><div class="next-arrow"></div>
				        </div>
				    </div>
	    			<button class="close close-overlay">close</button>
	    		</div>
	    	</div>
	    </div> 
	</div>
{/option:items}



	