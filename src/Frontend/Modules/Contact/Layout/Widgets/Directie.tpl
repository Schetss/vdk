{*
    variables that are available:
    - {$widgetContactDirectie}:
*}

{option:widgetContactDirectie}
	<div class="grid-item">
		 <div class="box-alt box-border">
	        <div class="box-header box-header-trp">
	            <h2 class="delta ">Directie</h2>
	        </div>
	        <div class="box-inner contact-list">
	        	<ul class="reset-list matrix-list matrix-list-xs-1 matrix-list-s-2">
			        {iteration:widgetContactDirectie}<li>
		            	<h4>{$widgetContactDirectie.name}</h4>
		            	<p class="contact-function">{$widgetContactDirectie.function}</p>
		            	<a href="tel://{$widgetContactDirectie.tel}" target="_blank" class="more2" title="Open in a new window">{$widgetContactDirectie.tel}</a>
						<br>
						<a href="mailto://{$widgetContactDirectie.email}" title="Aanvraag website" target="_blank" class="more2">{$widgetContactDirectie.email}</a><br>
						<br>
		            </li>{/iteration:widgetContactDirectie}
		    	</ul>
	    	</div>
	    </div>
	</div>
{/option:widgetContactDirectie}



   