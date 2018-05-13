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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('equipment', 'Equipment'); ?>
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
				<ul>
					<?php echo form_open('equipment/create'); ?>

					<li><label>Equipment Name</label></li>
					<li><input type="text" name="name" id="name" class="text" value=''/></li>


					<li>Equipment Description</li>
					<li><textarea class="text_area" name="equipment" id="equipment"> </textarea></li>


					<li><input type="submit" name="submit" value="Add" class="buttons"/></li>

					<?php echo form_close(); ?>
				</ul>
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