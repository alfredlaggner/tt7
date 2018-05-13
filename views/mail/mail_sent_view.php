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
				<?php if (isset($records)) : foreach ($records as $row) : ?>
				<h2><?php echo $title_action . $row->first_name . ' ' . $row->last_name; ?></h2>
			</div>
			<div id="inputform">
				<table width="800" border="0">
					<?php echo form_open('mail_sent') ?>
					<input type="hidden" name="mail_id" id="mail_id" class="text" value='<?php echo $row->mail_id ?>'/>

					<tr>
						<td>To</td>
						<td>
							<input type="text" name="customer_id" id="customer_id" class="text"
							       value='<?php echo $row->email ?>'/>

						</td>
					</tr>
					<tr>
						<td>Date</td>
						<td><input type="text" name="date_time" id="date_time" class="text"
						           value='<?php echo $row->date_time ?>'/></td>
					</tr>
					<!--					<tr>
					
						<td>From</td>
						<td><input type="text" name="from" id="from"  class="text"  value='<?php echo $row->from ?>'  /></td>
					</tr>
					<tr>
-->
					<td>Subject</td>
					<td><input type="text" name="subject" id="subject" class="text"
					           value='<?php echo $row->subject ?>'/></td>

					</tr>
					<tr>

						<td>Message</td>

						<td> <?php echo $row->body ?> </td>

					</tr>
					<tr>

						<td><input type="submit" name="cancel" value="Return" class="buttons"/></td>
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