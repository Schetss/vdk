{*
    variables that are available:
    - {$widgetContactVerkoop}:
*}

{option:widgetContactVerkoop}

	<div class="grid-item">
	 	<div class="box-alt box-border">
	        <div class="box-header box-header-trp">
	            <h2 class="delta ">Verkoop</h2>
	        </div>
	        <div class="box-inner contact-list">
	        	<ul class="reset-list matrix-list matrix-list-xs-1 matrix-list-s-2">
			        {iteration:widgetContactVerkoop}<li>
		            	<h4>{$widgetContactVerkoop.name}</h4>
		            	<p class="contact-function">{$widgetContactVerkoop.function}</p>
		            	<a href="tel://{$widgetContactVerkoop.tel}" target="_blank" class="more2" title="Open in a new window">{$widgetContactVerkoop.tel}</a>
						<br>
						<a href="mailto://{$widgetContactVerkoop.email}" title="Aanvraag website" target="_blank" class="more2">{$widgetContactVerkoop.email}</a><br>
						<br>
		            </li>{/iteration:widgetContactVerkoop}
		    	</ul>
	    	</div>
	    </div>
	</div>

{/option:widgetContactVerkoop}
