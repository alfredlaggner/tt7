<div class="hastable">
	<form name="myform" class="pager-form" method="post" action="">
		<table id="ledger_overview">
			<thead>
			<tr>
				<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
				           class="submit"/></th>
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
			<tbody>
			<?php if (isset($signups)) : foreach ($signups as $row) : ?>
				<? $email = !$row->email ? 'no_email' : $row->email; ?>
				<tr>
					<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
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
					<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip " title="View History"
					       href="<?php echo site_url() . 'customer_contact/customer_contact_overview/' ?><?php echo $row->customer_id; ?>//<?php echo str_replace('@', 'at', $email); ?>/<?= strpos($email, '@') == 0 ? 0 : strpos($email, '@') ?>">
							<span class="ui-icon ui-icon-folder-collapsed"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="See Class"
							href="<?php echo site_url() . 'customer_contact/customers_by_event/' . $row->event_id . '/' . $row->location_id ?>">
							<span class="ui-icon ui-icon-person"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all tooltip " title="Edit customer"
							href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
							<span class="ui-icon ui-icon-wrench"></span> </a></td>
				</tr>
			<?php endforeach; endif; ?>
			</tbody>
		</table>
		<p>&nbsp;</p>
	</form>
</div>
</div>
