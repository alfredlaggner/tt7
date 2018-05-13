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
					<?php echo anchor('home_slider/home_slider_create', 'Create New Home Slide') ?>
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
							<th>Order</th>
							<th>Region</th>
							<th>Featured</th>
							<th>Active</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>

						<? if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?= $row->name ?></td>
								<td><?= $row->order ?></td>
								<td><?= $this->region_model->get_region_name($row->region_id) ?></td>
								<td><? if ($row->is_featured) echo "Yes"; else echo "No"; ?></td>
								<td><? if ($row->is_active) echo "Yes"; else echo "No"; ?></td>
								<td>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Home Slide"
									   href="<?php echo site_url() . 'home_slider/home_slider_view/' ?><?= $row->home_slider_home_slider_id ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Edit Pictures"
									   href="<?= site_url() . 'home_slider_pictures/index/0/' ?><?= $row->home_slider_home_slider_id ?>">
										<span class="ui-icon ui-icon-image"></span> </a>


									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete Home Slide"
									   href="<?php echo site_url() . 'home_slider/delete/' ?><?= $row->home_slider_home_slider_id ?>">
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