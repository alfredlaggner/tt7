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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate_plan', 'Rate Plan Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Create a new price for a new effective date</span></div>
			<div class="content-box">
				<div id="inputform"> <?php echo form_open('rate/add_rate_plan'); ?>
					<table>

						<!--							<td><input type="hidden" name="rate_plan_id" id="rate_plan_id"  value='<?php echo $rate_plan_id ?>' /></td>
-->
						<tr>
							<td>Name</td>
							<td><input type="text" name="name" id="name" class="text"/></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><textarea class="text_area" name="description" id="description"></textarea></td>
						</tr>
						<tr>
							<td>Tax Plan</td>
							<td><input type="text" name="tax_plan_id" id="tax_plan_id" class="text"/></td>
						</tr>
						<tr>
							<label class="desc">Type</label>
							<?php
							$activity_checked = TRUE;
							$lodging_checked = FALSE;
							$data = array(
								'name' => 'type',
								'id' => 'type',
								'value' => 'A',
								'checked' => $activity_checked,
							);
							echo form_radio($data);
							?>
							Activity
							<?php
							$data = array(
								'name' => 'type',
								'id' => 'type',
								'value' => 'L',
								'checked' => $lodging_checked,
							);

							echo form_radio($data);
							?>
							Lodging
						</tr>
						<tr>
							<td>Active</td>
							<td><?php echo form_checkbox('is_active', 'no', FALSE) ?></td>
						</tr>
						<tr>
							<td><input type="submit" name="create" id="create" value="Create" class="buttons"/></td>
							<td><input type="submit" name="cancel" id="cancel" value="Cancel" class="buttons cancel"/>
							</td>
						</tr>
					</table>
					<?php echo form_close(); ?> </div>
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