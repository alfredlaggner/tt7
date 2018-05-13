<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#event").validate({
			rules: {
				date: {
					dateISO: true
				},
				time: {
					time: true
				},
				capacity_max: {
					number: true
				}
			},
			messages: {
				date: {
					number: "Must be a date"
				},
				time: {
					number: "Must be a time"
				},
				capacity_max: {
					number: "Must be a number"
				}
			}
		});
	});

</script>
<!--    <script type="text/javascript" src="<?= base_url() ?>js/ui/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/ui/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/ui/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/ui/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/ui/jquery.ui.position.min.js"></script>
	<link href="<?= base_url() ?>css/ui/ui.timepicker.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.timepicker.js"></script>
-->
<link href="<?= base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.datepicker.js"></script>
<!--<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
-->
<script type="text/javascript">
	$(function () {
		$('#date').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
			minDate: 0,
			maxDate: "+1Y"
		});
	});
</script>
<script type="text/javascript">
	jQuery(function ($) {
		$("#date").mask("9999/99/99");
		$("#time").mask("99:99");
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?= anchor('activity/event_view/' . $activity_id, 'Activity Date Overview'); ?>
			> <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<? if (isset($records)) : foreach ($records as $row) : ?>
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2><?= $title_action ?></h2>
					<span>Activity: <?= $activity_name ?></span></div>
				<div class="content-box">
					<div id="inputform">
						<? $attributes = array('id' => 'event');
						echo form_open('event/update/' . $row->event_id, $attributes); ?>
						<ul>
							<input type="hidden" name="activity_id" id="activity_id" value='<?= $activity_id ?>'/>
							<input type="hidden" name="activity_code" id="activity_code" value='<?= $activity_code ?>'/>
							<input type="hidden" name="from_calendar" id="from_calendar" value='<?= $from_calendar ?>'/>
							<input type="hidden" name="available" id="available" value="<?= $row->available; ?>"/>
							<input type="hidden" name="event_id" id="event_id" value='<?= $row->event_id ?>'/>
							<li>
								<label>Location</label>
								<select type="text" name="location_id" id="location_id" class="text"
								        value='<?= $row->location_id; ?>'/>

								<? if (isset($locations)) : foreach ($locations as $location): ?>
									<? if ($row->location_id == $location->location_id) : ?>
										<option selected
										        value="<?= $location->location_id; ?>"><?= $location->name; ?></option>
									<? else : ?>
										<option value="<?= $location->location_id; ?>"><?= $location->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Date </label>
								<input type="text" name="date" id="date" class="text" value="<?= $row->date; ?>"/>
							</li>
							<li>
								<label>Time </label>
								<input type="text" name="time" id="time" class="text" value="<?= $row->time; ?>"/>
							</li>
							<li>
								<label>Capacity</label>
								<input type="text" name="capacity_max" id="capacity_max" class="required text"
								       value="<?= $row->capacity_max; ?>"/>
							</li>
							<li>
								<input type="submit" name="update" value="Update" class="buttons"/>
								<input type="submit" name="return" value="Save & Return" class="buttons"/>
								<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
							</li>
						</ul>
						<?= form_close(); ?> </div>
				</div>
				<div class="clearfix"></div>
				<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout
					Options pages.</i>
				<? $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	<? endforeach; ?>
	<? else : ?>
		<p>No records were returned.</p>
	<? endif; ?>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>