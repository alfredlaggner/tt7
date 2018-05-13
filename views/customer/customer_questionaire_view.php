<? $this->load->view('modules/head') ?>

<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/questionaire.css">

<script type="text/javascript">

	tinyMCE.init({
		selector: 'textarea',
		theme: "advanced",
		mode: "textareas",
		plugins: "autoresize",
		theme_advanced_buttons3_add: "fullpage",
		theme_advanced_statusbar_location: "bottom", theme_advanced_toolbar_location: "top",
		theme_advanced_buttons1: "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
		theme_advanced_buttons2: "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
		theme_advanced_buttons3: "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",

		height: "350"
	});

	<?
	//if (! $is_update)
	//{
	//$this->session->set_userdata(array('back_url'=> $_SERVER['HTTP_REFERER']));
	//}
	//
	////echo 'xxxx' . $_SERVER['HTTP_REFERER'];	
	//
	?>
	$().ready(function () {
		$("#customer").validate(
			{
				rules: {
					cancel: "cancel",
					first_name: {
						required: true,
						minlength: 2
					},
					last_name: {
						required: true,
						minlength: 2
					}
				},
				messages: {
					first_name: {
						required: "Please enter first name",
						minlength: "Minimum length is 2"
					},
					last_name: {
						required: "Please enter last name",
						minlength: "Minimum length is 2"
					},
					sex: {
						required: "Please enter gender",
						maxlength: "Maximum length is 1",
						minlength: "Minimum length is 1"
					}
				}
			});
	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1>
			<?= $title ?>
		</h1>
				<span><a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >
					<?= anchor('customer', 'Customer'); ?>
					>
					<?= $title_action ?>
				</span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<style type="text/css">
	* {
		padding: 0px;
		margin: 0px;
		label: 0;
	}

	#customer_data {
		width: 100%;
		float: left;
		margin-left: 20px;
	}

	#customer_data #left {
		width: 50%;
		float: left;

	}

	#customer_data #right {
		width: 50%;
		float: left;
	}

	#customer_data #left {
		width: 50%;
		float: left;
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
		/*width: 100%;*/
	}

	.new_line {
		width: 100%
	}

	#customer_data fieldset {
		/* overflow: auto;*/
		border: 0;
		margin: 0;
		padding: 0;
	}

	#customer_data .accepted {
		color: #F50D11;

	}

	#customer_data h2 {
		font-size: 18px;
		padding: 10px 0 10px 0;

	}

	#customer_data h3 {
		font-size: 16px;
		padding: 10px 0 10px 0;

	}

	#customer_data h4 {
		font-size: 16px;
		padding: 10px 0 10px 0;

	}


