<?= $head ?>
<style>
	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 5px;
		font-weight: normal;
	}

	.text_area_width {
		max-width: none;
	}
</style>
<body>
<?= $header ?>
<section class="section" id="section-7">
	<div class="container">
		<!-- !PAGE-CONTENT -->

		<div id="page">
			<h1 class="page_header">Enter Student Information</h1>
			<? $attributes = array('id' => 'ledger', 'name' => 'ledger', 'role' => 'form', 'data-toggle' => "cvalidator");
			echo form_open('tt_v3/create_booking', $attributes); ?>
			<? for ($i = 1; $i <= $nr_of_students; $i++) : ?>
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
						<!--                        --><? // $attributes = array('id' => 'ledger', 'name' => 'ledger', 'role' => 'form', 'data-toggle' => "cvalidator");
//                        echo form_open('tt_v3/create_booking', $attributes); ?>
						<? if (isset($events)) : foreach ($events as $event) : ?>
							<input type="hidden" name="event_id" value="<?= $event_id ?>">
							<?= form_hidden('nr_of_students', $nr_of_students); ?>
							<input type="hidden" name="promo_code" value="<?= $promo_code ?>">
							<input type="hidden" name="location_id" value="<?= $location_id ?>">
							<input type="hidden" name="activity_id" id="activity_id"
							       value='<?= $event['activity_id'] ?>'/>
							<input type="hidden" name="booking_date" id="booking_date"
							       value='<?= date("Y-m-d g:i:s") ?>'/>
							<input type="hidden" name="name" id="name" readonly="readonly" value=''/>
							<input type="hidden" name="date" id="date" readonly
							       value='<? echo $event['event_date'] ?>'/>
							<input type="hidden" name="time" id="time" readonly value='<?= $event['event_time'] ?>'/>
							<input type="hidden" name="duration" id="duration" readonly
							       value='<? echo $event['duration'] ?>'/>
							<input type="hidden" name="instructor" id="instructor" readonly value='
							<? $event['instructor'] = $this->event_to_employee_model->get_employee_string($event['event_event_id']);
							echo $event['instructor'] ?>'/>
							<input type="hidden" name="price" id="price" readonly
							       value='<? echo $event['rate_price'] ?>'/>
							<input type="hidden" name="exp_discount_price" id="exp_discount_price" readonly
							       value='<? echo $event['exp_discount_price'] ?>'/>
							<input type="hidden" name="discount" id="discount" readonly
							       value='<?= $event['discount'] ?>'/>
							<input type="hidden" name="tax" id="tax" readonly value='<?= $event['tax'] ?>'/>
							<input type="hidden" name="available" id="available" readonly
							       value='<?= $event['available']; ?>'/>
							<input type="hidden" name="attending" id="attending" readonly
							       value='<?= $event['attending']; ?>'/>
							<input type="hidden" name="$is_questionaire" id="$is_questionaire" readonly
							       value='<?= $event['$is_questionaire']; ?>'/>
							<input type="hidden" name="instructor" id="instructor" readonly value='
							<? $event['instructor'] = $this->event_to_employee_model->get_employee_string($event['event_event_id']);
							echo $event['instructor'] ?>'/>
							<?
							$is_questionaire = FALSE;
							$is_questionaire = $event['is_questionaire'];
							?>
						<? endforeach ?>
						<? else : ?>
							<?= "no events delivered!" ?>
						<? endif ?>
					<? endif ?>
					<!--				<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
	  <div class="form-group">

								<label for="first_name<?= $i ?>">First Name<span> *</span></label>
								<input type="input" class="form-control" name="first_name<?= $i ?>" id="first_name<?= $i ?>" value="" >
	</div>					

  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
