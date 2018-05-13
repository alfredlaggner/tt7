<!--<style>
#inputform input.text {width: 190px;}
</style> 
-->
<?php $this->load->view('xajax/xajax'); ?>
<!--<script src="<?php echo base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->

<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.accordion.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/css/theme.default.css">
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.widgets.js"></script>
<link href="<?= base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$("xxxtable")
			.tablesorter({
				widgets: ['zebra'],
				sortList: [[1, 0]],
				headers: {
					// assign the secound column (we start counting zero)
					0: {
						// disable it by setting the property sorter to false
						sorter: false
					},
					// assign the secound column (we start counting zero)
					11: {
						// disable it by setting the property sorter to false
						sorter: false
					}
				}
			});
		;

		//.tablesorterPager({container: $("#pager")});

		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

		$(".date_sel").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
			//		minDate: 0
			maxDate: "+1Y"
		});

		$(".date_sel").mask("9999-99-99");

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
<link href="<?= base_url() ?>/css/ui/ui.accordion.css" rel="stylesheet" media="all"/>
<script type="text/javascript">
	$(function () {
		$("#accordion").accordion({});
	});
</script>
<div id="sub-nav">
	<div class="page-title">
		<h1>Dashboard</h1>
	</div>
	<? $this->load->view('modules/top_buttons') ?>
	<div id="page-layout">
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2 id="events_management"> Events Management </h2>
				</div>
				<div class="content-box">
					<div id="accordion">
						<h3><a href="#">Events by Activity</a></h3>
						<? $attributes = array('id' => 'dashboard'); ?>
						<?= form_open('dashboard/select_activity', $attributes); ?>
						<? $activity_id = $this->session->userdata('activity_id');
						$location_id = $this->session->userdata('location_id');
						$style_id = $this->session->userdata('style_id');
						$is_booked = $this->session->userdata('is_booked');
						$is_finished = $this->session->userdata('is_finished');
						$is_booked_style = $this->session->userdata('is_booked_style');
						?>
						<div id="inputform">
							<div>
								<ul>
									<li>
										<label>Event</label>
										<select type="text" name="activity_id" id="activity_id" class="text"
										        value='<?= $activity_id ?>'/>

										<option value="0"> All</option>
										<? if (isset($activities)) : foreach ($activities as $activity): ?>
											<? if ($activity_id == $activity->activity_id) : ?>
												<option selected class="text" value="<?= $activity->activity_id; ?>">
													<?= $activity->code . '  ' . $activity->name; ?>
												</option>
											<? else : ?>
												<option value="<?= $activity->activity_id; ?>">
													<?= $activity->code . '  ' . $activity->name; ?>
												</option>
											<? endif; ?>
										<? endforeach;endif; ?>
										</select>
									</li>
									<br/>
									<li>
										<label>Location</label>
										<select type="text" name="location_id" id="location_id" class="text"
										        value='<?= $location_id ?>'/>

										<option value="0"> All</option>
										<? if (isset($locations)) : foreach ($locations as $location): ?>
											<? if ($location_id == $location->location_id) : ?>
												<option selected value="<?= $location->location_id; ?>">
													<?= $location->code . '  ' . $location->name; ?>
												</option>
											<? else : ?>
												<option value="<?= $location->location_id; ?>">
													<?= $location->code . '  ' . $location->name; ?>
												</option>
											<? endif; ?>
										<? endforeach;endif; ?>
										</select>
									</li>
									<br/>
									<br/>
									<li>
										<label>Booked Events?</label>
										<?= form_checkbox('is_booked', $is_booked, $is_booked) ?>
									</li>
									<br/>
									<br/>
									<li>
										<label>Finished Events?</label>
										<?= form_checkbox('is_finished', $is_finished, $is_finished) ?>
									</li>
									<br/>
									<li>
										<input type="submit" name="activity_update" value="Calendar View"
										       class="buttons"/>
										<input type="submit" name="activity_update" value="List View" class="buttons"/>
									</li>
								</ul>
								<?= form_close(); ?>
							</div>
						</div>
						<h3><a href="#">Events by Activity Type</a></h3>
						<div>
							<?
							$location_id = $this->session->userdata('location_id');
							$style_id = $this->session->userdata('style_id');
							$is_booked = $this->session->userdata('is_booked');
							$is_finished = $this->session->userdata('is_finished');
							$is_booked_style = $this->session->userdata('is_booked_style'); ?>
							<div id="inputform">
								<? $attributes = array('id' => 'dashboard'); ?>
								<?= form_open('dashboard/select_style', $attributes); ?>
								<ul>
									<li>
										<label>Activity</label>
										<select type="text" name="style_id" id="style_id" class="text"
										        value='<?= $style_id ?>'/>

										<option value="0"> All</option>
										<? if (isset($styles)) : foreach ($styles as $style): ?>
											<? if ($style_id == $style->style_id) : ?>
												<option selected value="<?= $style->style_id; ?>">
													<?= $style->name; ?>
												</option>
											<? else : ?>
												<option value="<?= $style->style_id; ?>">
													<?= $style->name; ?>
												</option>
											<? endif; ?>
										<? endforeach;endif; ?>
										</select>
									</li>
									<br/>
									<br/>
									<label>Booked Events?</label>
									<li>
										<?= form_checkbox('is_booked', $is_booked, $is_booked) ?>
									</li>
									<br/>
									<br/>
									<li>
										<label>Finished Events?</label>
										<?= form_checkbox('is_finished', $is_finished, $is_finished) ?>
									</li>
									<br/>
									<br/>
									<li>
										<input type="submit" name="style_update" value="Calendar View" class="buttons"/>
										<input type="submit" name="style_update" value="List View" class="buttons"/>
									</li>
								</ul>
								<?= form_close(); ?>
							</div>
						</div>
					</div>
				</div>

				<!--</div>inputform-->
				<div class="clearfix"></div>
				<br/>
				<br/>
				<div class="inner-page-title"><a id="statistics"></a>
					<h2 id="ledger_statistics">Ledger Statistics</h2>
				</div>
				<style>
					#inputform input.text {
						border-radius: 5px;
						width: 190px;
						height: 25px;
					}
				</style>
				<?
				$activity_id = $this->session->userdata('activity_id');
				$location_id = $this->session->userdata('location_id');
				$region_id = $this->session->userdata('region_id');
				$event_date_from = $this->session->userdata('event_date_from');
				$event_date_to = $this->session->userdata('event_date_to');
				$booking_date_from = $this->session->userdata('booking_date_from');
				$booking_date_to = $this->session->userdata('booking_date_to');

				?>
				<div id="inputform">
					<? $attributes = ['id' => 'ledger_stats']; ?>
					<?= form_open( 'dashboard/exp_to_excel#statistics',$attributes); ?>
					<ul>
						<li>
							<label>Event</label>
							<select type="text" name="activity_id" id="activity_id" class="text"
							        value='<?= $activity_id ?>'/>

							<option value="0"> All</option>
							<? if (isset($activities)) : foreach ($activities as $activity): ?>
								<? if ($activity_id == $activity->activity_id) : ?>
									<option selected class="text" value="<?= $activity->activity_id; ?>">
										<?= $activity->code . '  ' . $activity->name; ?>
									</option>
								<? else : ?>
									<option value="<?= $activity->activity_id; ?>">
										<?= $activity->code . '  ' . $activity->name; ?>
									</option>
								<? endif; ?>
							<? endforeach;endif; ?>
							</select>
						</li>
						<li>
							<label>Location</label>
							<select type="text" name="location_id" id="location_id" class="text"
							        value='<?= $location_id ?>'/>

							<option value="0"> All</option>
							<? if (isset($locations)) : foreach ($locations as $location): ?>
								<? if ($location_id == $location->location_id) : ?>
									<option selected value="<?= $location->location_id; ?>">
										<?= $location->code . '  ' . $location->name; ?>
									</option>
								<? else : ?>
									<option value="<?= $location->location_id; ?>">
										<?= $location->code . '  ' . $location->name; ?>
									</option>
								<? endif; ?>
							<? endforeach;endif; ?>
							</select>
						</li>
						<li>
							<label>Region</label>
							<select type="text" name="region_id" id="region_id" class="text" value='<?= $region_id ?>'/>

							<option value="0"> All</option>
							<? if (isset($regions)) : foreach ($regions as $region): ?>
								<? if ($region_id == $region->region_id) : ?>
									<option selected value="<?= $region->region_id; ?>">
										<?= $region->region; ?>
									</option>
								<? else : ?>
									<option value="<?= $region->region_id; ?>">
										<?= $region->region; ?>
									</option>
								<? endif; ?>
							<? endforeach;endif; ?>
							</select>
						</li>
						<li>
						<li>
							<label>Events from to</label>
							<input type="text" name="event_date_from" id="event_date_from" class="date_sel text"
							       value="<?= $event_date_from ?>"/>
							<input type="text" name="event_date_to" id="event_date_to" class="date_sel text"
							       value="<?= $event_date_to ?> "/>
						</li>
						<label>Booked from to</label>
						<input type="text" name="booking_date_from" id="booking_date_from" class="date_sel text"
						       value="<?= $booking_date_from ?>"/>
						<input type="text" name="booking_date_to" id="booking_date_to" class="date_sel text"
						       value="<?= $booking_date_to ?>"/>
						</li>
						<li>
							<input type="submit" class="buttons" name="today" value="Go"
							       onclick="xajax_ledger_statistics (xajax.getFormValues( 'ledger_stats' )); return false;"/>
							<!--                                                      <input type="submit" class="buttons" name="screen_list" value="Go"   />
