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
				<h2><?php echo $title_action ?><?php echo urldecode($records['name']) ?></h2>
				<span>On <b><?php echo date('M-d-y', strtotime($records['date'])); ?></b> from  <b><?php echo date('G:i', strtotime($records['time'])); ?> </b> to 
								<b><?php echo date('G:i', strtotime($records['time']) + $records['duration'] * 3600); ?></b></span>
			</div>
			<p>
				Instructors: <b><?php echo $records['instructor'] ?> </b>&nbsp;
				Rate : <b><?php echo $records['price'] ?> </b>&nbsp;
			<p>
				Available: <b><?php echo $records['available'] ?> </b>&nbsp;
				Attending: <b><?php echo $records['attending'] ?> </b></p>

			<div id="inputform">
				<ul>
					<?php
					$attributes = array('id' => 'ledger', 'name' => 'ledger');
					echo form_open('ledger/create', $attributes); ?>
					<input type="hidden" name="activity_id" id="activity_id"
					       value='<?php echo $records['activity_id'] ?>'/>
					<input type="hidden" name="event_id" id="event_id" value='<?php echo $records['event_id'] ?>'/>
					<input type="hidden" name="booking_date" id="booking_date" value= <?php echo date(DATE_RFC822) ?>/>
					<input type="hidden" name="name" id="name" class="text" readonly="readonly" value=''/>
					<input type="hidden" name="date" id="date" class="text" readonly
					       value='<?php echo $records['date'] ?>'/>
					<input type="hidden" name="time" id="time" class="text" readonly
					       value='<?php echo $records['time'] ?>'/>
					<input type="hidden" name="duration" id="duration" class="text" readonly
					       value='<?php echo $records['duration'] ?>'/>
					<input type="hidden" name="instructor" id="instructor" class="text" readonly
					       value='<?php echo $records['instructor'] ?>'/>
					<input type="hidden" name="price" id="price" class="text" readonly
					       value='<?php echo $records['price'] ?>'/>
					<input type="hidden" name="discount" id="discount" class="text" readonly
					       value='<?php echo $records['discount'] ?>'/>
					<input type="hidden" name="tax" id="tax" class="text" readonly
					       value='<?php echo $records['tax'] ?>'/>
					<input type="hidden" name="available" id="available" class="text" readonly
					       value='<?php echo $available; ?>'/>
					<input type="hidden" name="attending" id="attending" class="text" readonly
					       value='<?php echo $records['attending']; ?>'/>
					<input type="hidden" name="promo_code" id="promo_code" class="text"
					       value='<?php echo $records['promo_code'] ?>'/>
					<!--						<td>
											<p>Enter attendants now: <p>
											</td>
											<td>
											<input type="submit" name="book" value="Book"  class="buttons" />
											<input type="submit" name="reserve" value="Reserve"  class="buttons" />
											<input type="submit" name="cancel" value="Cancel"  class="buttons" />
											
											</td>
											<td>
											<p>Enter attendants later: <p>
											</td>
											<td>
											<input type="submit" name="book_later" value="Book"  class="buttons" />
											<input type="submit" name="reserve_later" value="Reserve"  class="buttons" />
											</td>
										</li>
					--> <?php echo form_close(); ?>
				</ul>
			</div>
			<?php
			$attributes = array(
				'id' => 'add_taxes',
				'class' => "pager-form",
			);
			echo form_open('ledger/add_discount_to_activities/' . $discount->discount_id . '/' . $activity_count, $attributes)
			?>
			<input type="submit" name="cancel" value="Cancel"
			       class="ui-state-default float-right ui-corner-all ui-button"/>
			<input type="submit" name="return" value="Assign & Return"
			       class="ui-state-default float-right ui-corner-all ui-button"/>
			<input type="submit" name="assign" value="Assign"
			       class="ui-state-default float-right ui-corner-all ui-button"/>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onClick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Name</th>
							<th>Age</th>
							<th>Sex</th>
							<th>City</th>
							<th>State</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($attendants)) : foreach ($attendants as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo trim($row->first_name) . ' ' . $row->last_name; ?></td>
								<td><?php echo $this->customer_model->birthday($row->date_of_birth); ?></td>
								<td><?php echo $row->sex; ?></td>
								<td><?php echo $row->city; ?></td>
								<td><?php echo $row->state; ?></td>

								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
								       title="Edit customer"
								       href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
									   title="View Contacts"
									   href="<?php echo site_url() . 'customer_contact/customer_contact_overview/' ?><?php echo $row->customer_id; ?>">
										<span class="ui-icon ui-icon-mail-closed"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick "
									   title="Delete customer"
									   href="<?php echo site_url() . 'customer/delete/' ?><?php echo $row->customer_id; ?>">
										<span class="ui-icon ui-icon-trash"></span> </a>


								</td>
							</tr>
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
				<div class="clear"></div>
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