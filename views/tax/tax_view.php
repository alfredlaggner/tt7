<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#tax").validate(
			{
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
						required: "Please enter a name",
						minlength: "Minimum length is 3"
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
				<span></div>
			<div class="content-box">
				<div id="inputform">
					<?php if (isset($records)) : foreach ($records as $row) : ?>
					<?php
					$attributes = array('id' => 'tax');
					echo form_open('tax/update_tax/' . $row->tax_id, $attributes) ?>
					<ul>
						<input type="hidden" name="tax_id" id="tax_id" class=" text"
						       value='<?php echo $row->tax_id; ?>'/>
						<li>
							<label>Name</label>
							<input type="text" name="name" id="name" class="required field text small" minlength="2"
							       value='<?php echo $row->name; ?>'/>
						</li>
						<li>
							<label>Order</label>
							<input type="text" name="order" id="order" class="field text small" minlength="1"
							       value='<?php echo $row->order; ?>'/>
						</li>
						<li>
							<label class="desc"> Authority</label>
							<input type="text" name="authority" id="authority" class="required text"
							       value='<?php echo $row->authority; ?>'/>
						</li>
						<li>
							<label class="desc">Calculated per</label>
							<?php
							$person_checked = $row->person_or_reservation == 'P';
							$group_checked = $row->person_or_reservation == 'R';
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
							<input type="text" name="amount" id="amount" class="number text"
							       value='<?php echo $row->amount; ?>'/>
						</li>
						<li>
							<label class="desc">Tax calculation as</label>
							<?php
							$percent_checked = $row->amount_type == 'P';
							$fixed_checked = $row->amount_type == 'G';
							$fixed_day_checked = $row->amount_type == 'D';
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
							<?php echo form_checkbox('is_exempt', $row->is_exempt, $row->is_exempt) ?> </li>
						<li>
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="submit" name="return" value="Save & Return" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="cancel buttons"/>
						</li>
					</ul>
					<?php echo form_close(); ?>
					</table>
				</div>
				<i class="note"></i>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>