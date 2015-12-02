{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblLocation|ucfirst}</h2>

	{option:showLocationAdd}
	<div class="buttonHolderRight">
		<a href="{$var|geturl:'add'}" class="button icon iconAdd" title="{$lblAdd|ucfirst}">
			<span>{$lblAdd|ucfirst}</span>
		</a>
	</div>
	{/option:showLocationAdd}
</div>

{option:dataGrid}
	<div class="dataGridHolder">
		{$dataGrid}
	</div>
{/option:dataGrid}

{option:!dataGrid}<p>{$msgNoItems|sprintf:{$var|geturl:'add'}}</p>{/option:!dataGrid}

<script type="text/javascript">
	var mapOptions = {
		zoom: '{$settings.zoom_level}' == 'auto' ? 0 : {$settings.zoom_level},
		type: '{$settings.map_type}',
		center: {
			lat: {$settings.center.lat},
			lng: {$settings.center.lng}
		}
	};
	var markers = [];
	{iteration:items}
		{option:items.lat}
			{option:items.lng}
				markers.push({
					lat: {$items.lat},
					lng: {$items.lng},
					title: '{$items.title}',
					text: '<p>{$items.street} {$items.number}</p><p>{$items.zip} {$items.city}</p>'
				});
			{/option:items.lng}
		{/option:items.lat}
	{/iteration:items}
</script>

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
