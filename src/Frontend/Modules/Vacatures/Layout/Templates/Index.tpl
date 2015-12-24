{option:items}
<div class="grid-item block">
	<div class="dropdown-wrapper">
	    <ul class="reset-list dropdown vacature-list" data-behaviour="mira.ui.SelectToTab" data-switch='{"window":{"minWidth":600}}'>
	    	{iteration:items}
		        <li>
		            <a href="#{$items.titel}" data-behaviour="mira.ui.ToggleTrigger" data-toggle-target="tab1" data-group="tabs-nav" data-prevent-close="true" data-state="" data-title="{$items.titel}" data-content="{$items.omschrijving}">{$items.titel}</a></li>
		        <li>
	        {/iteration:items}
	    </ul>
	</div>
</div>

<div class="grid-items group block">
	<div class="grid-m-2of3">
		<div class="grid-item vacature-content">
		</div>
	</div>
	<div class="grid-m-1of3">
		<div class="grid-item">
			<div class="grid-item-content block">
				<div class="stacked">
					<h3>Deel deze vacature(s)</h3>
					<ul class="vacature-sm">
						<li class="linkedin">
							<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: nl_NL</script>
							<script type="IN/Share" data-url="{$SITE_URL}/vacatures" data-counter="right"></script>
						</li>
						<li class="facebook fb-share-button">
							<div class="fb-share-button" data-href="{$SITE_URL/vacatures}" data-layout="button_count"></div>
						</li>

						<li class="twitter">
							<a href="https://twitter.com/share" class="twitter-share-button"{count} data-hashtags="vacature">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						</li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
			<a href="mailto:gert@garagevandenkeybus.be" class="button-att button button-top vacature-solliciteren" title="Solliciteren">Nu solliciteren</a>
		</div>
	</div>
</div>


{/option:items}