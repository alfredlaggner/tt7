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
				<span>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</span>
			</div>
			<div id="inputform">
				<table width="800" border="0">
					<?php echo form_open('location/create'); ?>
					<tr>
						<td>Code</td>
						<td><input type="text" name="code" id="code" class="text"/></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><input type="text" name="name" id="name" class="text"/></td>
					</tr>
					<tr>
						<td>Region</td>
						<td><select type="text" name="region_id" id="region_id" class="text" value=''/>

							<?php if (isset($regions)) : foreach ($regions as $region): ?>
								<option
									value="<?php echo $region->region_id; ?>"><?php echo $region->region; ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
							</select></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="address" id="address" class="text"/></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="city" id="city" class="text"/></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="country" id="country" class="text"/></td>
					</tr>
					<tr>
						<td>Continent</td>
						<td><input type="text" name="continent" id="continent" class="text"/></td>
					</tr>
					<tr>
						<td>Description Short</td>
						<td><input type="text" name="description_short" id="description_short" class="text"/></td>
					</tr>
					<tr>
						<td>Description Detail</td>
						<td><textarea class="text_area" name="description_long" id="description_long" rows="3"
						              cols="30"></textarea></td>
					</tr>
					<tr>
						<td>Directions</td>
						<td><textarea class="text_area" name="directions" id="directions" rows="3" cols="30"></textarea>
						</td>
					</tr>
					<tr>
						<td>Map Link</td>
						<td><input type="text" name="map_link" id="map_link" class="text"/></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Add" class="buttons"/></td>
					</tr>
					<?php echo form_close(); ?>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
			pages.</i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>