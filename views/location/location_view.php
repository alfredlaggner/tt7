<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('location', 'Location'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span></span></div>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
				<table width="800" border="1">
					<?php echo form_open('location/update/' . $row->location_id); ?>
					<tr>
						<td>Code</td>
						<td><input type="text" name="code" id="code" class="text" value='<?php echo $row->code ?>'/>
						</td>
					<tr></tr>

					<td>Name</td>
					<td><input type="text" name="name" id="name" class="text" value='<?php echo $row->name ?>'/></td>
					</tr>
					<tr>
						<td>Region</td>
						<td><select type="text" name="region_id" id="region_id" class="text"
						            value='<?php echo $row->region_id; ?>'/>

							<?php if (isset($regions)) : foreach ($regions as $region): ?>
								<?php if ($row->region_id == $region->region_id) : ?>
									<option selected
									        value="<?php echo $region->region_id; ?>"><?php echo $region->region; ?></option>
								<?php else : ?>
									<option
										value="<?php echo $region->region_id; ?>"><?php echo $region->region; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							</select></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="address" id="address" class="text"
						           value='<?php echo $row->address ?>'/></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="city" id="city" class="text" value='<?php echo $row->city ?>'/>
						</td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="state" id="state" class="text" value='<?php echo $row->state ?>'/>
						</td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="country" id="country" class="text"
						           value='<?php echo $row->country ?>'/></td>
					</tr>
					<tr>
						<td>Continent</td>
						<td><input type="text" name="continent" id="continent" class="text"
						           value='<?php echo $row->continent ?>'/></td>
					</tr>
					<tr>
						<td>Description Short</td>
						<td><input type="text" name="description_short" id="description_short" class="text"
						           value='<?php echo $row->description_short ?>'/></td>
					</tr>
					<tr>
						<td>Description Detail</td>
						<td><textarea class="text_area" name="description_long"
						              id="description_long"> <?php echo $row->description_long ?> </textarea></td>
					</tr>
					<tr>
						<td>Directions</td>
						<td><textarea class="text_area" name="directions"
						              id="directions"> <?php echo $row->directions ?> </textarea></td>
					</tr>
					<tr>
						<td>Map Link</td>
						<td><input type="text" name="map_link" id="map_link" class="text"
						           value='<?php echo $row->map_link ?>'/></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Update" class="buttons"/></td>
					</tr>
					<?php echo form_close(); ?>
				</table>
				<p><?php echo $row->map_link ?>
				<p>
					<?php endforeach; ?>
					<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note"></i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>