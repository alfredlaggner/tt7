<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<?php $this->xajax->printJavascript(); ?>
<!--
<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>
-->
<!--<script defer='defer' id='cjax_lib' type='text/javascript' src='cjax/core/js/cjax-5.0-Stable.min.js'></script>  
-->
<? $is_update = FALSE;
if (!$is_update) {
	$saved_origin = $this->session->set_userdata(array('back_url' => $_SERVER['HTTP_REFERER']));
//echo "xxxxx ".$this->session->userdata('back_url');	
}

?>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<? $this->load->view('modules/top_buttons') ?>
	</div>
	<div id="page-layout">
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
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
								<p> Activity: <b>
										<?= $row->activity_name ?>
									</b></p>
								<p>Code: <b>
										<?= $row->activity_code ?>
									</b></p>
								<p>Location: <b>
										<?= $row->location_name ?>
									</b></p>
								<p>Date: <b>
										<?= date('D, M j', strtotime($row->date)) . ' ' . date('g:i', strtotime($row->time)) ?>
									</b></p>
								<? endforeach ?>
							</div>
						</div>
					<? endif ?>
					<h2><?= $title_action ?></h2>
					<span>Update customer record ...</span></div>
				<div id="inputform">
					<?
					if (isset($records)) : foreach ($records as $row) : ?>
						<ul>
							<? $attributes = array('id' => 'reschedule'); ?>
							<?= form_open('ledger/reschedule_booking/' . $called_from, $attributes); ?>
							<input type="hidden" name="ledger_id" id="ledger_id" value='<?= $row->ledger_id ?>'/>
							<input type="hidden" name="activity_id" id="activity_id" value='<?= $row->activity_id ?>'/>
							<input type="hidden" name="customer_id" id="customer_id" value='<?= $row->customer_id ?>'/>
							<input type="hidden" name="location_id" id="location_id" value='<?= $row->location_id ?>'/>
							<input type="hidden" name="event_group_id" id="event_group_id"
							       value='<?= $row->event_group_id ?>'/>
							<input type="hidden" name="payment_id" id="payment_id" value='<?= $row->payment_id ?>'/>
							<input type="hidden" name="main_customer" id="main_customer"
							       value='<?= $row->main_customer ?>'/>
							<input type="hidden" name="attending" id="attending" value='<?= $row->attending ?>'/>
							<input type="hidden" name="status" id="status" value='<?= $row->status ?>'/>
							<input type="hidden" name="sales_code" id="sales_code" value='<?= $row->sales_code ?>'/>
							<input type="hidden" name="discount" id="discount" value='<?= $row->discount ?>'/>
							<input type="hidden" name="discount_amount_type" id="discount_amount_type"
							       value='<?= $row->discount_amount_type ?>'/>
							<input type="hidden" name="cms_type" id="cms_type" value='<?= $row->cms_type ?>'/>
							<input type="hidden" name="cms_amount" id="cms_amount" value='<?= $row->cms_amount ?>'/>
							<input type="hidden" name="promo_code" id="promo_code" value='<?= $row->promo_code ?>'/>
							<input type="hidden" name="tax" id="tax" value='<?= $row->tax ?>'/>
							<input type="hidden" name="paid_code" id="paid_code" value='<?= $row->paid_code ?>'/>
							<input type="hidden" name="price" id="price" value='<?= $row->price ?>'/>
							<input type="hidden" name="amount_paid" id="amount_paid" value='<?= $row->amount_paid ?>'/>
							<input type="hidden" name="cc_amount" id="cc_amount" value='<?= $row->cc_amount ?>'/>


							<li>
								<label>Select Location</label>
								<select
									onchange="xajax_getActivities(<?= $row->activity_id ?>,this.value );return false;"
									type="text" name="location_code" id="location_code" class="text"
									value='<?= $row->location_code ?>'/>
								<?

								if (isset($locations)) : foreach ($locations as $location) : ?>
									<? if ($row->location_id == $location->location_id) : ?>
										<option selected
										        value="<?= $location->location_id; ?>"><?= $location->name ?></option>
									<? else : ?>
										<option value="<?= $location->location_id; ?>"><?= $location->name ?></option>
									<? endif; ?>
								<? endforeach; ?>
								<? endif; ?>

								</select>
							<li>
							<li>
								<label>Select Event</label>
								<div id="activity_display">
									<select type="text" name="event_id" id="event_id" class="text"
									        value=" <?= $row->event_id ?>" />
						<? if (isset($events)) : foreach ($events as $event) : ?>
						<? if ($event['event_event_id'] == $row->event_id) : ?>
						<option selected value="<?= $event['event_event_id'] ?>
									"><?= date('D, M j', strtotime($event['event_date'])) . ' ' . date('g:i', strtotime($event['event_time'])) . ' ' . $event['attending'] . '/' . $event['capacity'] ?></option>
									<? else : ?>
										<option		value="<?= $event['event_event_id'] ?>"><?= date('D, M j', strtotime($event['event_date'])) . ' ' . date('g:i', strtotime($event['event_time'])) . ' ' . $event['attending'] . '/' . $event['capacity'] ?></option>
									<? endif; ?>
									<? endforeach; ?>
									<? endif; ?>
									</select>
								</div>
							</li>
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="button" class="cancel buttons" value="Return"
							       ONCLICK="window.location='<?= $this->session->userdata('back_url'); ?>'"/>
							</li>
							<?= form_close(); ?>
						</ul>
					<? endforeach; ?>
					<? endif; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
				pages.</i>
			<? $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
	<? $this->load->view('modules/footer') ?>
	</body></html>