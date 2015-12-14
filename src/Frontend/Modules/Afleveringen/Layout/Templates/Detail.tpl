{option:$item}
	{iteration:$item}
		<div class="page-overlay ">
			<div class="page-overlay-outer">
				<div class="page-overlay-inner">
					<div class="dialog">
						<div id="maincontent_0_RepMediaInfo_slMediaInfo_2_PnlMediaItem_2" class="box media-lightbox" data-behaviour="daf.ui.DialogMedia"  data-processed="true" data-initialized="true" tabindex="-1">
					   		<div class="box-inner box-inner-small">
					            <h2 class="delta stacked">{$item.titel}</h2>
					        </div>
					        <div class="media-lightbox-img"><img class="media-preview" src="{$SITE_URL}/src/Frontend/Files/Afleveringen/afbeelding/Source/{$items.afbeelding}">
					        </div>
					    </div>
		    			<button class="close">close</button>
		    		</div>
		    	</div>
		    </div> 
		</div>
	{/iteration:$item}
{/option:$item}