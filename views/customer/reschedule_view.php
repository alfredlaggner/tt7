<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	<?
	if (!$is_update) {
		$this->session->set_userdata(array('back_url' => $_SERVER['HTTP_REFERER']));
	}

	//echo 'xxxx' . $_SERVER['HTTP_REFERER'];	

	?>
	$().ready(function () {
		$("#customer").validate(
			{}
	});
	})

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<? $this->load->view('modules/top_buttons') ?>
	</div>
	<div id="page-layout">
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2><?= $title_action ?></h2>
					<span>Update customer record ...</span></div>
				<div id="inputform">
					<? if (isset($records)) : foreach ($records as $row) : ?>
						<ul>
							<? $attributes = array('id' => 'reschedule'); ?>
							<?= form_open('ledger/reschedule_update/' . $row->ledger_id, $attributes); ?>
							<input type="hidden" name="ledger_id" id="ledger_id" value='<?= $row->ledger_id ?>'/>
							<li>
								<label>Activity</label>
								<input type="text" name="activity_name" id="activity_name" class="text"
								       value='<?= $row->activity_name ?>'/>
							<li>
							<li>
								<label>Activity</label>
								<input type="text" name="activity_code" id="activity_code" class="text"
								       value='<?= $row->activity_code ?>'/>
							<li>
							<li>
								<label>Booking Date</label>
								<input type="text" name="date" id="date" class="text" value='<?= $row->date ?>'/>
							</li>
							<li>
								<label>Booking Time</label>
								<input type="text" name="time" id="time" class="text" value='<?= $row->time ?>'/>
							</li>
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="button" class="cancel buttons" value="Return"
							       ONCLICK="window.location='<?= $this->session->userdata('back_url'); ?>'"/>
							</li>
							<?= form_close(); ?>
						</ul>
					<? endforeach; ?>
					<? endif; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
				pages.</i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
	<? $this->load->view('modules/footer') ?>
	</body></html>