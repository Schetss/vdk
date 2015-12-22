{option:items}
<div class="grid-item block">
	<div class="dropdown-wrapper">
	    <ul class="reset-list dropdown vacature-list" data-behaviour="mira.ui.SelectToTab" data-switch='{"window":{"minWidth":600}}'>
	    	{iteration:items}
		        <li>
		            <a data-behaviour="mira.ui.ToggleTrigger" data-toggle-target="tab1" data-group="tabs-nav" data-prevent-close="true" data-state="" data-title="{$items.titel}" data-content="{$items.omschrijving}">{$items.titel}</a></li>
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
					<h3>Deel deze vacature</h3>
					<ul class="vacature-sm">
						<li class="linkedin">
							<a href="https://www.facebook.com/profile.php?id=100008183017729" class="button-att button button-top" title="LinkedIn">LinkedIn</a>
						</li>
						<li class="facebook">
							<a href="https://www.facebook.com/profile.php?id=100008183017729" class="button-att button button-top" title="Facebook">Facebook</a>
						</li>
						<li class="twitter">
							<a href="https://www.facebook.com/profile.php?id=100008183017729" class="button-att button button-top" title="Twitter">Twitter</a>
						</li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
			<a href="https://www.facebook.com/profile.php?id=100008183017729" class="button-att button button-top vacature-solliciteren" title="Solliciteren">Nu solliciteren</a>
		</div>
	</div>
</div>
{/option:items}