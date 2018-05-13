<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<!--<script src="<?php echo base_url() ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
-->
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
				<span>Book event for customer</span></div>
			<div id="inputform">
				<ul>
					<?php $attributes = array('id' => 'ledger', 'name' => 'ledger');
					echo form_open('ledger/create', $attributes); ?>
					<input type="hidden" name="activity_id" id="activity_id"
					       value='<?php echo $records['activity_id']; ?>'/>
					<input type="hidden" name="event_id" id="event_id" value='<?php echo $records['event_id']; ?>'/>
					<input type="hidden" name="booking_date" id="booking_date"
					       value='<?php echo date("Y-m-d H:i:s") ?>'/>

					<input type="hidden" name="from_calendar" id="from_calendar" value='<?php echo $from_calendar ?>'/>
					<li>
						<label>Activity</label>
						<input type="text" name="name" id="name" class="text" readonly="readonly"
						       value='<?php echo urldecode($records['name']); ?>'/>
					</li>
					<li>
						<label>Date</label>
						<input type="text" name="date" id="date" class="text" readonly
						       value='<?php echo $records['date']; ?>'/>
					</li>
					<li>
						<label>Time</label>
						<input type="text" name="time" id="time" class="text" readonly
						       value='<?php echo $records['time']; ?>'/>
					</li>
					<li>
						<label>Duration</label>
						<input type="text" name="duration" id="duration" class="text" readonly
						       value='<?php echo $records['duration']; ?>'/>
						(Hours)
					</li>
					<li>
						<label>Instructors</label>
						<input type="text" name="instructor" id="instructor" class="text" readonly
						       value='<?php echo urldecode($records['instructor']); ?>'/>
					</li>
					<li>
						<label>Rate</label>
						<input type="text" name="price" id="price" class="text" readonly
						       value='<?php echo $records['price']; ?>'/>
					</li>
					<li>
						<label>Discount</label>
						<input type="text" name="discount" id="discount" class="text" readonly
						       value='<?php echo $records['discount']; ?>'/>
					</li>
					<li>
						<label>Tax</label>
						<input type="text" name="tax" id="tax" class="text" readonly
						       value='<?php echo $records['tax']; ?>'/>
					</li>
					<li>
						<label>Max Participants</label>
						<input type="text" name="capacity" id="capacity" class="text" readonly
						       value='<?php echo $records['capacity']; ?>'/>
					</li>
					<li>
						<label>Available</label>
						<input type="text" name="available" id="available" class="text" readonly
						       value='<?php echo $records['available']; ?>'/>
					</li>
					<li> 
						<span id="int_attending">
							<label><b>Number attending</b></label>
							<input type="text" name="attending" id="attending" class="text" value='1'/>
							<span class="textfieldRequiredMsg">A value is required.</span> 
							<span class="textfieldInvalidFormatMsg">You must enter an integer value!</span> 
							<span class="textfieldMinValueMsg">The entered value is less than 1.</span> 
							<span class="textfieldMaxValueMsg">The entered value is greater than the maximum required (20).</span>
						</span>
					</li>
					<li>
						<label><b>Promotional Code</b></label>
						<input type="text" name="promo_code" id="promo_code" class="text" value=''/>
					</li>
					<li>
						<td><p><b>Enter attendants now:</b>

							<p></td>
						<td><input type="submit" name="book" value="Book" class="buttons"/>
							<input type="submit" name="reserve" value="Reserve" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/></td>
						<td><p><b>Enter attendants later:</b>

							<p></td>
						<td><input type="submit" name="book_later" value="Book" class="buttons"/>
							<input type="submit" name="reserve_later" value="Reserve" class="buttons"/></td>
					</li>
					<?php echo form_close(); ?>
				</ul>
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
<script type="text/javascript">

	<!--

	var ValidTF1 = new Spry.Widget.ValidationTextField("int_attending", "integer", {
		minValue: 1,
		maxValue: 20,
		useCharacterMasking: false,
		validateOn: ["blur", "change"]
	});

	//-->

</script>
</body>
</html>