{*
	variables that are available:
	- {$widgetContactForm}
*}

{option:widgetContactForm}
	{iteration:widgetContactForm}
		<div class="grid-item">
		    
		    <div class="grid-item-content">
			<span class="flag flag-be">
			</span>
			<strong>{$widgetContactForm.title}</strong>
			<br>
			<br>
			<p><span style="line-height: 1.5;">{$widgetContactForm.street} {$widgetContactForm.nr},<br>
			</span><span style="line-height: 1.5;">{$widgetContactForm.zip} {$widgetContactForm.city}</span></p>
			<strong><span class="icon-font icon-font-phone"></span>&nbsp; &nbsp;</strong><a href="tel://{$widgetContactForm.tel}" target="_blank" class="more2" title="Open in a new window">{$widgetContactForm.tel}</a>
			<br class="largebr">
			<strong><span class="icon-font icon-font-print"></span>&nbsp; &nbsp;</strong><a href="tel://{$widgetContactForm.fax}" target="_blank" class="more2" title="Open in a new window">{$widgetContactForm.fax}</a>
			<br>
			<span class="icon-font icon-font-envelope"></span>&nbsp;&nbsp;<a href="mailto://{$widgetContactForm.email}" title="Aanvraag website" target="_blank" class="more2">{$widgetContactForm.email}</a><br>
			<br>
			<div style="text-align: center;">
			<a href="{$SITE_URL}/contact" class="button button-att">Contact pagina</a></div>
			<br>
			</div>
		</div>
	{/iteration:widgetContactForm}
{/option:widgetContactForm}