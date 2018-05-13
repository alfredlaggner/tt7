<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span></span></div>
			<?= validation_errors(); ?>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<table width="800" border="0">
						<? $attributes = array(
							'id' => 'edit_attachments',
							'class' => "pager-form",
						); ?>
						<?php echo form_open('attachment/attachment_update/' . $row->attachment_id . '/' . $template_id, $attributes); ?>
						<input type="hidden" name="template_id" id="template_id" value='<?= $template_id ?>'/>
						<tr>
							<td>Attachment</td>
							<td><input type="text" name="attachment_name" id="attachment_name" class="text"
							           value='<?php echo $row->attachment_name ?>'/></td>
						</tr>
						<tr>
							<td>File Name</td>
							<td><input type="text" name="file_name" id="file_name" class="text"
							           value='<?php echo $row->file_name ?>'/></td>
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
		<i class="note"></i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>