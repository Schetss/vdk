{*
    variables that are available:
    - {$items}:
*}

{option:items}
<div class="grid-items">
	<div class="grid-item">
	
        <ul class="matrix-list matrix-list-xs-1 reset-list listBlock">

			{iteration:items}<li>
	            <div class="entry entry-box box group">
	            	<div class="grid-items grid-items-float group">
						<div class="img2de">
							 <img height="200" alt="PACCAR Genuine Parts Packaging" width="400" src="{$SITE_URL}/src/Frontend/Files/DeHandswagens/afbeelding/600x600/{$items.afbeelding}"></a>
		                </div>
						
						<div class="content2de">
							<h2>{$items.titel}<h2>
							<h3>{$items.subtitel}</h3>
			                <p></p>
		                    <div>
		                        {$items.tekst}
		                    </div>
		                    <a href="{$SITE_URL}/src/Frontend/Files/DeHandswagens/files/{$items.pdffile}"  class="button button-att" download="{$items.titel}" parameters="System.Collections.Specialized.NameValueCollection">Download pdf</a>
						</div>
	                </div>
            	</div>
	        </li>{/iteration:items}
    	</ul>
    	<div class="clear"></div>    
    </div>
</div>

{/option:items}


{include:Core/Layout/Templates/Pagination.tpl}


{option:!items} 
		<div class="grid-items">
			<div class="grid-item">
				<h2 class="emptyCall">Momenteel zijn er geen 2de handswagens beschikbaar.</h2>
				<div class="clear"></div>
			</div>
		</div>

{/option:!items}