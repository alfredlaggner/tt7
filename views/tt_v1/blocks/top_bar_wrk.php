<div id="top-bar">
	<div id="top-bar-content">
		<? if (isset($region_id)) : ?>
			<span id="top-bar-content-user">
<!--                logged in as <a href="javascript:void(0)"></a> (<a href="javascript:void(0)">logout</a>)
                Not logged in <a href="javascript:void(0)"></a>  (<a href="javascript:void(0)"> login </a>)
-->            </span>
			<a href="cart.html" id="top-bar-checkout">
				<?= $region_name ?></a>
			<? $attributes = array('id' => 'activity'); ?>
			<?= form_open('tt_v1/region_update/' . $region_id, $attributes); ?>
			<label>select region: </label>
			<select type=" text" id="top-bar-checkout" width="40" name="region_id" class="text"
			        value='<?= $region_id ?>'/>

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
			<span id="top-bar-content-items">your selected region is </span>
		<? endif ?>
	</div>
</div>
