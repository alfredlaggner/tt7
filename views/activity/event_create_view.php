<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
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
		jQuery(function ($) {
			$("#date").mask("9999/99/99");
			$("#time").mask("99:99");
		});
</script>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
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

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('activity/event_view/' . $activity_id, 'Activity Date Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Activity: <?php echo $activity_name ?></span></div>
			<div class="content-box">
				<div id="inputform">
					<?php $attributes = array('id' => 'event');
					echo form_open('event/create', $attributes); ?>
					<ul>
						<input type="hidden" name="activity_id" id="activity_id" value='<?php echo $activity_id ?>'/>
						<input type="hidden" name="activity_code" id="activity_code"
						       value='<?php echo $activity_code ?>'/>
						<li>
							<label>Location</label>
							<select type="text" name="location_id" id="location_id" class="text" value=''/>

							<?php if (isset($locations)) : foreach ($locations as $location): ?>
								<option
									value="<?php echo $location->location_id; ?>"><?php echo $location->name; ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
							</select>
						</li>
						<li>
							<label>Date </label>
							<input type="text" name="date" id="date" class="required text"/>
						</li>
						<li>
							<label>Time </label>
							<input type="text" name="time" id="time" class="required text" value='09:00'/>
						</li>
						<li>
							<label>Capacity</label>
							<input type="text" name="capacity_max" id="capacity_max" class="required text"
							       value='<?php echo $capacity ?>'/>
						</li>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</li>
					</ul>
					<?php echo form_close(); ?> </div>
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