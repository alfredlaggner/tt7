<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/css/theme.default.css">
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.widgets.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$('table')
			.tablesorter({
				widgets: ['zebra'],
				headers: {
					// assign the secound column (we start counting zero) 
					0: {
						// disable it by setting the property sorter to false 
						sorter: false
					},
					// assign the third column (we start counting zero) 
					9: {
						// disable it by setting the property sorter to false 
						sorter: false
					}
				}
			});
		;

//	.tablesorterPager({container: $("#pager")}); 

		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');


	});

	/* Check all table rows */

	var checkflag = "false";
	function check(field) {
		if (checkflag == "false") {
			for (i = 0; i < field.length; i++) {
				field[i].checked = true;
			}
			checkflag = "true";
			return "check_all";
		}
		else {
			for (i = 0; i < field.length; i++) {
				field[i].checked = false;
			}
			checkflag = "false";
			return "check_none";
		}
	}
</script>

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
				<span> <?= $discount_count ?> Promo_codes</span>
				<p style="float:right" ;>
					<? echo anchor('discount/discount_create', 'Create New Discount') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Name</th>
							<th>Promo Code</th>
							<th>Amount</th>
							<th>Amount Type</th>
							<th>Expiration Date</th>
							<th>Active</th>
							<th>Single Use</th>
							<th>Discount Type</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<? if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?= $row->name; ?></td>
								<td><?= $row->promo_code; ?></td>
								<td><?= $row->amount; ?></td>
								<td>
									<? $data['amount_type'] = $row->amount_type;
									$this->load->view('modules/amount_type', $data) ?>
								</td>
								<td><?= $row->exp_date; ?></td>
								<td><?
									if ($row->is_rule_active) echo 'Yes'; else  echo 'No'; ?>
								</td>
								<td><?
									if ($row->is_single_use) echo 'Yes'; else  echo 'No'; ?>
								</td>
								<? if (isset($discount_types)) : foreach ($discount_types as $discount_type) : ?>
									<? if ($row->type == $discount_type->type) : ?>
										<td><?= $discount_type->name . ' - ' ?> <?= $discount_type->description; ?></td>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>
								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
								       title="Edit Discount"
								       href="<?= site_url() . 'discount/discount_view/' ?><?= $row->discount_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Assign Activities"
									   href="<?= site_url() . 'discount/assign_activities/' ?><?= $row->discount_id; ?>">
										<span class="ui-icon ui-icon-plus"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete Discount"
									   href="<?= site_url() . 'discount/discount_delete/' ?><?= $row->discount_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a>


								</td>
							</tr>
						<? endforeach; endif; ?>
						</tbody>
					</table>
				</form>
				<div class="clear"></div>
				<? $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<? $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