</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>
					<?= $title_action ?>
				</h2>
				<span>Update customer record ...</span></div>
			<div id="customer_data">
				<? if (isset($customers)) : foreach ($customers as $row) : ?>
					<? $attributes = array('id' => 'questionaire'); ?>
					<?= form_open('tt_v3/update_questionaire/' . $customer_id, $attributes); ?>
					<li class="new_line">
						<label>First Name</label>
						<input type="text" name="first_name" id="first_name" class="text"
						       value='<?= $row->first_name ?>'/>
					</li>
					<li class="new_line">
						<label>Last Name</label>
						<input type="text" name="last_name" id="last_name" class="text" value='<?= $row->last_name ?>'/>
					</li>
				<? endforeach; endif ?>
				<? if (isset($questionaires)) : foreach ($questionaires as $row) : ?>

				<!-- Medical History Start-->
				<h2> Questionnaire </h2>
				<div style="padding-right: 10px" id="left">
					<h4>We will keep your information strictly confidential.</h4>
					<fieldset>
						<? $data = ['id' => 'is_questionaire', 'class' => 'wb']; ?>
						<?= form_checkbox('is_questionaire', $row->is_questionaire, $row->is_questionaire, $data) ?>
						<?= form_hidden('counter', $counter); ?>
						<?= form_hidden('customer_questionaire_id', $row->customer_questionaire_id); ?>
						<?= form_hidden('event_id', $event_id); ?>
						<?= form_hidden('location_id', $location_id); ?>
						<label for="is_questionaire" id="somelabel"
						       class="<?= $row->is_questionaire ? 'accepted' : '' ?>">Please check if you
							accept!</label>
					</fieldset>
					<?= form_input('customer_questionaire_id', $row->customer_questionaire_id) ?>
					<fieldset>
						<li class="new_line">
							<label>Date of birth</label>
							<? $data = ['id' => 'dob', 'class' => 'text']; ?>
							<?= form_date('dob', $row->dob, $data); ?>
						</li>
						<li class="new_line">
							<?
							$data = ['id' => 'gender', 'class' => 'text'];
							$choices = ['M' => 'Male', 'F' => 'Female'];
							?>
							<label>Gender </label>
							<?= form_dropdown('sex', $choices, $row->sex, $data) ?>
						</li>
						<li class="new_line">
							<? $data = ['type' => 'number', 'placeholder' => 'inch', 'min' => '0', 'max' => '999', 'class' => 'text']; ?>
							<label>Height</label>
							<?= form_number('height', $row->height, $data) ?>
						</li>
						<li class="new_line">
							<? $data = ['type' => 'number', 'placeholder' => 'pound', 'min' => '0', 'max' => '999', 'class' => 'text']; ?>
							<label>Weight</label>
							<?= form_number('weight', $row->weight, $data) ?>
						</li>
					</fieldset>
					<h4>Please describe your level of physical conditioning</h4>
					<fieldset>
						<p>Include what types of exercise you do and how often you do each activity.</p>
						<? $data = ['id' => 'current_fitness']; ?>
						<?= form_textarea5('current_fitness', $row->current_fitness, $data); ?>
					</fieldset>
					<fieldset>
						<p>What kind of experience do you have with similar activities or trips?</p>
						<? $data = ['rows' => '10', 'id' => 'experience']; ?>
						<?= form_textarea5('experience', $row->experience, $data); ?>
					</fieldset>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'is_fear_of_heights', 'class' => 'wb']; ?>
							<?= form_checkbox('is_fear_of_heights', $row->is_fear_of_heights, $row->is_fear_of_heights, $data) ?>
							<label for="is_fear_of_heights" id="somelabel"
							       class="<?= $row->is_fear_of_heights ? 'accepted' : '' ?>">Do you have a fear of
								heights or exposed places?</label>
						</li>
					</fieldset>
					<h4>Equipment</h4>
					<fieldset>
						<p>Treks and Tracks provides equipment for you. In order to help your guide prepare, please mark
							equipment items that you wish to have provided for you.</p>
						<li class="new_line">
							<? $data = ['id' => 'have_backpack', 'class' => 'wb']; ?>
							<?= form_checkbox('have_backpack', $row->have_backpack, $row->have_backpack, $data) ?>
							<label for="have_backpack" id="somelabel"
							       class="<?= $row->have_backpack ? 'accepted' : '' ?>">Bring a backpack? </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'have_tent', 'class' => 'wb']; ?>
							<?= form_checkbox('have_tent', $row->have_tent, $row->have_tent, $data) ?>
							<label for="have_tent" id="somelabel" class="<?= $row->have_tent ? 'accepted' : '' ?>">Bring
								a tent? </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'have_sleeping_bag', 'class' => 'wb']; ?>
							<?= form_checkbox('have_sleeping_bag', $row->have_sleeping_bag, $row->have_sleeping_bag, $data) ?>
							<label for="have_sleeping_bag" id="somelabel"
							       class="<?= $row->have_sleeping_bag ? 'accepted' : '' ?>">Bring a sleeping
								bag </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'have_sleeping_pad', 'class' => 'wb']; ?>
							<?= form_checkbox('have_sleeping_pad', $row->have_sleeping_pad, $row->have_sleeping_pad, $data) ?>
							<label for="have_sleeping_pad" id="somelabel"
							       class="<?= $row->have_sleeping_pad ? 'accepted' : '' ?>">Bring a sleeping
								pad </label>
						</li>
					</fieldset>
					<h4>Dietary Preferences</h4>
					<fieldset>
						<p>Do you have any dietary preferences or restrictions?</p>
						<? $data = ['rows' => '10', 'id' => 'dietary_restrictions']; ?>
						<?= form_textarea5('dietary_restrictions', $row->dietary_restrictions, $data); ?>
					</fieldset>
					<fieldset>
						<p>What do you prefer in the morning?</p>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_coffee', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_coffee', $row->breakfast_coffee, $row->breakfast_coffee, $data) ?>
							<label for="breakfast_coffee" id="somelabel"
							       class="<?= $row->breakfast_coffee ? 'accepted' : '' ?>">Coffee </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_black_tea', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_black_tea', $row->breakfast_black_tea, $row->breakfast_black_tea, $data) ?>
							<label for="breakfast_black_tea" id="somelabel"
							       class="<?= $row->breakfast_black_tea ? 'accepted' : '' ?>">Black Tea </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_green_tea', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_green_tea', $row->breakfast_green_tea, $row->breakfast_green_tea, $data) ?>
							<label for="breakfast_green_tea" id="somelabel"
							       class="<?= $row->breakfast_green_tea ? 'accepted' : '' ?>">Green Tea </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_herb_tea', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_herb_tea', $row->breakfast_herb_tea, $row->breakfast_herb_tea, $data) ?>
							<label for="breakfast_herb_tea" id="somelabel"
							       class="<?= $row->breakfast_herb_tea ? 'accepted' : '' ?>">Herb Tea </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_hot_chocolate', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_hot_chocolate', $row->breakfast_hot_chocolate, $row->breakfast_hot_chocolate, $data) ?>
							<label for="breakfast_hot_chocolate" id="somelabel"
							       class="<?= $row->breakfast_hot_chocolate ? 'accepted' : '' ?>">Hot Chocolate</label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_other', 'class' => 'wb']; ?>
							<?= form_checkbox('breakfast_other', $row->breakfast_other, $row->breakfast_other, $data) ?>
							<label for="breakfast_other" id="somelabel"
							       class="<?= $row->breakfast_other ? 'accepted' : '' ?>">Other</label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'breakfast_other_text', 'class' => 'text']; ?>
							<label for="breakfast_other_text">Other Preference</label>
							<?= form_input('breakfast_other_text', $row->breakfast_other_text, $data) ?>
						</li>
					</fieldset>
				</div>


				<div id="right">
					<h4>Do you experience any of the following conditions?</h4>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'is_asthma', 'class' => 'wb']; ?>
							<?= form_checkbox('is_asthma', $row->is_asthma, $row->is_asthma, $data) ?>
							<label for="is_asthma" id="somelabel" class="<?= $row->is_asthma ? 'accepted' : '' ?>">Asthma/respiratory
								Illness </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_inhaler', 'class' => 'wb']; ?>
							<?= form_checkbox('is_inhaler', $row->is_inhaler, $row->is_inhaler, $data) ?>
							<label for="is_inhaler" id="somelabel" class="<?= $row->is_inhaler ? 'accepted' : '' ?>">If
								yes, do you carry an inhaler?</label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_diabetes', 'class' => 'wb']; ?>
							<?= form_checkbox('is_diabetes', $row->is_diabetes, $row->is_diabetes, $data) ?>
							<label for="is_diabetes" id="somelabel" class="<?= $row->is_diabetes ? 'accepted' : '' ?>">Diabetes </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_seizures', 'class' => 'wb']; ?>
							<?= form_checkbox('is_seizures', $row->is_seizures, $row->is_seizures, $data) ?>
							<label for="is_seizures" id="somelabel" class="<?= $row->is_seizures ? 'accepted' : '' ?>">Seizures/epilepsy </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_cardio_disease', 'class' => 'wb']; ?>
							<?= form_checkbox('is_cardio_disease', $row->is_cardio_disease, $row->is_cardio_disease, $data) ?>
							<label for="is_cardio_disease" id="somelabel"
							       class="<?= $row->is_cardio_disease ? 'accepted' : '' ?>">Cardiovascular
								disease </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_hypertension', 'class' => 'wb']; ?>
							<?= form_checkbox('is_hypertension', $row->is_hypertension, $row->is_hypertension, $data) ?>
							<label for="is_hypertension" id="somelabel"
							       class="<?= $row->is_hypertension ? 'accepted' : '' ?>">High blood pressure </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_knee_ankle_shoulder', 'class' => 'wb']; ?>
							<?= form_checkbox('is_knee_ankle_shoulder', $row->is_knee_ankle_shoulder, $row->is_knee_ankle_shoulder, $data) ?>
							<label for="is_knee_ankle_shoulder" id="somelabel"
							       class="<?= $row->is_knee_ankle_shoulder ? 'accepted' : '' ?>">Joint (hip, knee,
								ankle, shoulder etc.) or back injuries (including sprains)</label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_bleeding', 'class' => 'wb']; ?>
							<?= form_checkbox('is_bleeding', $row->is_bleeding, $row->is_bleeding, $data) ?>
							<label for="is_bleeding" id="somelabel" class="<?= $row->is_bleeding ? 'accepted' : '' ?>">Bleeding
								or blood disorders </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_dizziness', 'class' => 'wb']; ?>
							<?= form_checkbox('is_dizziness', $row->is_dizziness, $row->is_dizziness, $data) ?>
							<label for="is_dizziness" id="somelabel"
							       class="<?= $row->is_dizziness ? 'accepted' : '' ?>">Dizziness or fainting
								episodes </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_see_medical_specialist', 'class' => 'wb']; ?>
							<?= form_checkbox('is_see_medical_specialist', $row->is_see_medical_specialist, $row->is_see_medical_specialist, $data) ?>
							<label for="is_see_medical_specialist" id="somelabel"
							       class="<?= $row->is_see_medical_specialist ? 'accepted' : '' ?>">Do you see a
								medical/physical specialist of any kind</label>
						</li>
						<li>
							<? $data = ['id' => 'is_any_other_condition', 'class' => 'wb']; ?>
							<?= form_checkbox('is_any_other_condition', $row->is_any_other_condition, $row->is_any_other_condition, $data) ?>
							<label for="is_any_other_condition" id="somelabel"
							       class="<?= $row->is_any_other_condition ? 'accepted' : '' ?>">Any other condition
								that would affect your performance or health</label>
						</li>
					</fieldset>
					<fieldset>
						<li>
							<h4>Please explain any yes responses in the space below – including approximate dates and
								current status.</h4>
							<? $data = ['rows' => '10', 'id' => 'response_explainations']; ?>
							<?= form_textarea5('response_explainations', $row->response_explainations, $data); ?>
						</li>
					</fieldset>
					<h3>Allergies</h3>
					<h4>Are you allergic to any of the following?</h4>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'is_allergic_medications', 'class' => 'wb']; ?>
							<?= form_checkbox('is_allergic_medications', $row->is_allergic_medications, $row->is_allergic_medications, $data) ?>
							<label for="is_allergic_medications" id="somelabel"
							       class="<?= $row->is_allergic_medications ? 'accepted' : '' ?>">Medications </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_allergic_insect_stings', 'class' => 'wb']; ?>
							<?= form_checkbox('is_allergic_insect_stings', $row->is_allergic_insect_stings, $row->is_allergic_insect_stings, $data) ?>
							<label for="is_allergic_insect_stings" id="somelabel"
							       class="<?= $row->is_allergic_insect_stings ? 'accepted' : '' ?>">Insect stings (If
								yes, we strongly recommend that you carry medication.) </label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_allergic_food', 'class' => 'wb']; ?>
							<?= form_checkbox('is_allergic_food', $row->is_allergic_food, $row->is_allergic_food, $data) ?>
							<label for="is_allergic_food" id="somelabel"
							       class="<?= $row->is_allergic_food ? 'accepted' : '' ?>">Food allergies</label>
						</li>
						<li class="new_line">
							<? $data = ['id' => 'is_allergic_other', 'class' => 'wb']; ?>
							<?= form_checkbox('is_allergic_other', $row->is_allergic_other, $row->is_allergic_other, $data) ?>
							<label for="is_allergic_other" id="somelabel"
							       class="<?= $row->is_allergic_other ? 'accepted' : '' ?>">Other </label>
						</li>
					</fieldset>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'allergy_explainations', 'class' => 'text']; ?>
							<h4>
								Please explain any yes responses in the space below – including description of allergic
								response.
								<h4>
									<? $data = ['rows' => '10', 'id' => 'allergy_explainations']; ?>
									<?= form_textarea5('allergy_explainations', $row->allergy_explainations, $data); ?>
						</li>
					</fieldset>
					<h3>Medications</h3>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'is_medications', 'class' => 'wb']; ?>
							<?= form_checkbox('is_medications', $row->is_medications, $row->is_medications, $data) ?>
							<label for="is_medications" id="somelabel"
							       class="<?= $row->is_medications ? 'accepted' : '' ?>">Are you currently taking any
								medications? </label>
						</li>
					</fieldset>
					<fieldset>
						<li>
							<h4>If yes, please list medication, dosage, and condition for which you are taking the
								medication</h4>
							<? $data = ['rows' => '10', 'id' => 'medication_explainations']; ?>
							<?= form_textarea5('medication_explainations', $row->medication_explainations, $data); ?>
						</li>
					</fieldset>
					<fieldset>
						<li class="new_line">
							<? $data = ['id' => 'is_pregnant', 'class' => 'wb']; ?>
							<?= form_checkbox('is_pregnant', $row->is_pregnant, $row->is_pregnant, $data) ?>
							<label for="is_pregnant" id="somelabel" class="<?= $row->is_pregnant ? 'accepted' : '' ?>">Are
								you pregnant? </label>
						</li>

					</fieldset>
					</ul>

					<!-- Medical History End -->
				</div>
				<!--customer_data-->
				<li class="new_line">
					<? $data = ['id' => 'is_questionaire_viewed_by_admin', 'class' => 'wb']; ?>
					<?= form_checkbox('is_questionaire_viewed_by_admin', $row->is_questionaire_viewed_by_admin, $row->is_questionaire_viewed_by_admin, $data) ?>
					<label for="is_questionaire_viewed_by_admin" id="somelabel"
					       class="<?= $row->is_medications ? 'accepted' : '' ?>">I checked this questionaire! </label>
				</li>
				<ul>
					<li>
						<input type="submit" name="return" class="cancel buttons" value="Return"/>
					</li>
					</form>
				</ul>
			</div>
			<? endforeach; ?>
			<? endif; ?>

			<div class="clearfix"></div>
			<i class="note"></i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
	<? $this->load->view('modules/footer') ?>
	</body></html>