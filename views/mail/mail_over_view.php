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
					// assign the third column (we start counting zero) 
					6: {
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
				<span><?php echo $top_note ?></span>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Date</th>
							<th>From</th>
							<th>Subject</th>
							<th>Seen</th>
							<th>Status</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>

						<?php if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo $row->date_time; ?></td>
								<td><?php echo $row->from; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td><?php echo $row->seen; ?></td>
								<td><?php echo $row->status; ?></td>
								<td>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit Mail"
									   href="<?php echo site_url() . 'mail/mail_view/' ?><?php echo $row->mail_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete Mail"
									   href="<?php echo site_url() . 'mail/delete/' ?><?php echo $row->mail_id; ?>">
										<span class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>

					</table>
					<div id="pager"><a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page"
					                   href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-w"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
							<span class="ui-icon ui-icon-circle-arrow-w"></span> </a>
						<input type="text" class="pagedisplay text"/>
						<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#"> <span
								class="ui-icon ui-icon-circle-arrow-e"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
							<span class="ui-icon ui-icon-arrowthickstop-1-e"></span> </a>
						<select class="pagesize">
							<option value="10" selected="selected">10 results</option>
							<option value="20">20 results</option>
							<option value="30">30 results</option>
							<option value="40">40 results</option>
						</select>
					</div>

				</form>
				<br/>
				<br/>
				<br/>
				<br/>
				<i class="note">Sort multiple columns simultaneously by holding down the shift key and clicking a
					second, third or even fourth column header!</i></div>
			<div class="clear"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
</div>
</body></html>