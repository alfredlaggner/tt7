<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/tablesorter-pager.js"></script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<span><?= $breadcrumb ?><?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span>&nbsp;</span>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th>Name</th>
							<th>Promo Code</th>
							<th>Amount</th>
							<th>Amount Type</th>
							<th>Expiration Date</th>
							<th>Active</th>
							<th>Discount Type</th>
						</tr>
						</thead>
						<tbody>
						<? if (isset($records)) : foreach ($records as $discount) : ?>
							<tr>
								<td><?= $discount->name; ?></td>
								<td><?= $discount->promo_code; ?></td>
								<td><?= $discount->amount; ?></td>
								<td>
									<? $data['amount_type'] = $discount->amount_type;
									$this->load->view('modules/amount_type', $data) ?>
								</td>
								<td><?= $discount->exp_date; ?></td>
								<td><?
									if ($discount->is_rule_active) echo 'Yes'; else  echo 'No'; ?>
								</td>
								<? if (isset($discount_types)) : foreach ($discount_types as $discount_type) : ?>
									<? if ($discount->type == $discount_type->type) : ?>
										<td><?= $discount_type->name . ' - ' ?> <?= $discount_type->description; ?></td>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
							</tr>
						<? endforeach; endif; ?>
						</tbody>
					</table>
				</form>

				<div class="hastable">
					<?
					$attributes = array(
						'id' => 'add_taxes',
						'class' => "pager-form",
					);
					echo form_open('discount/add_discount_to_activities/' . $discount->discount_id . '/' . $activity_count, $attributes) ?>
					<input type="submit" name="<?= $cancel_name ?>" value="Cancel"
					       class="ui-state-default float-right ui-corner-all ui-button"/>
					<input type="submit" name="<?= $return_name ?>" value="Assign & Return"
					       class="ui-state-default float-right ui-corner-all ui-button"/>
					<input type="submit" name="assign" value="Assign"
					       class="ui-state-default float-right ui-corner-all ui-button"/>
					<table id="sort-table">
						<thead>
						<tr>
							<th>
								<input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
								       class="submit"/>
							</th>
							<th>Code</th>
							<th>Name</th>
							<th>Description</th>
							<th>Featured</th>
							<th>Active</th>
						</tr>
						</thead>
						<? $i = 0; ?>
						<? if (isset($activities)) : foreach ($activities as $activity) : ?>
						<? $i++; ?>
						<tbody>
						<tr>
							<input type="hidden" value="<?= $activity->activity_id; ?>" name="activity_id<?= $i ?>"
							       id="activity_id<?= $i ?>"/>

							<? if (isset($discount_activities)) {
								$checked = FALSE;
								foreach ($discount_activities as $dpr) {
									if ($dpr->discount_id == $discount_id AND $dpr->activity_id == $activity->activity_id)
										$checked = TRUE;
								}
							}
							?>
							<td class="center">
								<?= form_checkbox('activity_add' . $i, $checked, $checked) ?></td>
							<td><?= $activity->code; ?></td>
							<td><?= $activity->name; ?></td>
							<td><?= $activity->description_short; ?></td>
							<td><? if ($activity->is_featured) echo "Yes"; else echo "No"; ?></td>
							<td><? if ($activity->is_active) echo "Yes"; else echo "No"; ?></td>
						</tr>
						<? endforeach;
						endif; ?>
						</tbody>
					</table>
					</form>
					<i class="note"></i>
				</div>

				<div class="clear"></div>
				<? $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<? $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
