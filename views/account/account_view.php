<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#account").validate(
			{
				rules: {
					cancel: "cancel",
					account_name: {
						required: true
					},
					account_short: {
						required: true
					},
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
					account_name: {
						required: "Please enter account name"
					},
					account_short: {
						required: "Please enter short account name"
					},
					first_name: {
						required: "Please enter first name"
					},
					last_name: {
						required: "Please enter last name"
					}
				}
			});
	});

	jQuery(function ($) {
		$("#created_on").mask("9999/99/99");
	});
</script>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function () {
		$('#created_on').datepicker({
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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('account', 'account'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Update account record ...</span></div>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<ul>
						<?php $attributes = array('id' => 'account'); ?>
						<?php echo form_open('account/update/' . $row->account_id, $attributes); ?>
						<li>
							<label>Account Name</label>
							<input type="text" name="account_name" id="account_name" class="text"
							       value='<?php echo $row->account_name ?>'/>
						</li>
						<li>
							<label>Short Name</label>
							<input type="text" name="account_short" id="account_short" class="text"
							       value='<?php echo $row->account_short ?>'/>
						</li>
						<li>
							<label>Account Created</label>
							<input type="text" name="created_on" id="created_on" class="text"
							       value='<?php echo $row->created_on ?>'/>
						</li>
						<li>
							<label>Type</label>
							<input type="text" name="type" id="type" class="text" value='<?php echo $row->type ?>'/>
						</li>
						<li>
							<label>Account Of</label>
							<select type="text" name="employee_id" id="employee_id" class="text"
							        value='<?php echo $row->employee_id ?>'/>
							<?php if (isset($employees)) : foreach ($employees as $employee) : ?>

								<?php if ($row->employee_id == $employee->employee_id) : ?>
									<option selected
									        value="<?php echo $employee->employee_id; ?>"><?php echo $employee->first_name . ' ' . $employee->last_name; ?></option>
								<?php else : ?>
									<option
										value="<?php echo $employee->employee_id; ?>"><?php echo $employee->first_name . ' ' . $employee->last_name; ?></option>
								<?php endif; ?>
							<?php endforeach; endif; ?>
							</select>

						</li>
						<li>
							<label>First Name</label>
							<input type="text" name="first_name" id="first_name" class="text"
							       value='<?php echo $row->first_name ?>'/>
						</li>
						<li>
							<label>Last Name</label>
							<input type="text" name="last_name" id="last_name" class="text"
							       value='<?php echo $row->last_name ?>'/>
						</li>
						<li>
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
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="submit" name="return" value="Save & Return" class="buttons"/>
							<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
						</li>
						<?php echo form_close(); ?>
					</ul>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
			pages.</i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>