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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate', 'Rate Overview'); ?>
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
			<div class="content-box">
				<div id="inputform">
					<table border="0">
						<?php echo form_open('rate/add_rate') ?>
						<td><input type="hidden" name="rate_plan_id" id="rate_plan_id" class="text"
						           value='<?php echo $rate_plan_id ?>'/></td>
						<tr>
							<td>Name</td>
							<td><input type="text" name="name" id="name" class="text" value=''/></td>
						</tr>
						<tr>
							<td>Order</td>
							<td><input type="text" name="order" id="order" class="text" value=''/></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><textarea class="text_area" name="description" id="description"></textarea></td>
						</tr>
						<tr>
							<td>Status dependent</td>
							<td><?php echo form_checkbox('is_status_dependent', 'no', FALSE) ?></td>
						</tr>
						<tr>
							<td>Status dependent text</td>
							<td><input type="text" name="status_dependent_text" id="status_dependent_text" class="text"
							           value=''/></td>
						</tr>
						<tr>
							<td>Minimum Age</td>
							<td><input type="text" name="age_from" id="age_from" class="text" value=''/></td>
						</tr>
						<tr>
							<td>Maximum Age</td>
							<td><input type="text" name="age_to" id="age_to" class="text" value=''/></td>
						</tr>
						<tr>
							<td>Minimum Party Size</td>
							<td><input type="text" name="party_size_min" id="party_size_min" class="text" value=''/>
							</td>
						</tr>
						<tr>
							<td>Maximum Party Size</td>
							<td><input type="text" name="party_size_max" id="party_size_max" class="text" value=''/>
							</td>
						</tr>
						<tr>
							<td>Active</td>
							<td><?php echo form_checkbox('is_active', 'no', FALSE) ?></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit" value="Create" class="buttons"/></td>
						</tr>
						<?php echo form_close(); ?>
					</table>
				</div>
				<div class="clearfix"></div>
				<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout
					Options pages.</i>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
	</body>
	</html>
