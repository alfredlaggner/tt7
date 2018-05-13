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
					name: {
						required: true,
						minlength: 3
					},
					code: {
						required: true,
						minlength: 5,
						maxlength: 5
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
				<h2><?= $title_action ?></h2>
				<span>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</span>
			</div>
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Descriptions</a></li>
					<li><a href="#tabs-2">Settings</a></li>
					<li><a href="#tabs-3">Messages</a></li>
				</ul>
				<div id="tabs-1">
					<div class="content-box">
						<div id="inputform">
							<ul>
								<? $attributes = array('id' => 'activity'); ?>
								<?= form_open('activity/create', $attributes); ?>
								<li>
									<label>Account</label>
									<select type="text" name="account_id" id="account_id" class="text" value=''/>

									<? if (isset($accounts)) : foreach ($accounts as $account): ?>
										<option
											value="<?= $account->account_id; ?>"><?= $account->account_name; ?></option>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>
								<li>
									<label>Activity Name</label>
									<input type="text" name="name" id="name" class="text" value=''/>
								</li>
								<li>
									<label>Activity Code</label>
									<input type="text" name="code" id="code" class="text" value=''/>
								</li>
								<li>
									<label>Division</label>
									<select type="text" name="division_id" id="division_id" class="text" value=''/>

									<? if (isset($divisions)) : foreach ($divisions as $division) : ?>
										<option value="<?= $division->division_id; ?>"><?= $division->name; ?></option>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>

								<li>
									<label>Sort Order</label>
									<input type="text" name="order" id="order" class="text" value=''/>
								</li>

								<!--								<li>
									<label>Region</label>
									<select type="text" name="region_id" id="region_id" class="text"  value='' />
									
									<? if (isset($regions)) : foreach ($regions as $region): ?>
									<option          value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</li>	
-->
								<li>
									<label>Headline</label>
									<input type="text" name="slogan" id="slogan" class="text" value=''/>
								</li>
								<li>
									<label>Short Summary</label>
									<input type="text" name="description_short" id="description_short" class="text"
									       value=''/>
								</li>
								<li>
									<label>Activity Text</label>
									<textarea class="text_area" name="description_long"
									          id="description_long"></textarea>
								</li>
								<li>
									<label>They'll learn</label>
									<textarea class="text_area" name="they_learn" id="they_learn"></textarea>
								</li>
								<li>
									<label>What's great about it</label>
									<textarea class="text_area" name="description_detailled"
									          id="description_detailled"></textarea>
								</li>
								<li>
									<label>What to expect</label>
									<textarea class="text_area" name="to_expect" id="to_expect"></textarea>
								</li>
								<li>
									<label>You bring</label>
									<textarea class="text_area" name="they_bring" id="they_bring"></textarea>
								</li>
								<li>
									<label>We provide</label>
									<textarea class="text_area" name="we_provide" id="we_provide"></textarea>
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
								<select type="text" name="style_id" id="style_id" class="text" value=''/>

								<? if (isset($styles)) : foreach ($styles as $style) : ?>
									<option value="<?= $style->style_id; ?>"><?= $style->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Physical_level</label>
								<select type="text" name="physical_level_id" id="physical_level_id" class="text"
								        value=''/>

								<? if (isset($physical_levels)) : foreach ($physical_levels as $physical_level) : ?>
									<option
										value="<?= $physical_level->physical_level_id; ?>"><?= $physical_level->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Service_level</label>
								<select type="text" name="service_level_id" id="service_level_id" class="text"
								        value=''/>

								<? if (isset($service_levels)) : foreach ($service_levels as $service_level) : ?>
									<option
										value="<?= $service_level->service_level_id; ?>"><?= $service_level->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li>
								<label>Duration</label>
								<input type="text" name="duration" id="duration" class="digits text" value=''/>
							</li>
							<li>
								<label>Duration Text</label>
								<input type="text" name="duration_text" id="duration_text" class="text" value=''/>
							</li>
							<li>
								<label>Minimum capacity</label>
								<input type="text" name="capacity_min" id="capacity_min" class="digits text" value=''/>
							</li>
							<li>
								<label>Maximum capacity</label>
								<input type="text" name="capacity_max" id="capacity_max" class="digits text" value=''/>
							</li>
							<li>
								<label>Minimum Age</label>
								<input type="text" name="weight_min" id="age_min" class="digits text" value=''/>
							</li>
							<li>
								<label>Maximum Age</label>
								<input type="text" name="age_max" id="age_max" class="digits text" value=''/>
							</li>
							<li>
								<label>Featured?</label>
								<?= form_checkbox('is_featured', 'no', FALSE) ?> </li>
							<li>
								<label>Active?</label>
								<?= form_checkbox('is_active', 'no', FALSE) ?> </li>
							<li>&nbsp;
							<li>
								<label>Medical History?</label>
								<?= form_checkbox('is_questionaire', 'no', FALSE) ?> </li>

						</ul>
					</div>
				</div>
				<div id="tabs-3">
					<div id="inputform">
						<ul>
							<li> Inquiry Message
								<select type="text" name="inquiry_message_id" id="inquiry_message_id" class="text"
								        value=''/>

								<? if (isset($inquiry_messages)) : foreach ($inquiry_messages as $inquiry_message) : ?>
									<option
										value="<?= $inquiry_message->inquiry_message_id; ?>"><?= $inquiry_message->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li> Confirmation Message
								<select type="text" name="confirmation_message_id" id="confirmation_message_id"
								        class="text" value=''/>

								<? if (isset($confirmation_messages)) : foreach ($confirmation_messages as $confirmation_message): ?>
									<option
										value="<?= $confirmation_message->confirmation_message_id; ?>"><?= $confirmation_message->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li> Booking Message
								<select type="text" name="booking_message_id" id="booking_message_id" class="text"
								        value=''/>

								<? if (isset($booking_messages)) : foreach ($booking_messages as $booking_message): ?>
									<option
										value="<?= $booking_message->booking_message_id; ?>"><?= $booking_message->name; ?></option>
								<? endforeach; ?>
								<? endif; ?>
								</select>
							</li>
							<li> Please call <?= form_checkbox('is_please_call', 'no', FALSE) ?> </li>
							<li>&nbsp; </li>
							<li>
								<input type="submit" name="create" value="Create" class="buttons"/>
								<input type="submit" name="cancel" value="Cancel" class="cancel  buttons"/>
							</li>
							<?= form_close(); ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
				pages.</i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>