<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#discount").validate({
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
<link href="<?= base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function () {
		$('#exp_date').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
		});
		$('#departure_date_start').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
		});
		$('#departure_date_end').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
		});
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?= anchor('discount', 'Discount Overview'); ?>
			> <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span>Discount: <?= $discount_plan_name ?></span></div>
			<div class="content-box">
				<div id="inputform">
					<? $attributes = array('id' => 'discount');
					echo form_open('discount/create', $attributes);
					echo form_hidden('res_party_size_from', '');
					echo form_hidden('res_party_size_to', '');
					echo form_hidden('departure_date_start', '');
					echo form_hidden('departure_date_end', '');
					echo form_hidden('auto_join_group', '');

					?>

					<ul>
						<li>
							<label>Name </label>
							<input type="text" name="name" id="name" class="required text"/>
						</li>
						<li>
							<label>Promo Code </label>
							<input type="text" name="promo_code" id="promo_code" class="text"/>
						</li>
						<li>
							<label>Description</label>
							<textarea name="description" id="description" class="text"/>
							</textarea>
						</li>
						<li>
							<label>Discount Rate </label>
							<input type="text" name="amount" id="amount" class="number required text"/>
						</li>
						<li>
							<label class="desc">Discount Type</label>
							<?
							//							$percent_off   = $row->amount_type == 'P';
							//							$fixed_off     = $row->amount_type == 'F';
							//							$reduced_price = $row->amount_type == 'R';
							$percent_off = TRUE;
							$fixed_off = FALSE;
							$reduced_price = FALSE;
							$fixed_price = FALSE;

							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'P',
								'checked' => $percent_off,
							);
							echo form_radio($data);
							?>
							Percent off
							<?
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'F',
								'checked' => $fixed_off,
							);

							echo form_radio($data);
							?>
							Fixed amount off
							<?
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'R',
								'checked' => $reduced_price,
							);

							echo form_radio($data);
							?>
							Reduced Amount
							<?
							$data = array(
								'name' => 'amount_type',
								'id' => 'amount_type',
								'value' => 'A',
								'checked' => $fixed_price,
							);

							echo form_radio($data);
							?>
							Fix Amount
						</li>
						<li>
							<label>Type</label>
							<select type="text" name="type" id="type" class="text" value=''/>

							<? if (isset($discount_types)) : foreach ($discount_types as $discount_type) : ?>
								<? if ($row->type == $discount_type->type) : ?>
									<option selected
									        value="<?= $discount_type->type; ?>"><?= $discount_type->name . ' - ' ?> <?= $discount_type->description; ?></option>
								<? else : ?>
									<option
										value="<?= $discount_type->type; ?>"><?= $discount_type->name . ' - ' ?> <?= $discount_type->description; ?></option>
								<? endif; ?>
							<? endforeach; ?>
							<? endif; ?>
							</select>
						</li>
						<label>Weekend Days</label>
						<? foreach ($weekdays as $day) :

							$data = array(
								'name' => $day['day_name'],
								'id' => $day['day_name'],
								'value' => '0',
								'checked' => $day['day_selected'],
							);
							echo form_checkbox($data);
							echo $day['day'] ?>
						<? endforeach; ?>
						</li>
						<!--												<li>
														<label>Automatically Apply? </label>
														<?= form_checkbox('is_automatic_apply', 'no', FALSE) ?> </li>
												</li>
												<li>
														<label>Reserved party size from</label>
														<input type="text" name="res_party_size_from" id="res_party_size_from"  class="text" />
												</li>
												<li>
														<label>Reserved party size to</label>
														<input type="text" name="res_party_size_to" id="res_party_size_to"  class="text" />
												</li>
-->
						<li>
							<label>Expiration Date </label>
							<input type="text" name="exp_date" id="exp_date" class="text"/>
						</li>
						<!--												<li>
														<label>Departure Date Start </label>
														<input type="text" name="departure_date_start" id="departure_date_start"  class="text" />
												</li>
												<li>
														<label>Departure Date End </label>
														<input type="text" name="departure_date_end" id="departure_date_end"  class="text" />
												</li>
												<li>
														<label>Auto Join Group </label>
														<input type="text" name="auto_join_group" id="auto_join_group"  class="text" />
												</li>
												<li>
														<label>Global Discount?</label>
														<?= form_checkbox('is_global_discount', 'no', FALSE) ?> </li>
												</li>
-->
						<li>
							<label>Rule Active?</label>
							<?= form_checkbox('is_rule_active', 'no', FALSE) ?> </li>
						</li>
						<li>
							<label>Single Use?</label>
							<?= form_checkbox('is_single_use', 'no', FALSE) ?> </li>
						</li>
						<!--single_use_change 12-14-2012-->
						<li>
							<label>Is Imported?</label>
							<?= form_checkbox('is_imported', 'no', FALSE) ?> </li>
						</li>
						<li>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</li>
					</ul>
					<?= form_close(); ?> </div>
			</div>
			<div class="clearfix"></div>
			<i class="note"></i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>