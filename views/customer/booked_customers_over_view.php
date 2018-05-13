<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
<script type="text/javascript">
	$(function () {
		$("#sort-table").tablesorter({
			theme: 'blue',

			sortList: [[1, 0]],

			// initialize zebra striping and column styling of the table 
			widgets: ["zebra"],
			headers: {
				0: {sorter: false},
				5: {sorter: false}
			}
		});
	});
	//$(document).ready(function() {
	//	/* Table Sorter */
	//
	//	$("#sort-table")
	//	.tablesorter({
	//		widgets: ['zebra'],
	//		headers: { 
	//		            // assign the secound column (we start counting zero) 
	//		           0: { 
	//		                // disable it by setting the property sorter to false 
	//		                sorter: false 
	//		            },
	//		            // assign the secound column (we start counting zero) 
	//		           6: { 
	//		                // disable it by setting the property sorter to false 
	//		                sorter: false 
	//		            } 
	//		        } 
	//	})
	//	
	//	.tablesorterPager({container: $("#pager")}); 
	//
	//	$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
	//
	//	
	//});
	//
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
		<h1><?php echo $title ?></h1>
		<span><?php echo $breadcrumb ?><?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>&nbsp;</span>
				<? if (isset($events)) : ?>
					<div class="content-box">
						<? foreach ($events AS $event) : ?>

							<h3><?= $event->name; ?></h3>
							Location: <b> <?= $event->location_name ?></b>
							Code: <b>  <?= $event->code ?></b>
							Date:  <b> <?= $event->date ?></b>
							Time: <b> <?= $event->time ?></b>
							<? $instructors = $this->event_to_employee_model->get_employee_string($event->event_id); ?>
							Instructors: <b> <?= $instructors ?></b>

						<? endforeach ?>
					</div>
				<? endif ?>
				<!--						<p style="float:right";>
				<?php echo anchor('customer/customer_create', 'Add New Customer') ?>
			</p>
--> </div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Name</th>
							<th>email</th>
							<th>Age</th>
							<th>Sex</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $row) : ?>
							<? $email = !$row->email ? 'no_email' : $row->email; ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo trim($row->first_name) . ' ' . $row->last_name; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $this->customer_model->birthday($row->date_of_birth); ?></td>
								<td><?php if ($row->sex == 1) echo 'Male'; else echo 'Female'; ?></td>


								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
								       title="View History"
								       href="<?php echo site_url() . 'customer_contact/customer_contact_overview/' ?><?php echo $row->customer_id; ?>/<?php echo str_replace('@', 'at', $email); ?>/<?= strpos($email, '@') == 0 ? 0 : strpos($email, '@') ?>">
										<span class="ui-icon ui-icon-folder-collapsed"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
									   title="Edit customer info"
									   href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>
									<? if (isset($event_id)) : ?>
										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick "
										   title="Delete Customer"
										   href="<?php echo site_url() . 'customer_contact/delete/' ?><?php echo $row->customer_id; ?>/<?php echo $event_id; ?>/<?php echo $location_id; ?>/<?php echo $row->status; ?>">
											<span class="ui-icon ui-icon-trash"></span> </a>
									<? endif ?>

								</td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>
					</table>
					<div id="pager">
						<?php $this->load->view('modules/pager') ?>
					</div>
				</form>
			</div>
			<div class="clear"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
</div>
</body>
</html>
