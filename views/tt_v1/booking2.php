<?php $this->load->view('xajax/xajax'); ?>
<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->

<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="<?= base_url() ?>css/questionaire.css" type="text/css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#ledger").validationEngine('attach',
			{promptPosition: "topRight", scroll: true});
	});
	jQuery(function ($) {
		$("#exp").mask("99/99");
		$("#ccv").mask("999");
	});
</script>

<body>

<!-- !top-bar -->
<?= $region_name ?>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<!-- !header -->
		<? $this->load->view('tt_v1/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<div id="page" class="sg-35">
			<h1>Enter Student Information</h1>
			<div class="line"></div>
			<div id="page-content">
				<? for ($i = 1;
				$i <= $nr_of_students;
				$i++) : ?>
				<script>
					jQuery(function ($) {
						$("#cell<?= $i ?>").mask("(999) 999-9999");
						$("#emergency_phone<?= $i ?>").mask("(999) 999-9999");
					});
				</script>
				<div id="customer_data">
					<div class="clr"></div>
					<? if ($i == 1) : ?>
						<h2><span>STUDENT </span>
						<? if ($nr_of_students > 1) : ?>
							Primary Contact</h2>
						<? else : ?>
							</h2>
						<? endif ?>
					<? else : ?>
						<hr/>
						<h2><span>STUDENT </span>
							<? if ($error) echo "Something went wrong : " . $error; ?>
							<?= $i ?>
						</h2>
					<? endif ?>
					<? if ($i == 1) : ?>
						<? $attributes = array('id' => 'ledger', 'name' => 'ledger');

						echo form_open('tt_v1/create_booking', $attributes); ?>
						<? if (isset($events)) : foreach ($events as $event) : ?>
							<input type="hidden" name="event_id" value="<?= $event_id ?>">
							<?= form_hidden('nr_of_students', $nr_of_students); ?>
							<input type="hidden" name="promo_code" class="text" value="<?= $promo_code ?>">
							<input type="hidden" name="location_id" value="<?= $location_id ?>">
							<input type="hidden" name="activity_id" id="activity_id"
							       value='<?= $event['activity_id'] ?>'/>
							<input type="hidden" name="booking_date" id="booking_date"
							       value='<?= date("Y-m-d g:i:s") ?>'/>
							<input type="hidden" name="name" id="name" class="text" readonly="readonly" value=''/>
							<input type="hidden" name="date" id="date" class="text" readonly
							       value='<? echo $event['event_date'] ?>'/>
							<input type="hidden" name="time" id="time" class="text" readonly
							       value='<?= $event['event_time'] ?>'/>
							<input type="hidden" name="duration" id="duration" class="text" readonly
							       value='<? echo $event['duration'] ?>'/>
							<input type="hidden" name="instructor" id="instructor" class="text" readonly value='
							<? $event['instructor'] = $this->event_to_employee_model->get_employee_string($event['event_event_id']);
							echo $event['instructor'] ?>'/>
							<input type="hidden" name="price" id="price" class="text" readonly
							       value='<? echo $event['rate_price'] ?>'/>
							<input type="hidden" name="exp_discount_price" id="exp_discount_price" class="text" readonly
							       value='<? echo $event['exp_discount_price'] ?>'/>
							<input type="hidden" name="discount" id="discount" class="text" readonly
							       value='<?= $event['discount'] ?>'/>
							<input type="hidden" name="tax" id="tax" class="text" readonly
							       value='<?= $event['tax'] ?>'/>
							<input type="hidden" name="available" id="available" class="text" readonly
							       value='<?= $event['available']; ?>'/>
							<input type="hidden" name="attending" id="attending" class="text" readonly
							       value='<?= $event['attending']; ?>'/>
							<?
							$is_questionaire = FALSE;
							$is_questionaire = $event['is_questionaire'];
							?>
						<? endforeach ?>
						<? else : ?>
							<?= "no events delivered!" ?>
						<? endif ?>
					<? endif ?>
					<div id="left"> <!--inside the input area-->
						<!--				<fieldset>
-->
						<? if ($i == 1) : ?>
							<div style="float:left">
								<label>First Name<span> *</span></label>
								<input type="text" class="text validate[required]" size="14" name="first_name<?= $i ?>"
								       id="first_name<?= $i ?>" value="">
								</input>
							</div>
						<? else : ?>
							<div style="float:left">
								<label>First Name</label>
								<input type="text" class="text" size="14" name="first_name<?= $i ?>"
								       id="first_name<?= $i ?>" value="">
								</input>
							</div>
						<? endif ?>
						<div>
							<? if ($i == 1) : ?>
								<label>Last Name<span> *</span></label>
								<input type="text" class="text validate[required]" size="14" name="last_name<?= $i ?>"
								       id="last_name<?= $i ?>" value="">
								</input>
							<? else : ?>
								<label>Last Name</label>
								<input type="text" class="text validate[required]" size="14" name="last_name<?= $i ?>"
								       id="last_name<?= $i ?>" value="">
								</input>
							<? endif ?>
						</div>
						<!--				</fieldset>
				<fieldset>
						<div>
-->
						<div style="float:left">
							<? if ($i == 1) : ?>
								<label>Email<span> *</span></label>
								<input type="email" class="text validate[required,custom[email]]" size="26"
								       name="email<?= $i ?>" id="email<?= $i ?>" value="">
								</input>
							<? else : ?>
								<label>Email<span></span></label>
								<input type="email" class="text" size="26" name="email<?= $i ?>" id="email<?= $i ?>"
								       value="">
								</input>
							<? endif ?>
						</div>
						<div>
							<? if ($i == 1) : ?>
								<label>Phone<span> *</span></label>
								<input type="text" class="text validate[required]" size="12" name="cell<?= $i ?>"
								       id="cell<?= $i ?>" value="">
								</input>
							<? else : ?>
								<label>Phone</label>
								<input type="text" class="text" size="12" name="cell<?= $i ?>" id="cell<?= $i ?>"
								       value="">
								</input>
							<? endif ?>
						</div>
						<!--						</div>
				</fieldset>-->
						<fieldset>
							<div style="float:left">
								<label>Emergency Contact<span> </span></label>
								<input type="text" class="text" size="26" name="emergency_contact<?= $i ?>"
								       id="emergency_contact<?= $i ?>" value="">
								</input>
							</div>
							<div>
								<label>Emergency Phone<span> </span></label>
								<input type="text" class="text" size="12" name="emergency_phone<?= $i ?>"
								       id="emergency_phone<?= $i ?>" value="">
								</input>
							</div>
						</fieldset>
					</div>
					<!--left area-->

					<div id="right"> <!--inside the input area-->
						<!--            <fieldset>
-->
						<div style="float:left">
							<label>Address</label>
							<input type="text" class="text" size="26" name="address1<?= $i ?>" id="address1<?= $i ?>"
							       value="">
							</input>
						</div>
						<div>
							<? if ($i == 1) : ?>
								<label>City<span> *</span></label>
								<input type="text" class="text validate[required]" size="15" name="city<?= $i ?>"
								       id="city<?= $i ?>" value="">
								</input>
							<? else : ?>
								<label>City</label>
								<input type="text" class="text" size="15" name="city<?= $i ?>" id="city<?= $i ?>"
								       value="">
								</input>
							<? endif ?>
						</div>
						<!--            </fieldset>
-->
						<fieldset>
							<div>
								<label>State</label>
								<input type="text" class="text" size="4" name="state<?= $i ?>" id="state<?= $i ?>"
								       value="CA">
								</input>
							</div>
							<div>
								<label>Zip Code</label>
								<input type="text" class="text" size="9" name="zip<?= $i ?>" id="zip<?= $i ?>" value="">
								</input>
							</div>
							<div>
								<label>Country</label>
								<input type="text" class="text" size="" name="country<?= $i ?>" id="country<?= $i ?>"
								       value="USA">
								</input>
							</div>
						</fieldset>
					</div>
					<!--right area-->

					<? if ($is_questionaire) : ?>
						<style type="text/css">
							* {
								padding: 0px;
								margin: 0px;
							}

							.wb {
								width: 15px;
								height: 15px;
								float: left;
								vertical-align: middle;
							}

							#somelabel {
								float: left;
								padding-left: 3px;

							}

							#new_line, #customer_data li {
								width: 100%
							}

							#customer_data fieldset {
								margin-top: 10px;
							}
						</style>
						<div id="customer_data">
							<div class="line"></div>

							<!-- Medical History Start-->
							<? if ($i == 1) : ?>
								<h3>&nbsp;</h3>
								<h2><span> Questionnaire</span>
								<? if ($nr_of_students > 1) : ?>
									Questionnaire</h2>
								<? else : ?>
									</h2>
								<? endif ?>
							<? else : ?>
								<hr/>
								<h3>Medical History
									<? if ($error) echo "Something went wrong : " . $error; ?>
									<?= $i ?>
								</h3>
							<? endif ?>
							<div id="left">
								<h4>We will keep your information strictly confidential.</h4>
								<fieldset>
									<? $data = ['id' => 'is_questionaire' . $i, 'class' => 'wb']; ?>
									<?= form_checkbox('is_questionaire' . $i, 'no', FALSE, $data) ?>
									<label for="is_questionaire<?= $i ?>" id="somelabel">Please check if you
										accept!</label>
								</fieldset>
								<fieldset>
									<div>
										<label>Date of birth</label>
										<? $data = ['id' => 'dob' . $i, 'class' => 'text']; ?>
										<?= form_date('dob' . $i, '', $data); ?>
									</div>
									<div>
										<?
										$data = ['id' => 'gender' . $i, 'class' => 'text', 'onChange' => "xajax_disp_pregnant (xajax.getFormValues( 'ledger' )," . $i . "); return false;"];
										$choices = ['M' => 'Male', 'F' => 'Female'];
										?>
										<label>Gender </label>
										<?= form_dropdown('sex' . $i, $choices, '', $data) ?>
									</div>
									<div>
										<? $data = ['type' => 'number', 'placeholder' => 'inch', 'min' => '0', 'max' => '999', 'class' => 'text']; ?>
										<label>Height</label>
										<?= form_number('height' . $i, '', $data) ?>
									</div>
									<div>
										<? $data = ['type' => 'number', 'placeholder' => 'pound', 'min' => '0', 'max' => '999', 'class' => 'text']; ?>
										<label>Weight</label>
										<?= form_number('weight' . $i, '', $data) ?>
									</div>
								</fieldset>
								<h3>Physical conditioning</h3>
								<fieldset>
									<h4>Tell us what types of exercise you do and how often you do each activity.</h4>
									<? $data = ['rows' => '10', 'cols' => '60']; ?>
									<?= form_textarea5('current_fitness' . $i, '', $data); ?>
								</fieldset>
								<fieldset>
									<h4>What kind of experience do you have with similar activities or trips?</h4>
									<? $data = ['rows' => '10', 'cols' => '60']; ?>
									<?= form_textarea5('experience' . $i, '', $data); ?>
								</fieldset>
								<h3>Equipment</h3>
								<fieldset>
									<legend>Treks and Tracks provides equipment for you. In order to help your guide
										prepare, please mark equipment items that you wish to have provided for you.
									</legend>
									<div id="new_line">
										<? $data = ['id' => 'have_backpack' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('have_backpack' . $i, 'no', FALSE, $data) ?>
										<label for="have_backpack<?= $i ?>" id="somelabel">Bring a backpack? </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'have_tent' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('have_tent' . $i, 'no', FALSE, $data) ?>
										<label for="have_tent<?= $i ?>" id="somelabel">Bring a tent? </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'have_sleeping_bag' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('have_sleeping_bag' . $i, 'no', FALSE, $data) ?>
										<label for="have_sleeping_bag<?= $i ?>" id="somelabel">Bring a sleeping
											bag </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'have_sleeping_pad' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('have_sleeping_pad' . $i, 'no', FALSE, $data) ?>
										<label for="have_sleeping_pad<?= $i ?>" id="somelabel">Bring a sleeping
											pad </label>
									</div>
								</fieldset>
								<h3>Dietary Preferences</h3>
								<fieldset>
									<h4>Do you have any dietary preferences or restrictions?</h4>
									<? $data = ['rows' => '10', 'cols' => '60']; ?>
									<?= form_textarea5('dietary_restrictions' . $i, '', $data); ?>
								</fieldset>
								<fieldset>
									<legend>What do you prefer in the morning?</legend>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_coffee' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_coffee' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_coffee<?= $i ?>" id="somelabel">Coffee </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_black_tea' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_black_tea' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_black_tea<?= $i ?>" id="somelabel">Black Tea </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_green_tea' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_green_tea' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_green_tea<?= $i ?>" id="somelabel">Green Tea </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_herb_tea' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_herb_tea' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_herb_tea<?= $i ?>" id="somelabel">Herb Tea </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_hot_chocolate' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_hot_chocolate' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_hot_chocolate<?= $i ?>" id="somelabel">Hot
											Chocolate</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_other' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('breakfast_other' . $i, 'no', FALSE, $data) ?>
										<label for="breakfast_other<?= $i ?>" id="somelabel">Other</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'breakfast_other_text' . $i, 'class' => 'text']; ?>
										<label for="breakfast_other_text<?= $i ?>">Other Preference</label>
										<?= form_input('breakfast_other_text' . $i, '', $data) ?>
									</div>
								</fieldset>
							</div>
							<div id="right">
								<h3>Do you experience any of the following conditions?</h3>
								<fieldset>
									<div id="new_line">
										<? $data = ['id' => 'is_asthma' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_asthma' . $i, 'no', FALSE, $data) ?>
										<label for="is_asthma<?= $i ?>" id="somelabel">Asthma/respiratory
											Illness </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_inhaler' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_inhaler' . $i, 'no', FALSE, $data) ?>
										<label for="is_inhaler<?= $i ?>" id="somelabel">If yes, do you carry an
											inhaler?</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_diabetes' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_diabetes' . $i, 'no', FALSE, $data) ?>
										<label for="is_diabetes<?= $i ?>" id="somelabel">Diabetes </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_seizures' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_seizures' . $i, 'no', FALSE, $data) ?>
										<label for="is_seizures<?= $i ?>" id="somelabel">Seizures/epilepsy </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_cardio_disease' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_cardio_disease' . $i, 'no', FALSE, $data) ?>
										<label for="is_cardio_disease<?= $i ?>" id="somelabel">Cardiovascular
											disease </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_hypertension' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_hypertension' . $i, 'no', FALSE, $data) ?>
										<label for="is_hypertension<?= $i ?>" id="somelabel">High blood
											pressure </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_knee_ankle_shoulder' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_knee_ankle_shoulder' . $i, 'no', FALSE, $data) ?>
										<label for="is_knee_ankle_shoulder<?= $i ?>" id="somelabel">Joint (hip, knee,
											ankle, shoulder etc.) or back injuries (including sprains)</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_bleeding' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_bleeding' . $i, 'no', FALSE, $data) ?>
										<label for="is_bleeding<?= $i ?>" id="somelabel">Bleeding or blood
											disorders </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_dizziness' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_dizziness' . $i, 'no', FALSE, $data) ?>
										<label for="is_dizziness<?= $i ?>" id="somelabel">Dizziness or fainting
											episodes </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_fear_of_heights' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_fear_of_heights' . $i, 'no', FALSE, $data) ?>
										<label for="is_fear_of_heights<?= $i ?>" id="somelabel">Do you have a fear of
											heights or exposed places?</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_see_medical_specialist' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_see_medical_specialist' . $i, 'no', FALSE, $data) ?>
										<label for="is_see_medical_specialist<?= $i ?>" id="somelabel">Do you see a
											medical/physical specialist of any kind</label>
									</div>
									<div>
										<? $data = ['id' => 'is_any_other_condition' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_any_other_condition' . $i, 'no', FALSE, $data) ?>
										<label for="is_any_other_condition<?= $i ?>" id="somelabel">Any other condition
											that would affect your performance or health</label>
									</div>
								</fieldset>
								<fieldset>
									<div>
										<h4>Please explain any yes responses in the space below – including approximate
											dates and current status.</h4>
										<? $data = ['rows' => '10', 'cols' => '60']; ?>
										<?= form_textarea5('response_explainations' . $i, '', $data); ?>
									</div>
								</fieldset>
								<h3>Allergies</h3>
								<h4>Are you allergic to any of the following?</h4>
								<fieldset>
									<div id="new_line">
										<? $data = ['id' => 'is_allergic_medications' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_allergic_medications' . $i, 'no', FALSE, $data) ?>
										<label for="is_allergic_medications<?= $i ?>"
										       id="somelabel">Medications </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_allergic_insect_stings' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_allergic_insect_stings' . $i, 'no', FALSE, $data) ?>
										<label for="is_allergic_insect_stings<?= $i ?>" id="somelabel">Insect stings (If
											yes, we strongly recommend that you carry medication.) </label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_allergic_food' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_allergic_food' . $i, 'no', FALSE, $data) ?>
										<label for="is_allergic_food<?= $i ?>" id="somelabel">Food allergies</label>
									</div>
									<div id="new_line">
										<? $data = ['id' => 'is_allergic_other' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_allergic_other' . $i, 'no', FALSE, $data) ?>
										<label for="is_allergic_other<?= $i ?>" id="somelabel">Other </label>
									</div>
								</fieldset>
								<fieldset>
									<div id="new_line">
										<? $data = ['id' => 'allergy_explainations' . $i, 'class' => 'text']; ?>
										<h4>
											Please explain any yes responses in the space below – including description
											of allergic response.
											<h4>
												<? $data = ['rows' => '10', 'cols' => '60']; ?>
												<?= form_textarea5('allergy_explainations' . $i, '', $data); ?>
									</div>
								</fieldset>
								<h3>Medications</h3>
								<fieldset>
									<div id="new_line">
										<? $data = ['id' => 'is_medications' . $i, 'class' => 'wb']; ?>
										<?= form_checkbox('is_medications' . $i, 'no', FALSE, $data) ?>
										<label for="is_medications<?= $i ?>" id="somelabel">Are you currently taking any
											medications? </label>
									</div>
								</fieldset>
								<fieldset>
									<div>
										<h4>If yes, please list medication, dosage, and condition for which you are
											taking the medication</h4>
										<? $data = ['rows' => '10', 'cols' => '60']; ?>
										<?= form_textarea5('medication_explainations' . $i, '', $data); ?>
									</div>
								</fieldset>
								<fieldset>
									<div id="disp_pregnant<?= $i ?>">
										<!--										<div id = "new_line" >
												<? $data = ['id' => 'is_pregnant' . $i, 'class' => 'wb']; ?>
												<?= form_checkbox('is_pregnant' . $i, 'no', FALSE, $data) ?>
												<label  for="is_pregnant<?= $i ?>" id="somelabel">Are you pregnant? </label>
										</div>
-->                                    </div>
								</fieldset>

								<!-- Medical History End -->
							</div>
						</div>
						<!--customer_data-->
					<? endif ?>
					<? endfor ?>
					<div id="customer_data">
						<input type="submit" value="CONTINUE" class="submit"/>
					</div>
					</form>
				</div>
			</div>

			<!-- !PAGE-CONTENT-END -->

			<!-- !line -->
			<div class="sg-35 line"></div>
			<? $this->load->view('tt_v1/blocks/footer'); ?>

			<!--        </div>
				</div>
			-->
</body>
</html>