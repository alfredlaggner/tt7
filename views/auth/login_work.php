<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#activity").validate(
			{
				rules: {
					cancel: "cancel",
					name: {
						required: true,
					},
					code: {
						required: true,
						minlength: 1,
						maxlength: 10
					},
					order: {
						required: true,
						range: [1, 10]
					},
					status_dependent_text: {
						required: "#is_status_dependent:checked"
					}
				},
				messages: {
					order: {
						required: "Please enter a value between 1 and 10",
						range: "Order must be between 1 and 10"
					},
					name: {
						required: "Please enter an activity name",
						minlength: "Minimum length is 3"
					},
					code: {
						required: "Please enter a 5 character code",
						maxlength: "Maximum length is 5",
						minlength: "Minimum length is 5"
					},
					status_dependent_text: {
						required: "Status dependent text is checked, enter text"
					}
				}
			});
	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('activity', 'Activity Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
				<h2><?php echo $title_action ?><?php echo $row->name; ?></h2>
				<span></span></div>
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Descriptions</a></li>
					<li><a href="#tabs-2">Settings</a></li>
					<li><a href="#tabs-3">Marketing</a></li>
					<li><a href="#tabs-4">Rates</a></li>
				</ul>
				<div id="tabs-1">
					<div class="content-box">
						<div id="inputform">
							<ul border="0">
								<?php $attributes = array('id' => 'activity'); ?>
								<?php echo form_open('activity/update/' . $row->activity_id, $attributes); ?>
								<li>
									<input type="hidden" name="activity_id" id="activity_id"
									       value='<?php echo $row->activity_id; ?>'/>
								</li>
								<li>
									<label>Activity Name</label>
									<input type="text" name="name" id="name" class="text"
									       value='<?php echo $row->name; ?>'/>
								</li>
								<li>
									<label>Activity Code</label>
									<input type="text" name="code" id="code" class="text"
									       value='<?php echo $row->code; ?>'/>
								</li>
								<li>
									<label>Location</label>
									<select type="text" name="location_id" id="location_id" class="text"
									        value='<?php echo $row->location_id; ?>'/>

									<?php if (isset($locations)) : foreach ($locations as $location): ?>
										<?php if ($row->location_id == $location->location_id) : ?>
											<option selected
											        value="<?php echo $location->location_id; ?>"><?php echo $location->name; ?></option>
										<?php else : ?>
											<option
												value="<?php echo $location->location_id; ?>"><?php echo $location->name; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
									</select>
								</li>
								<li>
									<label>Division</label>
									<select type="text" name="division_id" id="division_id" class="text"
									        value='<?php echo $row->division_id; ?>'/>

									<?php if (isset($divisions)) : foreach ($divisions as $division) : ?>
										<?php if ($row->division_id == $division->division_id) : ?>
											<option selected
											        value="<?php echo $division->division_id; ?>"><?php echo $division->name; ?></option>
										<?php else : ?>
											<option
												value="<?php echo $division->division_id; ?>"><?php echo $division->name; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
									</select>
								</li>
								<li>
									<label>Description</label>
									<input type="text" name="description_short" id="description_short" class="text"
									       value='<?php echo $row->description_short; ?>'/>
								</li>
								<li>
									<label>Description Long</label>
									<textarea class="text_area" name="description_long"
									          id="description_long"> <?php echo $row->description_long; ?></textarea>
								</li>
								<li>
									<label>Description Detailled</label>
									<textarea class="text_area" name="description_detailled"
									          id="description_detailled"> <?php echo $row->description_detailled; ?></textarea>
								</li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div id="tabs-2">
					<div id="inputform">
						<ul>
							<li>
								<label>Style</label>
								<select type="text" name="style_id" id="style_id" class="text"
								        value='<?php echo $row->style_id; ?>'/>

								<?php if (isset($styles)) : foreach ($styles as $style) : ?>
									<?php if ($row->style_id == $style->style_id) : ?>
										<option selected
										        value="<?php echo $style->style_id; ?>"><?php echo $style->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $style->style_id; ?>"><?php echo $style->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Physical_level</label>
								<select type="text" name="physical_level_id" id="physical_level_id" class="text"
								        value='<?php echo $row->physical_level_id; ?>'/>

								<?php if (isset($physical_levels)) : foreach ($physical_levels as $physical_level) : ?>
									<?php if ($row->physical_level_id == $physical_level->physical_level_id) : ?>
										<option selected
										        value="<?php echo $physical_level->physical_level_id; ?>"><?php echo $physical_level->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $physical_level->physical_level_id; ?>"><?php echo $physical_level->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Service_level</label>
								<select type="text" name="service_level_id" id="service_level_id" class="text"
								        value='<?php echo $row->service_level_id; ?>'/>

								<?php if (isset($service_levels)) : foreach ($service_levels as $service_level) : ?>
									<?php if ($row->service_level_id == $service_level->service_level_id) : ?>
										<option selected
										        value="<?php echo $service_level->service_level_id; ?>"><?php echo $service_level->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $service_level->service_level_id; ?>"><?php echo $service_level->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Duration (hours)</label>
								<input type="text" name="duration" id="duration" class="digits text"
								       value='<?php echo $row->duration; ?>'/>
							</li>
							<li>
								<label>Duration Text</label>
								<input type="text" name="duration_text" id="duration_text" class="text"
								       value='<?php echo $row->duration_text; ?>'/>
							</li>
							<li>
								<label>Minimum capacity</label>
								<input type="text" name="capacity_min" id="capacity_min" class="digits text"
								       value='<?php echo $row->capacity_min; ?>'/>
							</li>
							<li>
								<label>Maximum capacity</label>
								<input type="text" name="capacity_max" id="capacity_max" class="digits text"
								       value='<?php echo $row->capacity_max; ?>'/>
							</li>
							<li>
								<label>Minimum Weight</label>
								<input type="text" name="age_min" id="age_min" class="digits text"
								       value='<?php echo $row->age_min; ?>'/>
							</li>
							<li>
								<label>Maximum Weight</label>
								<input type="text" name="age_max" id="age_max" class="digits text"
								       value='<?php echo $row->age_max; ?>'/>
							</li>
							<li>
								<label>Featured</label>
								<?php echo form_checkbox('is_featured', $row->is_featured, $row->is_featured) ?> </li>
							<li>
								<label>Active</label>
								<?php echo form_checkbox('is_active', $row->is_active, $row->is_active) ?> </li>
						</ul>
					</div>
				</div>
				<div id="tabs-3">
					<div id="inputform">
						<ul border="0">
							<li>
								<label>Inquiry Message</label>
								<select type="text" name="inquiry_message_id" id="inquiry_message_id" class="text"
								        value='<?php echo $row->inquiry_message_id; ?>'/>

								<?php if (isset($inquiry_messages)) : foreach ($inquiry_messages as $inquiry_message) : ?>
									<?php if ($row->inquiry_message_id == $inquiry_message->inquiry_message_id) : ?>
										<option selected
										        value="<?php echo $inquiry_message->inquiry_message_id; ?>"><?php echo $inquiry_message->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $inquiry_message->inquiry_message_id; ?>"><?php echo $inquiry_message->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Confirmation Message</label>
								<select type="text" name="confirmation_message_id" id="confirmation_message_id"
								        class="text" value='<?php echo $row->confirmation_message_id; ?>'/>

								<?php if (isset($confirmation_messages)) : foreach ($confirmation_messages as $confirmation_message): ?>
									<?php if ($row->confirmation_message_id == $confirmation_message->confirmation_message_id) : ?>
										<option selected
										        value="<?php echo $confirmation_message->confirmation_message_id; ?>"><?php echo $confirmation_message->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $confirmation_message->confirmation_message_id; ?>"><?php echo $confirmation_message->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Booking Message</label>
								<select type="text" name="booking_message_id" id="booking_message_id" class="text"
								        value='<?php echo $row->booking_message_id; ?>'/>

								<?php if (isset($booking_messages)) : foreach ($booking_messages as $booking_message): ?>
									<?php if ($row->booking_message_id == $booking_message->booking_message_id) : ?>
										<option selected
										        value="<?php echo $booking_message->booking_message_id; ?>"><?php echo $booking_message->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $booking_message->booking_message_id; ?>"><?php echo $booking_message->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Please call</label>
								<?php echo form_checkbox('is_please_call', $row->is_please_call, $row->is_please_call) ?>
							</li>
						</ul>
					</div>
				</div>
				<div id="tabs-4">
					<div id="inputform">
						<ul>
							<li>
								<label>Rate</label>
								<select type="text" name="rate_plan_id" id="rate_plan_id" class="text"
								        value='<?php echo $row->rate_plan_id; ?>'/>

								<?php if (isset($rate_plans)) : foreach ($rate_plans as $rate_plan): ?>
									<?php if ($row->rate_plan_id == $rate_plan->rate_plan_id) : ?>
										<option selected
										        value="<?php echo $rate_plan->rate_plan_id; ?>"><?php echo $rate_plan->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $rate_plan->rate_plan_id; ?>"><?php echo $rate_plan->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
							<li>
								<label>Tax Plan</label>
								<select type="text" name="tax_plan_id" id="tax_plan_id" class="text"
								        value='<?php echo $row->tax_plan_id; ?>'/>

								<?php if (isset($tax_plans)) : foreach ($tax_plans as $tax_plan): ?>
									<?php if ($row->tax_plan_id == $tax_plan->tax_plan_id) : ?>
										<option selected
										        value="<?php echo $tax_plan->tax_plan_id; ?>"><?php echo $tax_plan->name; ?></option>
									<?php else : ?>
										<option
											value="<?php echo $tax_plan->tax_plan_id; ?>"><?php echo $tax_plan->name; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								</select>
							</li>
						</ul>
					</div>
				</div>
				<ul border="0">
					<li>
						<input type="submit" name="update" value="Update" class="buttons"/>
						<input type="submit" name="return" value="Save & Return" class="buttons"/>
						<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
					</li>
					<?php echo form_close(); ?>
				</ul>
				<?php endforeach; ?>
				<?php else : ?>
					<p>No records were returned.</p>
				<?php endif; ?>
			</div>
			<div class="clearfix"></div>
			<i class="note"><?php echo $bottom_note ?></i>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>