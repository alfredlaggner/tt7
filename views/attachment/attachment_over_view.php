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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('template', 'template'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<h3><?= $row->name ?></h3>
				<? endforeach; endif ?>
			</div>
			<!--beginning of hastable-->
			<div class="hastable">
				<?php
				$attributes = array(
					'id' => 'add_attachments',
					'class' => "pager-form",
				);
				echo form_open('attachment/add_attachments_to_templates/' . $template_id . '/' . $attachment_count . '/' . $row->activity_id, $attributes) ?>
				<?= form_hidden('activity_id', $activity_id); ?>
				<?= form_hidden('template_id', $template_id); ?>
				<table id="sort-table">
					<thead>
					<tr>
						<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
						           class="submit"/>
						</th>
						<th>Attachment</th>
						<th>File Name</th>
						<th>Options</th>
					</tr>
					</thead>
					<?php $i = 0; ?>
					<?php if (isset($attachments)) : foreach ($attachments as $attachment) : ?>
					<?php $i++; ?>
					<tbody>
					<tr>
						<input type="hidden" value="<?php echo $attachment->attachment_id; ?>"
						       name="attachment_id<?php echo $i ?>" id="attachment_id<?php echo $i ?>"/>
						<?php if (isset($template_attachments)) {
							$checked = FALSE;
							foreach ($template_attachments as $dpr) {
								if ($dpr->template_id == $template_id AND $dpr->attachment_id == $attachment->attachment_id)
									$checked = TRUE;
							}
						}
						?>
						<td class="center"><?php echo form_checkbox('attachment_add' . $i, $checked, $checked) ?></td>
						<td><?php echo $attachment->attachment_name; ?></td>
						<td><?php echo $attachment->file_name; ?></td>
						<td>

							<a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit attachment"
							   href="<?php echo site_url() . 'attachment/attachment_view/' . $attachment->attachment_id . '/' . $template_id . '/' . $activity_id ?> ">
								<span class="ui-icon ui-icon-wrench"></span> </a>

							<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
							   title="Delete attachment"
							   href="<?php echo site_url() . 'attachment/attachment_delete/' . $attachment->attachment_id . '/' . $template_id . '/' . $activity_id ?> ">
								<span class="ui-icon ui-icon-trash"></span> </a></td>
					</tr>
					<?php endforeach;
					endif; ?>
					</tbody>
					<tr>
						<input type="submit" name="add_attachment" value="Add new to list"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
						<input type="submit" name="assign_attachments" value="Attatch to emails"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
						<input type="submit" name="cancel_attachments" value="Return to emails"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
					</tr>
				</table>
				</form>
			</div>
			<!--end of hastable-->


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