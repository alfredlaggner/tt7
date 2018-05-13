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
				<span>Enter customer information</span></div>
			<div id="inputform">
				<ul>
					<?php echo form_open('customer/create'); ?>
					<?php $attributes = array('id' => 'customer'); ?>
					<?php echo form_open('customer/create', $attributes); ?>
					<li>
						<label>First Name</label>
						<input type="text" name="first_name" id="first_name" class="text" value=''/>
					</li>
					<li>
						<label>Last Name</label>
						<input type="text" name="last_name" id="last_name" class="text" value=''/>
					</li>
					<li>
						<label>DOB</label>
						<input type="text" name="date_of_birth" id="date_of_birth" class="text date" value=''/>
					</li>
					<li>
					<li>
						<label>Sex</label>
						<input type="text" name="sex" id="sex" class="text required" maxlength="1" value=''/>
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
						<input type="text" name="country" id="country" class="text" value='United States of America'/>
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
							<input type="submit" name="Cancel" value="Cancel" class="buttons cancel"/>
						</td>
					</li>
					<?php echo form_close(); ?>
				</ul>
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
</body></html>