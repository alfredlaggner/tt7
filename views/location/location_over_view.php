<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
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
				<p style="float:right" ;>
					<?php echo anchor('location/location_create', 'Create New Location') ?>
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
							<th>Name</th>
							<th>Code</th>
							<th>Region</th>
							<th>Directions</th>
							<th>City</th>
							<th>Coordinates</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>

						<? if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?= $row->location_id ?></td>
								<td><?= $row->name ?></td>
								<td><?= $row->code ?></td>
								<td><?= $this->region_model->get_region_name($row->region_id) ?></td>
								<td><?= $row->directions ?></td>
								<td><?= $row->city ?></td>
								<td><?= $row->latitude ?>,<?= $row->longitude ?></td>
								<td>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Location"
									   href="<?php echo site_url() . 'location/location_view/' ?><?= $row->location_id ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Coordinates"
									   href="<?php echo site_url() . 'coordinates/index/' ?><?= $row->location_id ?>">
										<span class="ui-icon ui-icon-extlink"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete Location"
									   href="<?php echo site_url() . 'location/delete/' ?><?= $row->location_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>
						<? endforeach; endif; ?>
						</tbody>

					</table>
					<!--					<div id="pager"> <a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-w"></span> </a> <a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#"> <span class="ui-icon ui-icon-circle-arrow-w"></span> </a>
						<input type="text" class="pagedisplay"/>
						<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#"> <span class="ui-icon ui-icon-circle-arrow-e"></span> </a> <a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#"> <span class="ui-icon ui-icon-arrowthickstop-1-e"></span> </a>
						<select class="pagesize">
							<option value="10" selected="selected">10 results</option>
							<option value="20">20 results</option>
							<option value="30">30 results</option>
							<option value="40">40 results</option>
						</select>
					</div>
-->
				</form>
				<i class="note">Sort multiple columns simultaneously by holding down the shift key and clicking a
					second, third or even fourth column header!</i></div>
			<div class="clear"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
</div>
</body></html>