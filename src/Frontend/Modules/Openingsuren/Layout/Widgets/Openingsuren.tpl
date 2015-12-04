{*
    variables that are available:
    - {$widgetOpeningsuren}:
*}

{option:widgetOpeningsuren}
   
	<div class="grid-item">
	    <div class="grid-item-content">
			<span class="flag flag-be">
			</span>
			<strong>Openingsuren</strong>
			<br><br>
			<table class="openingsurenTable">
				<tbody>
					{iteration:widgetOpeningsuren}
						<tr>
							<td>
								{$widgetOpeningsuren.day}</td>
							<td>
								{$widgetOpeningsuren.open}</td>
						</tr>
					 {/iteration:widgetOpeningsuren}
				</tbody>
			</table>
		</div>
	</div>
	
{/option:widgetOpeningsuren}
