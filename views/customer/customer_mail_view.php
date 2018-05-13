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
				<span></div>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<table width="800" border="0">
						<?php echo form_open('mail/update/' . $row->mail_id); ?>
						<input type="hidden" name="mail_id" id="mail_id" class="text"
						       value='<?php echo $row->mail_id ?>'/>
						<tr>
							<td>Purpose</td>
							<td><input type="text" name="purpose" id="purpose" class="text"
							           value='<?php echo $row->purpose ?>' readonly/></td>
						</tr>
						<tr>
							<td>Date</td>
							<td><input type="text" name="date_time" id="date_time" class="text"
							           value='<?php echo $row->date_time ?>' readonly/></td>
						</tr>
						<tr>
							<td>To</td>
							<td><input type="text" name="to" id="to" class="text" value='<?php echo $row->to ?>'
							           readonly/></td>
						</tr>
						<tr>
							<td>Subject</td>
							<td><input type="text" name="subject" id="subject" class="text"
							           value='<?php echo $row->subject ?>' readonly/></td>
						</tr>
						<tr>
							<td>Message</td>
							<td><textarea class="text_area" name="body" id="body"
							              readonly> <?php echo $row->body ?></textarea></td>
						</tr>
						<tr>
							<td><input type="submit" name="cancel" value="Cancel" class="buttons"/></td>
						</tr>
						<input type="submit" name="assign_customer" value="Assign Customer"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
						<input type="submit" name="cancel" value="Cancel"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
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