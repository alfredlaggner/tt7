<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate the comment form when it is submitted
		$("#xtax").validate();

		// validate signup form on keyup and submit
		$("#tax").validate({
			rules: {
				name: {
					minlength: 3
				},
				order: {
					required: true,
					range: [1, 10]
				},
				status_dependent_text: {
					required: "#is_status_dependent:checked"
				}
			},
			messages: {
				order: {
					required: "Please enter a value between 1 and 10",
					range: "Order must be between 1 and 10"
				},
				name: {
					required: "Please enter a name for this tax",
					range: "Minimum length is 3"
				},
				status_dependent_text: {
					required: "Status dependent text is checked, enter text"
				}
			}
		});
//	$("#is_status_dependent").click(function() {
//	  $("#is_status_dependent").valid();});

	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('tax', 'Tax Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<?php if (isset($tax_plans)) : foreach ($tax_plans as $tax_plan) : ?>
					<span>Tax Plan: <?php echo $tax_plan->name ?></span>
				<?php endforeach ?>
				<?php endif ?>
			</div>
			<div class="content-box">
				<div id="inputform">
					<ul>
						<?php $attributes = array('id' => 'tax');
						echo form_open('tax/add_tax', $attributes) ?>
						<input type="hidden" name="tax_plan_id" id="tax_plan_id" class="text"
						       value='<?php echo $tax_plan_id ?>'/>
						<li>
							<label>Name</label>
							<input type="text" name="name" id="name" class="required field text small" minlength="2"/>
						</li>
						<li>
							<label>Order</label>
							<input type="text" name="order" id="order" class="field text small" minlength="1"/>
						</li>
						<li>
							<label class="desc"> Authority</label>
							<input type="text" name="authority" id="authority" class="required text"/>
						</li>

						<li>
							<label class="desc">Calculated per</label>
							<?php
							$person_checked = TRUE;
							$group_checked = FALSE;
							$data = array(
								'name' => 'person_or_reservation',
								'id' => 'person_or_reservation',
								'value' => 'P',
								'checked' => $person_checked,
							);
							echo form_radio($data);
							?> Person
							<?php
							$data = array(
								'name' => 'person_or_reservation',
								'id' => 'person_or_reservation',
								'value' => 'R',
								'checked' => $group_checked,
							);

							echo form_radio($data);
							?> Reservation
						</li>
						<li>
							<label class="desc">Amount</label>
							<input type="text" name="amount" id="amount" class="number text"/>
						</li>
						<li>
							<label class="desc">Tax calculation as</label>
							<?php
							$percent_checked = TRUE;
							$fixed_checked = FALSE;
							$fixed_day_checked = FALSE;
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'P',
								'checked' => $percent_checked,
							);
							echo form_radio($data);
							?> percentage
							<?php
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'G',
								'checked' => $fixed_checked,
							);

							echo form_radio($data);
							?> fixed amount
							<?php
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'D',
								'checked' => $fixed_day_checked,
							);

							echo form_radio($data);
							?> fixed amount per day
						</li>
						<li>
							<label class="desc">Exempt</label>
							<?php echo form_checkbox('is_exempt', 'no', FALSE) ?> </li>
						</li>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</li>
						<?php echo form_close(); ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout
					Options pages.</i>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
	</body>
	</html>
