<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate the comment form when it is submitted
		$("#xrate").validate();

		// validate signup form on keyup and submit
		$("#rate").validate({
			rules: {
				name: {
					minlength: 3
				},
				order: {
					required: true,
					range: [1, 10]
				},
				status_dependent_text: {
					required: "#is_status_dependent:checked"
				}
			},
			messages: {
				order: {
					required: "Please enter a value between 1 and 10",
					range: "Order must be between 1 and 10"
				},
				name: {
					required: "Please enter a name",
					minlength: "Minimum length is 3"
				},
				status_dependent_text: {
					required: "Status dependent text is checked, enter text"
				}
			}
		});
//	$("#is_status_dependent").click(function() {
//	  $("#is_status_dependent").valid();});

	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate', 'Rate Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Rates for <?php echo $activity_name ?></span></div>
			<p style="float:right" ;>
				<?php echo anchor('rate/rate_price_create_view/' . $activity_id, 'Add Effective Date') ?>
			</p>
			<div class="clearfix"></div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Effective Date</th>
							<th>Wholesale Price</th>
							<th>Price</th>
							<th>Weekend Price</th>
							<th>Weekend Days</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($rate_prices)) : foreach ($rate_prices as $rate_price) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo $rate_price->effective_date; ?></td>
								<td><?php echo $rate_price->wholesale_price; ?></td>
								<td><?php echo $rate_price->price; ?></td>
								<td><?php echo $rate_price->price_weekend; ?></td>
								<td><?php
									$weekdays = array("Mo", "Tue", "We", "Th", "Fr", "Sa", "Su");
									$weekend = '';
									for ($i = 0; $i <= 6; $i++) {
										if (substr($rate_price->weekend_days, $i, 1) == '1')
											$weekend .= $weekdays[$i] . ' ';
									};
									echo $weekend;

									?></td>

								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
								       title="Edit Rate Price"
								       href="<?php echo site_url() . 'rate/rate_price_view/' . $rate_price->rate_price_id . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a> <a
										class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
										title="Delete Rate Price"
										href="<?php echo site_url() . 'rate/delete_rate_price/' . $rate_price->rate_price_id . '/' . $activity_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>

						<?php endforeach; ?>
						<?php else: ?>
							<?php echo 'No record found' ?>
						<?php endif; ?>
						</tbody>
					</table>
				</form>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>