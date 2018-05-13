<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

<?php $this->xajax->printJavascript(); ?>

<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>
-->

<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$("#sort-table")
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
			})

			.tablesorterPager({container: $("#pager")});

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
		<h1><?php echo $title ?></h1>
		<span><?php echo $breadcrumb ?><?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Selection: <?php echo $top_note ?></span>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Activity</th>
							<th>Location</th>
							<th>Available</th>
							<th>Date</th>
							<th>Time</th>
							<th>Rate</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Instructor</th>
							<th>Status</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 0;
						if (isset($records)) :
							foreach ($records as $row) : ?>
								<?
								$status = "";
								if ($row['is_deleted'])
									$status = "Invisible";
								else
									$status = "";
								?>

								<input type="hidden" name="activity_activity_id" id="activity_activity_id"
								       value=<?php echo $row['activity_activity_id']; ?>/>
								<tr>
									<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/>
									</td>
									<td><?php echo $row['activity_name']; ?></td>
									<td><?php echo $row['location_code']; ?></td>
									<td><?php echo $row['capacity'] - $this->ledger_model->attending($row['event_event_id']) . '/' . $row['capacity'] ?></td>
									<td><?php echo date('M-d-y', strtotime($row['event_date'])); ?></td>
									<td><?php echo date('G:i', strtotime($row['event_time'])) . ' - '; ?>
										<?php echo date('G:i', strtotime($row['event_time']) + $row['duration'] * 3600); ?></td>
									<td><?php echo $row['rate_price']; ?></td>
									<td><?php echo $row['rate_price'] - ($row['rate_price'] / 100 * $row['discount']); ?></td>
									<td><?php echo $row['discount']; ?></td>
									<td><?php
										$row['instructor'] = $this->event_to_employee_model->get_employee_string($row['event_event_id']);
										echo $row['instructor']; ?></td>
									<td id='status<?= $i ?>'><?php echo $status; ?></td>
									<td>
										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="See Class"
										   href="<?php echo site_url() . 'customer_contact/customers_by_event/' . $row['event_event_id'] . '/' . $row['location_id'] ?>">
											<span class="ui-icon ui-icon-person"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Change Event"
										   href="<?php echo site_url() . 'event/event_view/' . $row['event_event_id'] . '/' . $row['activity_activity_id'] . '/1' ?>">
											<span class="ui-icon ui-icon-calendar"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Assign Instructor"
										   href="<?php echo site_url() . 'event/assign_employees/' . $row['event_event_id'] . '/' . $row['activity_activity_id'] ?>">
											<span class="ui-icon ui-icon-script"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Make invisible"
										   onClick="xajax_delete_event(<?php echo $row['event_event_id'] ?>,<?php echo $i ?>);return false;"
										   href="#"> <span class="ui-icon ui-icon-trash"></span> </a>


									</td>
								</tr>
								<? $i++ ?>
							<?php endforeach; endif; ?>
						</tbody>
					</table>
					<div id="pager">

						<a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#">
							<span class="ui-icon ui-icon-arrowthickstop-1-w"></span>
						</a>
						<a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
							<span class="ui-icon ui-icon-circle-arrow-w"></span>
						</a>

						<input type="text" class="pagedisplay"/>
						<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#">
							<span class="ui-icon ui-icon-circle-arrow-e"></span>
						</a>
						<a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
							<span class="ui-icon ui-icon-arrowthickstop-1-e"></span>
						</a>
						<select class="pagesize">
							<option value="10" selected="selected">10 results</option>
							<option value="20">20 results</option>
							<option value="30">30 results</option>
							<option value="40">40 results</option>
						</select>
					</div>
				</form>
				<i class="note"></i></div>
			<div class="clear"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
</div>
</body></html>