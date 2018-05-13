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
		<span></span>
	</div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Make sure you add this file to folder 'attachment_files'</span></div>
			<?= validation_errors(); ?>
			<div id="inputform">
				<table width="800" border="0">
					<?php echo form_open('attachment/attachment_create/' . $template_id); ?>
					<input type="hidden" name="template_id" id="template_id" value='<?= $template_id ?>'/>
					<tr>
						<td>Name</td>
						<td><input type="text" name="attachment_name" id="attachment_name" class="text"/></td>
					</tr>

					<?php // echo $error;?>

					<?php echo form_open_multipart('upload/do_upload'); ?>

					<input type="file" name="userfile" size="20"/>

					<br/><br/>

					<input type="submit" value="upload"/>

					</form>


					<tr>
						<td>File Name</td>
						<td><input type="text" name="file_name" id="file_name" class="text"/></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Add" class="buttons"/></td>
					</tr>
					<?php echo form_close(); ?>
				</table>
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