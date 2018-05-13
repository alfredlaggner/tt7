<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<!--<script type="text/javascript" src="<?= base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/tablesorter-pager.js"></script>
-->
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/css/theme.default.css">
<link rel="stylesheet" href="<?php echo base_url() ?>tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>tablesorter/js/jquery.tablesorter.widgets.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$('table')
			.tablesorter({
				widgets: ['zebra'],
				headers: {
					// assign the secound column (we start counting zero) 
					0: {
						// disable it by setting the property sorter to false 
						sorter: false
					},
					// assign the third column (we start counting zero) 
					8: {
						// disable it by setting the property sorter to false 
						sorter: false
					}
				}
			});
		;

//	.tablesorterPager({container: $("#pager")}); 

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
		<h1><?= $title ?></h1>
		<span><?= $breadcrumb ?><?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span><?= $top_note ?></span>
				<p style="float:right" ;>
					<?= anchor('activity/activity_create', 'Create New Activity') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Id</th>
							<!--																<th>Account</th>
							-->
							<th>Code</th>
							<th>Order</th>
							<th>Name</th>
							<th>Featured</th>
							<th>Active</th>
							<th>Medical History</th>
							<th style="width:200px">Options</th>
						</tr>
						</thead>
						<tbody>
						<? $region = '0';
						if (isset($regions)) : foreach ($regions as $region) : ?>
							<? $region = $region->region; ?>
						<? endforeach;endif; ?>

						<? if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?= $row->activity_id; ?></td>
								<!--																<td><?= $row->account_name; ?></td>
-->
								<td><?= $row->code; ?></td>
								<td><?= $row->order; ?></td>
								<td><?= $row->name; ?></td>
								<td><? if ($row->is_featured) echo "Yes"; else echo "No"; ?></td>
								<td><? if ($row->is_active) echo "Yes"; else echo "No"; ?></td>
								<td><? if ($row->is_questionaire) echo "Yes"; else echo "No"; ?></td>
								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
								       title="Edit Activity"
								       href="<?= site_url() . 'activity/activity_view/' ?><?= $row->activity_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Event Dates"
									   href="<?= site_url() . 'event/index/' ?><?= $row->activity_id; ?>"> <span
											class="ui-icon ui-icon-calendar"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Event Rates"
									   href="<?= site_url() . 'activity_rate/index/' ?><?= $row->activity_id; ?>"> <span
											class="ui-icon ui-icon-arrowreturnthick-1-n"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Pictures"
									   href="<?= site_url() . 'activity_pictures/index/0/' ?><?= $row->activity_id . '/' . $row->code ?>">
										<span class="ui-icon ui-icon-image"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Related Activities"
									   href="<?= site_url() . 'activity_related/index/' ?><?= $row->activity_id ?>">
										<span class="ui-icon ui-icon-link"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Assign Regions"
									   href="<?= site_url() . 'activity/assign_regions/' ?><?= $row->activity_id ?>">
										<span class="ui-icon ui-icon-link"></span> </a>


									<!--																<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick" title="Delete Activity" href="<?= site_url() . 'activity/delete/' ?><?= $row->activity_id; ?>"> <span class="ui-icon ui-icon-trash"></span> </a>
-->                                                                </td>
							</tr>
						<? endforeach; endif; ?>
						</tbody>
					</table>
					<!--										<div id="pager"> <a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-w"></span> </a> <a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#"> <span class="ui-icon ui-icon-circle-arrow-w"></span> </a>
																	<input type="text" class="pagedisplay"/>
																	<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#"> <span class="ui-icon ui-icon-circle-arrow-e"></span> </a> 
																	
																	<a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-e"></span> </a>
																	<select class=" text pagesize" >
																			<option value="10" selected="selected">10 results</option>
																			<option value="20">20 results</option>
																			<option value="30">30 results</option>
																			<option value="40">40 results</option>
																	</select>
														</div>-->
				</form>
				<br/>
				<br/>
				<br/>
				<br/>
				<i class="note"><?= $bottom_note ?></i></div>
			<div class="clear"></div>
			<? $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<? $this->load->view('modules/footer') ?>
</div>
</body></html>