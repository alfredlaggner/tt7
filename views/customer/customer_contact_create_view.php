<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#date").validate({
			rules: {
				price: {
					number: true
				},
				price_weekend: {
					number: true
				},
				weekend_days: {
					number: true,
					minlength: 7
				}
			},
			messages: {
				price: {
					number: "Must be a number"
				},
				price_weekend: {
					number: "Must be a number"
				},
				weekend_days: {
					number: "Must be a number",
					minlength: "Must be 7 digits. One for each weekday. "
				}
			}
		});
	});

</script>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function () {
		$('#next_contact').datepicker({
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
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('customer/customer_contact_over_view/' . $customer_id, 'Customer Contact Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Contact for: <?php echo $customer_name ?></span></div>
			<div class="content-box">
				<div id="inputform">
					<?php $attributes = array('id' => 'event');
					echo form_open('customer_contact/create/' . $customer_id, $attributes); ?>

					<ul>
						<input type="hidden" name="customer_id" id="customer_id" value='<?php echo $customer_id ?>'/>
						<li>
							<label>entered_at </label>
							<input type="text" name="entered_at" id="entered_at" class="text" value='<?php
							echo $this->admin_model->date_time_zone(date(TIME_FORMAT)); ?>'/>
						</li>
						<li>
							<label>Type </label>
							<select type="text" name="type_id" id="type_id" class="text"/>
							<?php if (isset($types)) : foreach ($types as $type) : ?>
								<option
									value="<?php echo $type->customer_contact_type_id; ?>"><?php echo $type->name; ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
							</select>

						</li>
						<li>
							<label>Note</label>
							<textarea class="text_area" name="note" id="note" class="textarea"/> </textarea>
						</li>
						<li>
							<label>Next Contact</label>
							<input type="text" name="next_contact" id="next_contact" class="text" value=''/>
						</li>
						<li>
							<label>Contact Of</label>
							<select type="text" name="employee_id" id="employee_id" class="text" value=''/>
							<?php if (isset($employees)) : foreach ($employees as $employee) : ?>

								<option
									value="<?php echo $employee->employee_id; ?>"><?php echo $employee->first_name . ' ' . $employee->last_name; ?></option>
							<?php endforeach; endif; ?>
							</select>

						</li>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</li>
					</ul>
					<?php echo form_close(); ?> </div>
			</div>
			<div class="clearfix"></div>
			<i class="note"></i>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>