<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$("#sort-table1")
			.tablesorter({
				widgets: ['zebra'],
				headers: {
					// assign the secound column (we start counting zero) 
					5: {
						// disable it by setting the property sorter to false 
						sorter: false
					}
				}
			})

			.tablesorterPager({container: $("#pager1")});

		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

		$("#sort-table2")
			.tablesorter({
				widgets: ['zebra'],
				headers: {
					// assign the secound column (we start counting zero) 
					5: {
						// disable it by setting the property sorter to false 
						sorter: false
					}
				}
			})

			.tablesorterPager({container: $("#pager2")});

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
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
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
				<!--				<h2><?php echo $email ?></h2>
--> <span><?php echo $top_note ?></span></div>
			<? if (isset($records)) : ?>
				<div class="content-box " style="overflow:auto">
					<div class="left_column ">
						<? foreach ($records AS $row) : ?>
						<h3>Name:
							<?= $row->first_name ?>
							<?= $row->last_name ?>
						</h3>
						<p>Address: <b>
								<?= $row->address1 ?>
								<?= $row->address2 ? $row->address2 : '' ?>
							</b></p>
						<p>City: <b>
								<?= $row->city ?>
							</b></p>
						<p>Zip: <b>
								<?= $row->zip ?>
							</b></p>
						<p>State: <b>
								<?= $row->state ?>
								<?= $row->country ? '</b> Country: <b>' . $row->country : '' ?>
							</b></p>
					</div>
					<div class="left_column ">
						<p>email: <b>
								<?= $row->email ?>
							</b></p>
						<p>Phone: <b>
								<?= $row->email ?>
							</b></p>
						<p>Emergency Contact: <b>
								<?= $row->emergency_contact ?>
							</b></p>
						<p>Emergency Phone: <b>
								<?= $row->emergency_phone ?>
							</b></p>
						<? endforeach ?>
					</div>
				</div>
			<? endif ?>
			<div class="clear">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-2">History</a></li>
						<li><a href="#tabs-1">Notes</a></li>
						<li><a href="#tabs-3">Mail</a></li>
					</ul>
					<div id="tabs-1">
						<div class="hastable">
							<div class="content-box">
								<div class="inner-page-title">
									<p style="float:right" ;>
										<?php echo anchor('customer_contact/customer_contact_create/' . $customer_id, 'Add New Note ') ?>
									</p>
								</div>
								<form name="myform" class="pager-form" method="post" action="">
									<table id="xsort-table1">
										<thead>
										<tr>
											<th><input type="checkbox" value="check_none"
											           onclick="this.value=check(this.form.list)" class="submit"/></th>
											<th>Type</th>
											<th>Date/Time</th>
											<th>Note</th>
											<th>Next Contact</th>
											<th>Contact of</th>
											<th style="width:128px">Options</th>
										</tr>
										</thead>
										<tbody>
										<?php if (isset($contacts)) : foreach ($contacts as $row) : ?>
											<tr>
												<td class="center"><input type="checkbox" value="1" name="list"
												                          class="checkbox"/></td>
												<td><?php echo $row->entered_at; ?></td>
												<td><?php echo $row->name; ?></td>
												<td><?php echo $row->note; ?></td>
												<td><?php echo $row->next_contact; ?></td>
												<td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
												<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
												       title="Edit Contact"
												       href="<?php echo site_url() . 'customer_contact/customer_contact_view/' ?><?php echo $row->customer_contact_id; ?>/<?php echo $row->customer_contact_customer_id; ?>"><span
															class="ui-icon ui-icon-calendar"></span> </a>
													<!--											<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick" title="Delete Event" href="<?php echo site_url() . 'activity/delete/' ?><?php echo $row->customer_contact_id; ?>"> <span class="ui-icon ui-icon-trash"></span> </a>
--></td>
											</tr>
										<?php endforeach; endif; ?>
										</tbody>
									</table>
									<div id="xpager1">
										<?php //$this->load->view('modules/pager') ?>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="tabs-2">
						<div class="hastable">
							<div class="content-box">
								<form name="myform" class="pager-form" method="post" action="">
									<table id="xsort-table2">
										<thead>
										<tr>
											<th><input type="checkbox" value="check_none"
											           onclick="this.value=check(this.form.list)" class="submit"/></th>
											<th>Booked</th>
											<th>Activity</th>
											<th>Event Date</th>
											<th>Discount Code</th>
											<th>Amount Paid</th>
											<th>Paying Customer</th>
											<th>Status</th>
											<th style="width:128px">Options</th>
										</tr>
										</thead>
										<tbody>
										<?php if (isset($customer_history)) : foreach ($customer_history as $row) : ?>
											<tr>
												<td class="center"><input type="checkbox" value="1" name="list"
												                          class="checkbox"/></td>
												<td><?php echo date('M j h:m', strtotime($row->booking_date)) ?></td>
												<td><?php echo $row->name ?></td>
												<td><?php echo date('M j', strtotime($row->date)) ?></td>
												<td><?php echo $row->promo_code; ?></td>
												<td>
													<?php
													if ($row->discount_amount_type == 'P')
														echo '$' . number_format($row->price - ($row->price / 100 * $row->discount), 2);
													else
														echo '$' . number_format($row->price - $row->discount, 2);
													?>

												</td>
												<td><?php if ($row->main_customer) echo 'Yes'; else echo 'No'; ?></td>
												<td><?php echo $row->status == LEDGER_DELETED ? 'Removed' : '' ?></td>
												<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
												       title="Customer Info"
												       href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
														<span class="ui-icon ui-icon-wrench"></span> </a>

													<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
													   title="See Class"
													   href="<?php echo site_url() . 'customer_contact/customers_by_event/' . $row->event_id . '/' . $row->location_id ?>">
														<span class="ui-icon ui-icon-person"></span> </a>
												</td>
											</tr>
										<?php endforeach; endif; ?>
										</tbody>
									</table>
									<div id="xpager2">
										<?php //$this->load->view('modules/pager') ?>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="tabs-3">
						<div class="hastable">
							<div class="content-box">
								<form name="myform" class="pager-form" method="post" action="">
									<table id="xsort-table2">
										<thead>
										<tr>
											<th><input type="checkbox" value="check_none"
											           onclick="this.value=check(this.form.list)" class="submit"/></th>
											<th>Se/Re</th>
											<th>Date/Time</th>
											<th>Email</th>
											<th>Purpose</th>
											<th>Subject</th>
											<th style="width:128px">Options</th>
										</tr>
										</thead>
										<tbody>
										<?php
										//											print_r($email);
										if (isset($email)) : foreach ($email as $row) : ?>
											<tr>
												<td class="center"><input type="checkbox" value="1" name="list"
												                          class="checkbox"/></td>
												<td><?php echo $row->is_incoming ? "In" : "Out" ?></td>
												<td><?php echo date('M j h:m', strtotime($row->date_time)) ?></td>
												<td><?php echo $row->to ?></td>
												<td><?php echo $row->purpose ?></td>
												<td><?php echo $row->subject ?></td>
												<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
												       title="View Email"
												       href="<?php echo site_url() . 'customer_contact/customer_mail_view/' . $row->mail_id . '/' . $row->customer_id ?>">
														<span class="ui-icon ui-icon-wrench"></span> </a>

												</td>
											</tr>
										<?php endforeach; endif; ?>
										</tbody>
									</table>
									<div id="xpager2">
										<?php //$this->load->view('modules/pager') ?>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</div>
</body></html>