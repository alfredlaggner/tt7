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
				<span>&nbsp;</span>
				<p style="float:right" ;>
					<?php echo anchor('employee/employee_create', 'Add New Employee') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Order</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Function</th>
							<th>Published</th>
							<th>Commission</th>
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo $row->order; ?></td>
								<td><?php echo $row->first_name; ?></td>
								<td><?php echo $row->last_name; ?></td>
								<td><?php
									if (isset($employee_functions)) {
										foreach ($employee_functions as $employee_function) {
											if ($employee_function->employee_function_id == $row->employee_function_id)
												echo $employee_function->name;
										}
									}
									?>
								</td>

								<td><?php echo $row->is_published; ?></td>
								<td><?php $commission = 'kommt bald ';
									echo $commission . '%'; ?></td>

								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
								       title="Edit employee"
								       href="<?php echo site_url() . 'employee/employee_view/' ?><?php echo $row->employee_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Employee Commission"
									   href="<?php echo site_url() . 'employee/employee_cms_overview/' ?><?php echo $row->employee_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete employee"
									   href="<?php echo site_url() . 'employee/delete/' ?><?php echo $row->employee_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a>

								</td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>
					</table>
				</form>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
