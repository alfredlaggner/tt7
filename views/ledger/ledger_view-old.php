<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<body onLoad="document.ledger.attending.focus();">
<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('ledger', 'ledger'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>All booked or reserved transactions and states in between</span></div>
			<div id="inputform">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<ul>
						<?php
						$attending = $row->attending;
						$attributes = array('id' => 'ledger', 'name' => 'ledger');
						echo form_open('ledger/update/' . $row->ledger_id . '/' . $attending, $attributes); ?>
						<input type="hidden" name="activity_id" id="activity_id"
						       value='<?php echo $row->activity_id ?>'/>
						<input type="hidden" name="event_id" id="event_id" value='<?php echo $row->event_id ?>'/>
						<input type="hidden" name="booking_date" id="booking_date"
						       value= <?php echo $row->booking_date ?>/>
						<li>
							<label>Activity</label>
							<input type="text" name="name" id="name" class="text" readonly="readonly"
							       value='<?php echo $row->name ?>'/>
						</li>
						<li>
							<label>Date</label>
							<input type="text" name="date" id="date" class="text" readonly
							       value='<?php echo $row->date ?>'/>
						</li>
						<li>
							<label>Time</label>
							<input type="text" name="time" id="time" class="text" readonly
							       value='<?php echo $row->time ?>'/>
						</li>
						<li>
							<label>Duration</label>
							<input type="text" name="duration" id="duration" class="text" readonly
							       value='<?php echo $row->duration ?>'/>
						</li>
						<li>
							<label>Instructors</label>
							<input type="text" name="instructor" id="instructor" class="text" readonly
							       value='<?php echo $row->instructor ?>'/>
						</li>
						<li>
							<label>Rate</label>
							<input type="text" name="price" id="price" class="text" readonly
							       value='<?php echo $row->price ?>'/>
						</li>
						<li>
							<label>Discount</label>
							<input type="text" name="discount" id="discount" class="text" readonly
							       value='<?php echo $row->discount ?>'/>
						</li>
						<li>
							<label>Tax</label>
							<input type="text" name="tax" id="tax" class="text" readonly
							       value='<?php echo $row->tax ?>'/>
						</li>
						<li>
							<label>Available</label>
							<input type="text" name="available" id="available" class="text" readonly
							       value='<?php echo $available; ?>'/>
						</li>
						<li>
							<label><b>Number attending</b></label>
							<input type="text" name="attending" id="attending" class="text"
							       value='<?php echo $row->attending ?>'/>
						</li>
						<li>
							<label><b>Promotional Code</b></label>
							<input type="text" name="promo_code" id="promo_code" class="text"
							       value='<?php echo $row->promo_code ?>'/>
						</li>
						<li>
							<td>
								<p>Enter attendants now:
								<p>
							</td>
							<td>
								<input type="submit" name="book" value="Book" class="buttons"/>
								<input type="submit" name="reserve" value="Reserve" class="buttons"/>
								<input type="submit" name="cancel" value="Cancel" class="buttons"/>

							</td>
							<td>
								<p>Enter attendants later:
								<p>
							</td>
							<td>
								<input type="submit" name="book_later" value="Book" class="buttons"/>
								<input type="submit" name="reserve_later" value="Reserve" class="buttons"/>
							</td>
						</li>
						<?php echo form_close(); ?>
					</ul>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
			pages.</i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>