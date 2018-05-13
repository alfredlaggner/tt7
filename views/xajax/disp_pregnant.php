<div id="new_line">
	<? $data = ['id' => 'is_pregnant' . $i, 'class' => 'wb']; ?>
	<!--<input type="checkbox" name="is_pregnant1" value="no" id="is_pregnant1" class="wb">-->
	<?= form_checkbox('is_pregnant' . $i, 'no', FALSE, $data) ?>
	<label for="is_pregnant<?= $i ?>" id="somelabel">Are you pregnant? </label>
</div>

