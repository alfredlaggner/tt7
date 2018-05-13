<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
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
					// assign the secound column (we start counting zero) 
					8: {
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
				<span>&nbsp;</span>
				<p style="float:right" ;>
					<?php echo anchor('account/account_create', 'Add New Account') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Account</th>
							<th>Short</th>
							<th>Name</th>
							<th>Since</th>
							<th>Years</th>
							<th>City</th>
							<th>State</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo $row->account_name; ?></td>
								<td><?php echo $row->account_short; ?></td>
								<td><?php echo trim($row->first_name) . ' ' . $row->last_name; ?></td>
								<td><?php echo $row->created_on; ?></td>
								<td><?php echo $this->account_model->birthday($row->created_on); ?></td>
								<td><?php echo $row->city; ?></td>
								<td><?php echo $row->state; ?></td>

								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
								       title="Edit Account"
								       href="<?php echo site_url() . 'account/account_view/' ?><?php echo $row->account_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
									   title="View Contacts"
									   href="<?php echo site_url() . 'account_contact/account_contact_overview/' ?><?php echo $row->account_id; ?>">
										<span class="ui-icon ui-icon-mail-closed"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick "
									   title="Delete Account"
									   href="<?php echo site_url() . 'account/delete/' ?><?php echo $row->account_id; ?>">
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
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