-->
					<div class="row">
						<div class="col-md-6">
							<fieldset>
								<div class="form-group">
									<? if ($i == 1) : ?>
										<label class="control-label" for="first_name<?= $i ?>">First
											Name<span> * </span></label>
										<input type="text" class="form-control" name="first_name<?= $i ?>"
										       id="first_name<?= $i ?>" required value="">
									<? else : ?>
										<label>First Name</label>
										<input type="text" class="form-control" name="first_name<?= $i ?>"
										       id="first_name<?= $i ?>" value=""/>
									<? endif ?>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<? if ($i == 1) : ?>
										<label>Last Name<span> *</span></label>
										<input type="text" class="form-control"
										       name="last_name<?= $i ?>" id="last_name<?= $i ?>" required>
									<? else : ?>
										<label>Last Name</label>
										<input type="text" class="form-control validate[required]"
										       name="last_name<?= $i ?>" id="last_name<?= $i ?>" value="">
									<? endif ?>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<? if ($i == 1) : ?>
									<label>Email<span> *</span></label>
									<input type="email" required
									       class="form-control"
									       name="email1" id="email1" value="" required>
									<div class="help-block with-errors"></div>

								</div>
								<div class="form-group">
									<label>ConfirmEmail<span> *</span></label>
									<input type="email" required
									       class="form-control"
									       name="confirmEmail1" id="confirmEmail1" value="" required>
									<div class="help-block with-errors"></div>

								</div>
								<? else : ?>
									<label>Email<span></span></label>
									<input type="email" class="form-control" name="email<?= $i ?>"
									       id="email<?= $i ?>" value="">
								<? endif ?>

								<div class="form-group">
									<? if ($i == 1) : ?>
										<label>Phone<span> *</span></label>
										<input type="phone" required class="form-control"
										       name="cell<?= $i ?>" id="cell<?= $i ?>" value="" required>
									<? else : ?>
										<label>Phone</label>
										<input type="phone" class="form-control" name="cell<?= $i ?>" id="cell<?= $i ?>"
										       value="">
									<? endif ?>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label>Emergency Contact<span> </span></label>
									<input type="text" class="form-control" name="emergency_contact<?= $i ?>"
									       id="emergency_contact<?= $i ?>" value="">
								</div>
								<div class="form-group">
									<label>Emergency Phone<span> </span></label>
									<input type="text" class="form-control" name="emergency_phone<?= $i ?>"
									       id="emergency_phone<?= $i ?>" value="">
								</div>
							</fieldset>
						</div>
						<!--<div class = "col-md-1" ></div>-->
						<div class="col-md-6">
							<fieldset>
								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" name="address1<?= $i ?>"
									       id="address1<?= $i ?>" value=""/>
								</div>
								<div class="form-group">
									<? if ($i == 1) : ?>
										<label>City<span> *</span></label>
										<input type="text" required class="form-control"
										       name="city<?= $i ?>" id="city<?= $i ?>" value="" required>
									<? else : ?>
										<label>City</label>
										<input type="text" class="form-control" name="city<?= $i ?>" id="city<?= $i ?>"
										       value="">
									<? endif ?>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label>State</label>
									<input type="text" class="form-control" name="state<?= $i ?>" id="state<?= $i ?>"
									       value="CA">
								</div>
								<div class="form-group">
									<label>Zip Code</label>
									<input type="text" class="form-control" name="zip<?= $i ?>" id="zip<?= $i ?>"
									       value="">
								</div>
								<div class="form-group">
									<label>Country</label>
									<input type="text" class="form-control" name="country<?= $i ?>"
									       id="country<?= $i ?>" value="USA">
								</div>
								<div class="form-group"></div>
							</fieldset>
						</div>
					</div>
					<!--right area-->

					<? //$is_questionaire = false;
					if ($is_questionaire) : ?>
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

								<h2>Questionnaire</h2>

							<? else : ?>
								<hr/>
								<h3>Questionnare for student <?= $i ?></h3>
								<? if ($error) echo "Something went wrong : " . $error; ?>


							<? endif ?>
							<div class="row">
								<div class="col-md-5">
									<h4>We will keep your information strictly confidential.</h4>
									<fieldset>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_questionaire' . $i]; ?>
												<?= form_checkbox('is_questionaire' . $i, 'no', TRUE, $data) ?>
												Please uncheck if you refuse the questionnaire! </label>
										</div>
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label>Date of birth</label>
											<? $data = ['type' => 'date', 'class' => "form-control", 'id' => 'dob' . $i]; ?>
											<?= form_date('dob' . $i, '', $data); ?>
										</div>
										<div class="form-group">
											<?
											$data = ['class' => "form-control", 'id' => 'gender' . $i, 'onChange' => "xajax_disp_pregnant (xajax.getFormValues( 'ledger' )," . $i . "); return false;"];
											$choices = ['M' => 'Male', 'F' => 'Female']; ?>
											<label>Gender </label>
											<?= form_dropdown('sex' . $i, $choices, '', $data) ?>
										</div>
										<div class="form-group">
											<? $data = ['type' => 'number', 'class' => "form-control", 'placeholder' => 'inches', 'min' => '50', 'max' => '84']; ?>
											<label>Height</label>
											<?= form_number('height' . $i, '', $data) ?>
										</div>
										<div class="form-group">
											<? $data = ['type' => 'number', 'class' => "form-control", 'placeholder' => 'pound', 'min' => '75', 'max' => '300']; ?>
											<label>Weight</label>
											<?= form_number('weight' . $i, '', $data) ?>
										</div>

									</fieldset>
									<h3>Physical conditioning</h3>
									<fieldset>
										<h4>Tell us what types of exercise you do and how often you do each
											activity.</h4>
										<div class="form-group">
											<? $data = ['rows' => '10', 'class' => "form-control text_area_width"]; ?>
											<?= form_textarea5('current_fitness' . $i, '', $data); ?>
										</div>
									</fieldset>
									<fieldset>
										<h4>What kind of experience do you have with similar activities or trips?</h4>
										<div class="form-group">
											<? $data = ['rows' => '10', 'class' => "form-control text_area_width"]; ?>
											<?= form_textarea5('experience' . $i, '', $data); ?>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_allow_photo_graphs' . $i]; ?>
												<?= form_checkbox('is_allow_photo_graphs' . $i, 'no', FALSE, $data) ?>
												Allow photographs of you? </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_fear_of_heights' . $i]; ?>
												<?= form_checkbox('is_fear_of_heights' . $i, 'no', FALSE, $data) ?>
												Do you have fear of heights? </label>
										</div>
									</fieldset>
									<h3>Equipment</h3>
									<fieldset>
										<legend>Treks and Tracks provides equipment for you. In order to help your guide
											prepare, please mark equipment items that you wish to have provided for you.
										</legend>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'have_backpack' . $i]; ?>
												<?= form_checkbox('have_backpack' . $i, 'no', FALSE, $data) ?>
												Bring a backpack? </label>
										</div>

										<div class="checkbox">
											<label>
												<? $data = ['id' => 'have_tent' . $i]; ?>
												<?= form_checkbox('have_tent' . $i, 'no', FALSE, $data) ?>
												Bring a tent? </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'have_sleeping_pad' . $i]; ?>
												<?= form_checkbox('have_sleeping_pad' . $i, 'no', FALSE, $data) ?>
												Bring a sleeping pad? </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'have_sleeping_bag' . $i]; ?>
												<?= form_checkbox('have_sleeping_bag' . $i, 'no', FALSE, $data) ?>
												Bring a sleeping bag? </label>
										</div>

									</fieldset>
									<h3>Dietary Preferences</h3>
									<fieldset>
										<h4>Do you have any dietary preferences or restrictions?</h4>
										<? $data = ['rows' => '10', 'class' => "form-control text_area_width"]; ?>
										<?= form_textarea5('dietary_restrictions' . $i, '', $data); ?>
									</fieldset>
									<fieldset>
										<legend>What do you prefer in the morning?</legend>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_coffee' . $i]; ?>
												<?= form_checkbox('breakfast_coffee' . $i, 'no', FALSE, $data) ?>
												Coffee </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_black_tea' . $i]; ?>
												<?= form_checkbox('breakfast_black_tea' . $i, 'no', FALSE, $data) ?>
												Black Tea </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_green_tea' . $i]; ?>
												<?= form_checkbox('breakfast_green_tea' . $i, 'no', FALSE, $data) ?>
												Green Tea </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_herb_tea' . $i]; ?>
												<?= form_checkbox('breakfast_herb_tea' . $i, 'no', FALSE, $data) ?>
												Herb Tea </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_hot_chocolate' . $i]; ?>
												<?= form_checkbox('breakfast_hot_chocolate' . $i, 'no', FALSE, $data) ?>
												Hot Chocolate</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'breakfast_other' . $i]; ?>
												<?= form_checkbox('breakfast_other' . $i, 'no', FALSE, $data) ?>
												Other</label>
										</div>
										<div class="form-group">
											<label>Other Preference</label>
											<? $data = ['id' => 'breakfast_other_text' . $i, 'class' => 'form-control']; ?>
											<?= form_input('breakfast_other_text' . $i, '', $data) ?>
										</div>
									</fieldset>
								</div>
								<div class="col-md-1">&nbsp;</div>
								<div class="col-md-5">
									<h3>Do you experience any of the following conditions?</h3>
									<fieldset>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_asthma' . $i]; ?>
												<?= form_checkbox('is_asthma' . $i, 'no', FALSE, $data) ?>
												Asthma/respiratory Illness </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_inhaler' . $i]; ?>
												<?= form_checkbox('is_inhaler' . $i, 'no', FALSE, $data) ?>
												If yes, do you carry an inhaler?</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_diabetes' . $i]; ?>
												<?= form_checkbox('is_diabetes' . $i, 'no', FALSE, $data) ?>
												Diabetes </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_seizures' . $i]; ?>
												<?= form_checkbox('is_seizures' . $i, 'no', FALSE, $data) ?>
												Seizures/epilepsy </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_cardio_disease' . $i]; ?>
												<?= form_checkbox('is_cardio_disease' . $i, 'no', FALSE, $data) ?>
												Cardiovascular disease </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_hypertension' . $i]; ?>
												<?= form_checkbox('is_hypertension' . $i, 'no', FALSE, $data) ?>
												High blood pressure </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_knee_ankle_shoulder' . $i]; ?>
												<?= form_checkbox('is_knee_ankle_shoulder' . $i, 'no', FALSE, $data) ?>
												Joint (hip, knee, ankle, shoulder etc.) or back injuries (including
												sprains)</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_bleeding' . $i]; ?>
												<?= form_checkbox('is_bleeding' . $i, 'no', FALSE, $data) ?>
												Bleeding or blood disorders </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_dizziness' . $i]; ?>
												<?= form_checkbox('is_dizziness' . $i, 'no', FALSE, $data) ?>
												Dizziness or fainting episodes </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_fear_of_heights' . $i]; ?>
												<?= form_checkbox('is_fear_of_heights' . $i, 'no', FALSE, $data) ?>
												Do you have a fear of heights or exposed places?</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_see_medical_specialist' . $i]; ?>
												<?= form_checkbox('is_see_medical_specialist' . $i, 'no', FALSE, $data) ?>
												Do you see a medical/physical specialist of any kind</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_any_other_condition' . $i]; ?>
												<?= form_checkbox('is_any_other_condition' . $i, 'no', FALSE, $data) ?>
												Any other condition that would affect your performance or
												health </label>
										</div>
									</fieldset>
									<fieldset>
										<div>
											<h4>Please explain any yes responses in the space below – including
												approximate
												dates and current status.</h4>
											<? $data = ['rows' => '10', 'class' => "form-control text_area_width"]; ?>
											<?= form_textarea5('response_explainations' . $i, '', $data); ?>
										</div>
									</fieldset>
									<h3>Allergies</h3>
									<h4>Are you allergic to any of the following?</h4>
									<fieldset>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_allergic_medications' . $i]; ?>
												<?= form_checkbox('is_allergic_medications' . $i, 'no', FALSE, $data) ?>
												Medications </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_allergic_insect_stings' . $i]; ?>
												<?= form_checkbox('is_allergic_insect_stings' . $i, 'no', FALSE, $data) ?>
												Insect stings (If yes, we strongly recommend that you carry
												medication.) </label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_allergic_food' . $i]; ?>
												<?= form_checkbox('is_allergic_food' . $i, 'no', FALSE, $data) ?>
												Food allergies</label>
										</div>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_allergic_other' . $i]; ?>
												<?= form_checkbox('is_allergic_other' . $i, 'no', FALSE, $data) ?>
												Other </label>
										</div>
									</fieldset>
									<fieldset>
										<div class="checkbox">
											<? $data = ['id' => 'allergy_explainations' . $i, 'class' => 'text']; ?>
											<h4> Please explain any yes responses in the space below – including
												description
												of allergic response. </h4>
											<? $data = ['rows' => '10', 'class' => "form-control text_area_width"] ?>
											<?= form_textarea5('allergy_explainations' . $i, '', $data); ?>
										</div>
									</fieldset>
									<h3>Medications</h3>
									<fieldset>
										<div class="checkbox">
											<label>
												<? $data = ['id' => 'is_medications' . $i]; ?>
												<?= form_checkbox('is_medications' . $i, 'no', FALSE, $data) ?>
												Are you currently taking any medications? </label>
										</div>
									</fieldset>
									<fieldset>
										<h4>If yes, please list medication, dosage, and condition for which you are
											taking
											the medication</h4>
										<? $data = ['rows' => '10', 'class' => "form-control text_area_width"]; ?>
										<?= form_textarea5('medication_explainations' . $i, '', $data); ?>
									</fieldset>
									<fieldset>
										<div id="disp_pregnant<?= $i ?>">
											<!--										<div id = "new_line" >
												<? $data = ['id' => 'is_pregnant' . $i]; ?>
												<?= form_checkbox('is_pregnant' . $i, 'no', FALSE, $data) ?>
												</label>"is_pregnant<?= $i ?>" id="somelabel">Are you pregnant? </label>
										</div>
--> </div>
									</fieldset>

									<!-- Medical History End -->
								</div>
							</div>
						</div>
					<? endif ?>

					<!-- <div class="row">
						 <div class="col-md-3 col-md-offset-10">
							 <input type="submit" value="CONTINUE"/>
						 </div>
					 </div>-->


				</div>
				<!--customer_data-->
			<? endfor ?>
			<div class="row">
				<div class="col-md-12  col-md-push-10">
					<div class="form-group">
						<!--                        <input type="submit" value="CONTINUE"/>-->
						<button type="submit" value="Continue" class="btn btn-sm btn-fill">Continue</button>
					</div>
				</div>
			</div>
			</form>
		</div>
		<!-- !PAGE-CONTENT-END -->
	</div>
</section>
<?= $footer ?>

<script>
	$(document).ready(function () {
		$('#ledger').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				email1: {
					validators: {
						identical: {
							field: 'confirmEmail1',
							message: 'The email and its confirm are not the same'
						}
					}
				},
				confirmEmail1: {
					validators: {
						identical: {
							field: 'email1',
							message: 'The email and its confirm are not the same'
						}
					}
				}
			}
		});
	});
</script>
</body>
</html>