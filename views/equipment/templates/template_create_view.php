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
		<?php $this->load->view('modules/top_buttons') ?>
	</div>
	<div id="page-layout">
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2><?php echo $title_action ?></h2>
				</div>
				<div id="inputform">
					<table width="800" border="0">
						<?php echo form_open('template/create'); ?>
						<tr>
							<input type="text" name="activity_id" id="activity_id" value= <?= $activity_id ?>/>
						</tr>
						<tr>

							<td>Name</td>
							<td><input type="text" name="name" id="name" class="text"/></td>
						<tr></tr>
						<td>Subject</td>
						<td><input type="text" name="subject" id="subject" class="text" value=''/>
						</td>
						<tr></tr>

						<td>Body</td>
						<td><textarea class="text_area" name="body" id="body" rows="3" cols="30"></textarea></td>
						<tr></tr>

						<td><input type="submit" name="submit" value="Add" class="buttons"/></td>
						</tr>
						<?php echo form_close(); ?>
					</table>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>