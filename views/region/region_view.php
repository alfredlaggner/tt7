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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('region', 'Region'); ?>
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
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<table width="800" border="0">
						<?php echo form_open('region/update/' . $row->region_id); ?>
						<tr>
							<td>Code</td>
							<td><input type="text" name="region" id="region" class="text"
							           value='<?php echo $row->region ?>'/></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit" value="Update" class="buttons"/></td>
						</tr>
						<?php echo form_close(); ?>
					</table>
				<?php endforeach; ?>
				<?php endif; ?>
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