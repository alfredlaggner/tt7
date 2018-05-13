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
				<h2><?php echo $title_action ?></h2>
				<span></span></div>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<table width="800" border="1">
						<?php echo form_open('template/update/' . $row->template_id . '/' . $row->activity_id); ?>
						<tr>
							<td>Name</td>
							<td><input type="text" name="name" id="name" class="text" value='<?php echo $row->name ?>'/>
							</td>
						</tr>
						<tr>
							<td>Active Y/N</td>
							<td><?= form_checkbox('is_active', $row->is_active, $row->is_active) ?></td>
						</tr>
						<tr>
							<td>Reminder Y/N</td>
							<td><?= form_checkbox('is_automated', $row->is_automated, $row->is_automated) ?></td>
						</tr>
						<tr>
							<td>Interval</td>
							<td>
								<?
								$class = 'class="text"';
								$options = array(
									SEND_ONE_WEEK_PRIOR_EVENT => 'One Week Prior',
									SEND_TWO_WEEK_PRIOR_EVENT => 'Two Weeks Prior',
								);

								$selected_interval = array($row->send_interval ? $row->send_interval : SEND_ONE_WEEK_PRIOR_EVENT);

								echo form_dropdown('send_interval', $options, $selected_interval, $class);
								?>        </td>
						</tr>
						<tr>
							<td>Order Confirm Y/N</td>
							<td><?= form_checkbox('is_confirmation', $row->is_confirmation, $row->is_confirmation) ?></td>
						</tr>

						<tr>
							<td>Subject</td>
							<td><input type="text" name="subject" id="subject" class="text"
							           value='<?php echo $row->subject ?>'/></td>
						</tr>
						<tr></tr>
						<tr>
							<td>Description Detail</td>
							<td><textarea class="text_area" name="body" id="body"> <?php echo $row->body ?> </textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Update" class="buttons"/>
								<input type="submit" name="submit" value="Abort" class="buttons"/></td>
						</tr>
						<?php echo form_close(); ?>
						<? if (isset($records)) : if ($place_holders_text) : ?>
							<tr>
								<td></td>
								<td><p>Valid Placeholders:
										<?= $place_holders_text ?>
									</p></td>
							</tr>
							<tr>
								<td></td>
								<td><p>Format Placeholders: Highlight the placeholder including {}; then copy/paste into
										text</td>
							</tr>
						<? endif; endif ?>
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