<style>
	#region_select {
		display: none;
		padding: 0.4em;
		padding-left: 1.5em;
		padding-right: 1.5em;
	}
</style>
<script>
	$(function () {
			$(".do_region").click(showDialog);
			$myWindow = jQuery('#region_select');
			//instantiate the dialog
			$myWindow.dialog({
				show: 'explode',
				modal: true,
				height: 300,
				width: 600,
				position: 'center'
				//                       autoOpen:false
			});
		}
	);
	//function to show dialog   
	var showDialog = function () {
		//if the contents have been hidden with css, you need this
		$myWindow.show();
		//open the dialog
		$myWindow.dialog("open");
	}

</script>


<div id="top-bar">
	<div id="top-bar-content">
		<? if (isset($region_id)) : ?>
		<span id="top-bar-content-user">
<!--                logged in as <a href="javascript:void(0)"></a> (<a href="javascript:void(0)">logout</a>)
                Not logged in <a href="javascript:void(0)"></a>  (<a href="javascript:void(0)"> login </a>)
-->            </span>

		<? $attributes = array('id' => 'activity'); ?>
		<?= form_open('tt_v1/region_update/' . $region_id, $attributes); ?>
		<label>select region: </label>
		<select type=" text" id="top-bar-checkout" width="40" name="region_id" class="text" value='<?= $region_id ?>'/>

		<? if (isset($regions)) : foreach ($regions as $region) : ?>
			<? if ($region_id == $region->region_id) : ?>
				<option selected value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
			<? else : ?>
				<option value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
			<? endif; ?>
		<? endforeach; ?>
		<? endif; ?>
		<option value="0"> All Regions</option>
		</select>
		<input type="submit" name="return" value="Save" class="buttons"/>
		<?= form_close(); ?>

		<a href="#" id="top-bar-checkout" class="do_region"> <?= $region_name ?></a>
		<span id="top-bar-content-items">Selected Region: </span>
	</div>
</div>
<? else : ?>

	<div id="region_select">
		<? $attributes = array('id' => 'activity'); ?>
		<?= form_open('tt_v1/region_update/' . $region_id, $attributes); ?>
		<label>select region: </label>
		<select type=" text" id="xtop-bar-checkout" width="40" name="region_id" class="text" value='<?= $region_id ?>'/>

		<? if (isset($regions)) : foreach ($regions as $region) : ?>
			<? if ($region_id == $region->region_id) : ?>
				<option selected value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
			<? else : ?>
				<option value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
			<? endif; ?>
		<? endforeach; ?>
		<? else : ?>
			<label>no region: </label>
		<? endif; ?>
		<option value="0"> All Regions</option>
		</select>
		<input type="submit" name="return" value="Save" class="buttons"/>
		<?= form_close(); ?>


	</div>
<? endif ?>
