<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function () {
		$('#date_of_birth').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
			changeMonth: true,
			yearRange: '<?php echo DOB_FROM ?>:<?php echo DOB_TO ?>'
		});
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('customer', 'Customer'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Fill out all customer data </span></div>

			<div id="inputform">
				<?php
				$j = 1;
				$nr_attendants = 1;
				$nr_filled_out = 0;
				?>
				<?php if (isset($attendants)) : foreach ($attendants as $row) : ?>

					<ul>
						<?php $attributes = array('id' => 'attendant'); ?>
						<?php echo form_open('ledger/attendant_update/' . $row->customer_id . '/' . $ledger_id . '/' . $event_id); ?>
						<li>
							<p><b>Edit Attendant <?php echo $j++; ?></b>
						</li>

						<li>
							<label>First Name</label>
						<span id="edit_first_name">
						<input type="text" name="first_name" id="first_name" class="text required"
						       value='<?php echo $row->first_name ?>'/>
						<span class="textfieldRequiredMsg">First name is required.</span></span>
						<li>
							<label>Last Name</label>
						<span id="edit_last_name">
						<input type="text" name="last_name" id="last_name" class="text required"
						       value='<?php echo $row->last_name ?>'/>
						<span class="textfieldRequiredMsg">First name is required.</span></span>
						</li>
						<li>
							<label>DOB</label>
							<input type="text" name="date_of_birth" id="date_of_birth" class="text"
							       value='<?php echo $row->date_of_birth ?>'/>
						</li>
						<li>
							<label>Sex</label>
							<select name="sex" id="sex" class="text" maxlength="1" value='<?php echo $row->sex ?>'/>
							<?php if ($row->sex == 'M') : ?>
								<option value="F">Female</option>
								<option selected value="M">Male</option>
							<?php else : ?>
								<option selected value="F">Female</option>
								<option value="M">Male</option>
							<?php endif ?>
							</select>
						</li>
						<label>Address 1</label>
						<input type="text" name="address1" id="address1" class="text"
						       value='<?php echo $row->address1 ?>'/>
						</li>
						<li>
							<label>Address 2</label>
							<input type="text" name="address2" id="address2" class="text"
							       value='<?php echo $row->address2 ?>'/>
						</li>
						<li>
							<label>City</label>
							<input type="text" name="city" id="city" class="text" value='<?php echo $row->city ?>'/>
						</li>
						<li>
							<label>State</label>
							<select type="text" name="state" id="state" class="text" value='<?php echo $row->state ?>'/>

							<?php if (isset($states)) : foreach ($states as $state) : ?>
								<?php if ($row->state == $state) : ?>
									<option selected value="<?php echo $state ?>"><?php echo $state; ?></option>
								<?php else : ?>
									<option value="<?php echo $state ?>"><?php echo $state ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							</select>
						</li>

						<li>
							<label>Zip</label>
							<input type="text" name="zip" id="zip" class="text" value='<?php echo $row->zip ?>'/>
						</li>

						<li>
							<label>Country</label>
							<input type="text" name="country" id="country" class="text"
							       value='<?php echo $row->country ?>'/>
						</li>
						<li>
							<label>Email</label>
							<input type="text" name="email" id="email" class="text" value='<?php echo $row->email ?>'/>
						</li>
						<li>
							<label>Physical Condition</label>
							<input type="text" name="physical_condition_id" id="physical_condition_id" class="text"
							       value='<?php echo $row->physical_condition_id ?>'/>
						</li>
						<li>
							<label>Describe your health</label>
							<textarea name="health_self_description" id="health_self_description"
							          class="text_area"><?php echo $row->health_self_description ?></textarea>
						</li>
						<li>
							<label>Describe your adventure experience</label>
							<textarea name="experience_self_description" id="experience_self_description"
							          class="text_area"><?php echo $row->experience_self_description ?></textarea>
						</li>
						<li>
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="submit" name="return" value="Save & Return" class="buttons"/>
							<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
						</li>
						<?php echo form_close(); ?>
					</ul>
				<?php endforeach; ?>
				<?php endif; ?>

				<?php for ($i = 1; $i <= ($nr_attendants - $nr_filled_out); $i++) : ?>

					<ul>
						<?php $attributes = array('id' => 'customer'); ?>
						<?php echo form_open('ledger/attendant_create/' . $event_id . '/' . $nr_attendants, $attributes); ?>
						<input type="hidden" name="main_customer" id="main_customer"
						       value='<?php if ($j == 1) echo 1; else echo 0; ?>'/>
						<li>
							<p>Add Attendent <?php echo $j++; ?>
						</li>
						<li>
							<label>First Name</label>
						<span id="add_first_name">
						<input type="text" name="first_name" id="first_name" class="text" value=''/>
						<span class="textfieldRequiredMsg">First name is required.</span></span>
						</li>
						<li>
							<label>Last Name</label>
						<span id="add_last_name">
						<input type="text" name="last_name" id="last_name" class="text" value=''/>
						<span class="textfieldRequiredMsg">Last name is required.</span></span>
						</li>
						<li>
							<label>DOB</label>
						<span id="add_dob">
						<input type="text" name="date_of_birth" id="date_of_birth" class="text" value=''/>
					    <span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
						</li>
						<li>
						<li>
							<label>Sex </label>
							<select name="sex" id="sex" class="text" maxlength="1">
								<option value="F">Female</option>
								<option value="M">Male</option>
							</select>
						</li>
						<label>Address 1</label>
						<input type="text" name="address1" id="address1" class="text" value=''/>
						</li>
						<li>
							<label>Address 2</label>
							<input type="text" name="address2" id="address2" class="text" value=''/>
						</li>
						<li>
							<label>City</label>
							<input type="text" name="city" id="city" class="text" value=''/>
						</li>
						<li>
							<label>State</label>
							<select type="text" name="state" id="state" class="text" value=''/>

							<?php if (isset($states)) : foreach ($states as $state) : ?>
								<option value="<?php echo $state ?>"><?php echo $state ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
							</select>
						</li>

						<li>
							<label>Zip</label>
							<input type="text" name="state" id="state" class="text" value=''/>
						</li>

						<li>
							<label>Country</label>
							<input type="text" name="country" id="country" class="text"
							       value='United States of America'/>
						</li>
						<li>
							<label>Email</label>
							<input type="text" name="email" id="email" class="text" value=''/>
						</li>
						<li>
							<label>Physical Condition</label>
							<input type="text" name="physical_condition_id" id="physical_condition_id" class="text"
							       value=''/>
						</li>
						<li>
							<label>Describe your health</label>
							<textarea name="health_self_description" id="health_self_description"
							          class="text_area"></textarea>
						</li>
						<li>
							<label>Describe your adventure experience</label>
							<textarea name="experience_self_description" id="experience_self_description"
							          class="text_area"></textarea>
						</li>
						<li>
							<td>
								<input type="submit" name="add" value="Add" class="buttons"/>
								<input type="submit" name="cancel" value="Cancel" class="buttons"/>
							</td>
						</li>
						<?php echo form_close(); ?>
					</ul>
				<?php endfor; ?>
			</div>
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
<script type="text/javascript">
	//var add_first_name = new Spry.Widget.ValidationTextField("add_first_name", "none", {validateOn:["blur", "change"]});
	//var add_last_name = new Spry.Widget.ValidationTextField("add_last_name", "none", {validateOn:["blur", "change"]});
	var add_dob = new Spry.Widget.ValidationTextField("add_dob", "date", {
		format: "yyyy-mm-dd",
		hint: "yyyy-mm-dd",
		useCharacterMasking: true,
		isRequired: false,
		minValue: "0000-00-00"
	});

	//var edit_first_name = new Spry.Widget.ValidationTextField("edit_first_name", "none", {validateOn:["blur", "change"]});
	//var edit_last_name = new Spry.Widget.ValidationTextField("edit_last_name", "none", {validateOn:["blur", "change"]});
	var edit_dob = new Spry.Widget.ValidationTextField("edit_dob", "date", {
		format: "yyyy-mm-dd",
		hint: "yyyy-mm-dd",
		useCharacterMasking: true,
		isRequired: false,
		minValue: "0000-00-00"
	});
</script>
</body></html>