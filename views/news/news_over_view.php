<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/tablesorter-pager.js"></script>
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
					7: {
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
					<?= anchor('news/news_create', 'Create New news') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Name</th>
							<th>Code</th>
							<th>Group</th>
							<th>Order</th>
							<th>Featured</th>
							<th>Active</th>
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
								<td><?= $row->name; ?></td>
								<td><?= $row->code; ?></td>
								<td><?= $this->news_group_model->get_news_group_name($row->news_group_id); ?></td>
								<td><?= $row->order; ?></td>
								<td><? if ($row->is_featured) echo "Yes"; else echo "No"; ?></td>
								<td><? if ($row->is_active) echo "Yes"; else echo "No"; ?></td>
								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit news"
								       href="<?= site_url() . 'news/news_view/' ?><?= $row->news_id; ?>"> <span
											class="ui-icon ui-icon-wrench"></span> </a>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Pictures"
									   href="<?= site_url() . 'news_pictures/index/0/' ?><?= $row->news_id . '/' . $row->code ?>">
										<span class="ui-icon ui-icon-image"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Related newss"
									   href="<?= site_url() . 'news_related/index/' ?><?= $row->news_id ?>"> <span
											class="ui-icon ui-icon-link"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete news"
									   href="<?= site_url() . 'news/delete/' ?><?= $row->news_id; ?>"> <span
											class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>
						<? endforeach; endif; ?>
						</tbody>
					</table>
					<div id="pager"><a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page"
					                   href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-w"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
							<span class="ui-icon ui-icon-circle-arrow-w"></span> </a>
						<input type="text" class="pagedisplay"/>
						<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#"> <span
								class="ui-icon ui-icon-circle-arrow-e"></span> </a> <a
							class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
							<span class="ui-icon ui-icon-arrowthickstop-1-e"></span> </a>
						<select class=" text pagesize">
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
				<i class="note"><?= $bottom_note ?></i></div>
			<div class="clear"></div>
			<? $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<? $this->load->view('modules/footer') ?>
</div>
</body></html>