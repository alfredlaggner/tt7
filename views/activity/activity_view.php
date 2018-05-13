<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
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
						range: [1, 100]
					},
					status_dependent_text: {
						required: "#is_status_dependent:checked"
					}
				},
				messages: {
					order: {
						range: "Order must be between 1 and 100"
					},
					name: {
						required: "Please enter an activity name",
						minlength: "Minimum length is 3"
					},
					code: {
						required: "Please enter a 10 character code",
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
		<h1><?= $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?= anchor('activity', 'Activity Overview'); ?>
			> <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<? if (isset($records)) : foreach ($records as $row) : ?>
				<h2><?= $title_action ?> <?= $row->name; ?></h2>
				<span></span></div>
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Descriptions</a></li>
					<li><a href="#tabs-2">Settings</a></li>
					<li><a href="#tabs-3">Messages</a></li>
				</ul>
				<div id="tabs-1">
					<div class="content-box">
						<div id="inputform">
							<ul border="0">
								<? $attributes = array('id' => 'activity'); ?>
								<?= form_open('activity/update/' . $row->activity_id, $attributes); ?>
								<li>
									<input type="hidden" name="activity_id" id="activity_id"
									       value='<?= $row->activity_id; ?>'/>
								</li>
								<li>
									<label>Account</label>
									<select type="text" name="account_id" id="account_id" class="text"
									        value='<?= $row->account_id; ?>'/>

									<? if (isset($accounts)) : foreach ($accounts as $account) : ?>
										<? if ($row->account_id == $account->account_id) : ?>
											<option selected
											        value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
										<? else : ?>
											<option
												value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
										<? endif; ?>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
								<li>
									<label>Activity Name</label>
									<input type="text" name="name" id="name" class="text" value='<?= $row->name; ?>'/>
								</li>
								<li>
									<label>Activity Code</label>
									<input type="text" name="code" id="code" class="text" value='<?= $row->code; ?>'/>
								</li>
								<li>
									<label>Sort Order</label>
									<input type="text" name="order" id="order" class="text"
									       value='<?= $row->order; ?>'/>
								</li>

								<!--								<li>
									<label>Region</label>
									<select type="text" name="region_id" id="region_id" class="text"  value='<?= $row->region_id; ?>' />
									
									<? if (isset($regions)) : foreach ($regions as $region): ?>
									<? if ($row->region_id == $region->region_id) : ?>
									<option selected value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
									<? else : ?>
									<option          value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
									<? endif; ?>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
-->
								<li>
									<label>Division</label>
									<select type="text" name="division_id" id="division_id" class="text"
									        value='<?= $row->division_id; ?>'/>

									<? if (isset($divisions)) : foreach ($divisions as $division) : ?>
										<? if ($row->division_id == $division->division_id) : ?>
											<option selected
											        value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
										<? else : ?>
											<option
												value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
										<? endif; ?>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
								<li>
								<li>
									<h3>Headline</h3>
									<input type="text" name="slogan" id="slogan" class="text"
									       value='<?= $row->slogan; ?>'/>
								</li>
								<li>
									<h3>Short Summary</h3>
									<input type="text" name="description_short" id="description_short" class="text"
									       value='<?= $row->description_short; ?>'/>
								</li>
								<li>
									<h3>Activity Text</h3>
									<textarea class="text_area" name="description_long"
									          id="description_long"> <?= $row->description_long; ?></textarea>
								</li>
								<li>
									<h3>They'll learn</h3>
									<textarea class="text_area" name="they_learn"
									          id="they_learn"> <?= $row->they_learn; ?></textarea>
								</li>
								<li>
									<h3>What's great about it</h3>
									<textarea class="text_area" name="description_detailled"
									          id="description_detailled"> <?= $row->description_detailled; ?></textarea>
								</li>
								<li>
									<h3>What to expect</h3>
									<textarea class="text_area" name="to_expect"
									          id="to_expect"><?= $row->to_expect; ?></textarea>
								</li>
								<li>
									<h3>You bring</h3>
									<textarea class="text_area" name="they_bring"
									          id="they_bring"><?= $row->they_bring; ?></textarea>
								</li>
								<li>
									<h3>We provide</h3>
									<textarea class="text_area" name="we_provide"
									          id="we_provide"><?= $row->we_provide; ?></textarea>
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
								        value='<?= $row->style_id; ?>'/>

								<? if (isset($styles)) : foreach ($styles as $style) : ?>
									<? if ($row->style_id == $style->style_id) : ?>
										<option selected value="<?= $style->style_id; ?>"><?= $style->name; ?></option>
									<? else : ?>
										<option value="<?= $style->style_id; ?>"><?= $style->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Physical_level</label>
								<select type="text" name="physical_level_id" id="physical_level_id" class="text"
								        value='<?= $row->physical_level_id; ?>'/>

								<? if (isset($physical_levels)) : foreach ($physical_levels as $physical_level) : ?>
									<? if ($row->physical_level_id == $physical_level->physical_level_id) : ?>
										<option selected
										        value="<?= $physical_level->physical_level_id; ?>"><?= $physical_level->name; ?></option>
									<? else : ?>
										<option
											value="<?= $physical_level->physical_level_id; ?>"><?= $physical_level->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Service_level</label>
								<select type="text" name="service_level_id" id="service_level_id" class="text"
								        value='<?= $row->service_level_id; ?>'/>

								<? if (isset($service_levels)) : foreach ($service_levels as $service_level) : ?>
									<? if ($row->service_level_id == $service_level->service_level_id) : ?>
										<option selected
										        value="<?= $service_level->service_level_id; ?>"><?= $service_level->name; ?></option>
									<? else : ?>
										<option
											value="<?= $service_level->service_level_id; ?>"><?= $service_level->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Duration (hours)</label>
								<input type="text" name="duration" id="duration" class="digits text"
								       value='<?= $row->duration; ?>'/>
							</li>
							<li>
								<label>Duration Text</label>
								<input type="text" name="duration_text" id="duration_text" class="text"
								       value='<?= $row->duration_text; ?>'/>
							</li>
							<li>
								<label>Minimum capacity</label>
								<input type="text" name="capacity_min" id="capacity_min" class="digits text"
								       value='<?= $row->capacity_min; ?>'/>
							</li>
							<li>
								<label>Maximum capacity</label>
								<input type="text" name="capacity_max" id="capacity_max" class="digits text"
								       value='<?= $row->capacity_max; ?>'/>
							</li>
							<li>
								<label>Minimum Age</label>
								<input type="text" name="age_min" id="age_min" class="digits text"
								       value='<?= $row->age_min; ?>'/>
							</li>
							<li>
								<label>Maximum Age</label>
								<input type="text" name="age_max" id="age_max" class="digits text"
								       value='<?= $row->age_max; ?>'/>
							</li>
							<li>
								<label>Featured?</label>
								<?= form_checkbox('is_featured', $row->is_featured, $row->is_featured) ?>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<label>Active?</label>
								<?= form_checkbox('is_active', $row->is_active, $row->is_active) ?> </li>
							</li>
							<li>&nbsp;
							<li>
								<label>Medical History?</label>
								<?= form_checkbox('is_questionaire', $row->is_questionaire, $row->is_questionaire) ?>
							</li>
						</ul>
					</div>
				</div>
				<div id="tabs-3">
					<div id="inputform">
						<ul>
							<!--							<li>
								<label>Tax Plan</label>
								<select type="text" name="tax_plan_id" id="tax_plan_id" class="text"  value='<?= $row->tax_plan_id; ?>' />
								
								<? if (isset($tax_plans)) : foreach ($tax_plans as $tax_plan): ?>
								<? if ($row->tax_plan_id == $tax_plan->tax_plan_id) : ?>
								<option selected value="<?= $tax_plan->tax_plan_id; ?>"><?= $tax_plan->name; ?></option>
								<? else : ?>
								<option          value="<?= $tax_plan->tax_plan_id; ?>"><?= $tax_plan->name; ?></option>
								<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
-->
							<li>
								<label>Inquiry Message</label>
								<select type="text" name="inquiry_message_id" id="inquiry_message_id" class="text"
								        value='<?= $row->inquiry_message_id; ?>'/>

								<? if (isset($inquiry_messages)) : foreach ($inquiry_messages as $inquiry_message) : ?>
									<? if ($row->inquiry_message_id == $inquiry_message->inquiry_message_id) : ?>
										<option selected
										        value="<?= $inquiry_message->inquiry_message_id; ?>"><?= $inquiry_message->name; ?></option>
									<? else : ?>
										<option
											value="<?= $inquiry_message->inquiry_message_id; ?>"><?= $inquiry_message->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Confirmation Message</label>
								<select type="text" name="confirmation_message_id" id="confirmation_message_id"
								        class="text" value='<?= $row->confirmation_message_id; ?>'/>

								<? if (isset($confirmation_messages)) : foreach ($confirmation_messages as $confirmation_message): ?>
									<? if ($row->confirmation_message_id == $confirmation_message->confirmation_message_id) : ?>
										<option selected
										        value="<?= $confirmation_message->confirmation_message_id; ?>"><?= $confirmation_message->name; ?></option>
									<? else : ?>
										<option
											value="<?= $confirmation_message->confirmation_message_id; ?>"><?= $confirmation_message->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<label>Booking Message</label>
								<select type="text" name="booking_message_id" id="booking_message_id" class="text"
								        value='<?= $row->booking_message_id; ?>'/>

								<? if (isset($booking_messages)) : foreach ($booking_messages as $booking_message): ?>
									<? if ($row->booking_message_id == $booking_message->booking_message_id) : ?>
										<option selected
										        value="<?= $booking_message->booking_message_id; ?>"><?= $booking_message->name; ?></option>
									<? else : ?>
										<option
											value="<?= $booking_message->booking_message_id; ?>"><?= $booking_message->name; ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Please call</label>
								<?= form_checkbox('is_please_call', $row->is_please_call, $row->is_please_call) ?> </li>
						</ul>
					</div>
				</div>
			</div>
			<ul border="0">
				<li>
					<input type="submit" name="update" value="Update" class="buttons"/>
					<input type="submit" name="return" value="Save & Return" class="buttons"/>
					<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
				</li>
				<?= form_close(); ?>
			</ul>
			<? endforeach; ?>
			<? else : ?>
				<p>No records were returned.</p>
			<? endif; ?>
		</div>
		<div class="clearfix"></div>
		<i class="note"><?= $bottom_note ?></i>
		<? $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>