<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#health_history").validationEngine('attach',
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
				<? for ($i = 1; $i <= $nr_of_students; $i++) : ?>
					<script>
						jQuery(function ($) {
							$("#cell<?= $i ?>").mask("(999) 999-9999");
							$("#emergency_phone<?= $i ?>").mask("(999) 999-9999");
						});
					</script>
					<div id="customer_data">
						<div class="clr"></div>
						<? if ($i == 1) : ?>
							<h2><span>Medical History </span>
							<? if ($nr_of_students > 1) : ?>
								Medical History</h2>
							<? else : ?>
								</h2>
							<? endif ?>
						<? else : ?>
							<hr/>
							<h2><span>Medical History</span>
								<? if ($error) echo "Something went wrong : " . $error; ?>
								<?= $i ?>
							</h2>
						<? endif ?>
						<? $attributes = array('id' => 'health_history', 'name' => 'health_history');

						echo form_open('tt_v1/create_booking', $attributes); ?>
						<fieldset>
							<? $data = array('class' => 'text'); ?>

							<div style="float:left">
								<label>Date of Birth</label>
								<?= form_input('dob' . $i, $data) ?>
							</div>
							<div style="float:left">
								<label>Height (inches)</label>
								<?= form_input('height' . $i, $data) ?>
							</div>
							<div style="float:left">
								<label>Weight (pounds) </label>
								<?= form_input('dob' . $i, $data) ?>
							</div>
							<div style="float:left">
								<label>Gender </label>
								<?= form_dropdown('gender', $gender, $data) ?>
							</div>
						</fieldset>
						<fieldset>
							<div style="float:left">
								<label>Asthma/ Respiratory Illness </label>
								<?= form_checkbox('is_asthma' . $i, 'no', FALSE) ?>
							</div>
							<div>
								<label>If yes, do you carry an inhaler?</label>
								<?= form_checkbox('is_inhaler' . $i, 'no', FALSE) ?>
							</div>
							<div style="float:left">
								<label>Diabetes </label>
								<?= form_checkbox('is_diabetes' . $i, 'no', FALSE) ?>
							</div>
							<div>
								<label>Seizures/Epilepsy </label>
								<?= form_checkbox('is_seizures' . $i, 'no', FALSE) ?>
							</div>
						</fieldset>
						<fieldset>
							<div style="float:left">
								<label>Cardiovascular Disease </label>
								<?= form_checkbox('is_cardio_disease' . $i, 'no', FALSE) ?>
							</div>
							<div>
								<label>Hypertension/High blood pressure </label>
								<?= form_checkbox('is_hypertension' . $i, 'no', FALSE) ?>
							</div>
						</fieldset>
					</div>
					<!--left area-->
					<div id="right"> <!--inside the input area-->
						<!--            <fieldset>
				-->
						<div style="float:left">
							<label>Joint (hip knee ankle shoulder etc.) or back injuries (including sprains)</label>
							<?= form_checkbox('is_knee_ankle_shoulder' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>Bleeding or blood disorders </label>
							<?= form_checkbox('is_bleeding' . $i, 'no', FALSE) ?>
						</div>
						<!--            </fieldset>
				-->
						<fieldset>
							<div>
								<label>Dizziness or fainting episodes </label>
								<?= form_checkbox('is_dizziness' . $i, 'no', FALSE) ?>
							</div>
							<div>
								<label>Do you see a Medical/Physical Specialist of any kind</label>
								<?= form_checkbox('is_see_medical_specialist' . $i, 'no', FALSE) ?>
							</div>
							<div>
								<label>Any other condition that would affect your performance or health in the
									backcountry </label>
								<?= form_checkbox('is_any_other_condition' . $i, 'no', FALSE) ?>
							</div>
							<div
							<label>Please explain any yes responses in the space below – including approximate dates and
								current status.</label>

							<?= form_textarea('history_explainations', ''); ?>
					</div>
					<div>
						<label>Are you pregnant? </label>
						<?= form_checkbox('is_pregnant' . $i, 'no', FALSE) ?>
					</div>

					</fieldset>
					<h3>Allergies<span>(are you allergic to any of the following?)</span></h3>
					<fieldset>
						<div>
							<label>Medications </label>
							<?= form_checkbox('is_allergic_medications' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>Insect stings (If yes, we strongly recommend that you carry medication.) </label>
							<?= form_checkbox('is_allergic_insect_stings' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>Food allergies</label>
							<?= form_checkbox('is_allergic_food' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>Other </label>
							<?= form_checkbox('is_allergic_other' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>Please explain any yes responses in the space below – including description of
								allergic response.</label>
							<?= form_textarea('allergy_explainations', ''); ?>
						</div>
					</fieldset>

					<h3>Medications</h3>
					<fieldset>
						<div>
							<label>Are you currently taking any medications? </label>
							<?= form_checkbox('is_medications' . $i, 'no', FALSE) ?>
						</div>
						<div>
							<label>If yes, please list medication, dosage, and condition for which you are taking the
								medication:</label>
							<?= form_textarea('medication_explainations', ''); ?>
						</div>
					</fieldset>


				<? endfor ?>
				<div id="customer_data">
					<input type="submit" value="CONTINUE" class="submit"/>
				</div>
				</form>
			</div>
		</div>

		<div class="sg-35 line"></div>
		<? $this->load->view('tt_v1/blocks/footer'); ?>

</body>
</html>