-->
							<input type="submit" class="buttons" name="email_list" value="Email List"/>
						</li>
					</ul>
					</form>
				</div>
				<div class="content-box">
					<div class="hastable">
						<!--<div id="ledger_result">-->
						<table id="ledger_overview">
							<form name="myform" class="pager-form" method="post" action="">
								<thead>
								<tr>
									<th><input type="checkbox" value="check_none"
									           onclick="this.value=check(this.form.list)" class="submit"/></th>
									<th>Event</th>
									<th>Activity</th>
									<th>Location</th>
									<th>Region</th>
									<th>Booked</th>
									<th>Customer</th>
									<th>Paid</th>
									<th>Discount Name</th>
									<th>Discount Code</th>
									<th>Discount</th>
									<th style="width:128px">Options</th>
								</tr>
								</thead>
								<tbody id="ledger_result">
								<?php if (isset($signups)) : foreach ($signups as $row) : ?>
									<? $email = !$row->email ? 'no_email' : $row->email; ?>
									<tr>
										<td class="center"><input type="checkbox" value="1" name="list"
										                          class="checkbox"/></td>
										<td><?php echo date('M d', strtotime($row->date)); ?></td>
										<td><?php echo $row->activity_code; ?></td>
										<td><?php echo $row->location_code; ?></td>
										<td><?php echo $row->region_name; ?></td>
										<td><?php echo date('M d H:i', strtotime($row->booking_date)) ?></td>
										<td><?php echo $row->last_name; ?></td>
										<td><?php
											if ($row->discount_amount_type == 'P')
												echo '$' . number_format($row->price - ($row->price / 100 * $row->discount), 2);
											else
												echo '$' . number_format($row->price - $row->discount, 2);
											?></td>
										<td><?php echo $row->discount_name; ?></td>
										<td><?php echo $row->promo_code; ?></td>
										<td><?
											if ($row->discount > 0.00) {
												if ($row->discount_amount_type == 'P')
													echo number_format($row->discount, 2) . '%';
												else
													echo '$' . number_format($row->discount, 2);
											}
											?></td>
										<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
										       title="View History"
										       href="<?php echo site_url() . 'customer_contact/customer_contact_overview/' ?><?php echo $row->customer_id; ?>//<?php echo str_replace('@', 'at', $email); ?>/<?= strpos($email, '@') == 0 ? 0 : strpos($email, '@') ?>">
												<span class="ui-icon ui-icon-folder-collapsed"></span> </a> <a
												class="btn_no_text btn ui-state-default ui-corner-all tooltip"
												title="See Class"
												href="<?php echo site_url() . 'customer_contact/customers_by_event/' . $row->event_id . '/' . $row->location_id ?>">
												<span class="ui-icon ui-icon-person"></span> </a> <a
												class="btn_no_text btn ui-state-default ui-corner-all tooltip "
												title="Edit customer"
												href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
												<span class="ui-icon ui-icon-wrench"></span> </a></td>
									</tr>
								<?php endforeach; endif; ?>
								</tbody>
						</table>
						</form>
					</div>
				</div>


				<!-- Edit Discount Code-->
				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<div class="inner-page-title"><a id="discount"></a>
					<h2 id="edit_discount_code">Edit Discount Code</h2>
				</div>
				<? $discount_code = $this->session->userdata('discount_code'); ?>
				<div id="inputform"> <?php echo validation_errors(); ?>
					<? $attributes = array('id' => 'ledger_stats'); ?>
					<?= form_open('dashboard/edit_discount#discount', $attributes); ?>
					<ul>
						<li>
							<label>Discount Code</label>
							<input type="text" name="discount_code" id="discount_code" class="text"
							       value="<?= $discount_code ?>"/>
						</li>
						<li>
							<input type="submit" class="buttons" name="edit" value="Edit"/>
							<input type="submit" class="buttons" name="assign" value="Assign to Acitivities"/>
						</li>
					</ul>
					</form>
				</div>

				<!-- End Edit Discount Code-->
				<div class="clearfix"></div>
				<? $this->load->view('modules/sidebar') ?>
				<div class="clear"></div>
				<? $this->load->view('modules/footer') ?>
			</div>
		</div>
	</div>
</div>
</body></html>