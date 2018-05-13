<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#employee").validate();
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('Employee', 'Commission Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>&nbsp;</span></div>
			<div class="content-box">
				<div id="inputform">
					<?php if (isset($employees)) : foreach ($employees as $row) : ?>
					<ul>
						<?php $attributes = array('id' => 'employee');
						echo form_open('employee/return_employee_cms', $attributes) ?>

						<input type="hidden" name="employee_id" id="employee_id" class="text"
						       value='<?php echo $row->employee_id; ?>'/>
						<li>
							<label>Name</label>
							<input type="text" name="name" id="name" class="text"
							       value='<?php echo $row->first_name . ' ' . $row->last_name; ?>'/>
						</li>
						<li>
							<label>Current Commission</label>
							<input type="text" name="name" id="name" class="text"
							       value='<?php echo $commission . '%' ?>'/>
						</li>
						<li>
							<input type="submit" name="cancel" value="Return to Employee Overview" class="buttons"/>
						</li>
						<?php echo form_close(); ?>
					</ul>
				</div>
				<i class="note"></i>
				<p style="float:right" ;>
					<?php echo anchor('employee/employee_cms_create/' . $row->employee_id, 'Add New Commission') ?>
				</p>
				<?php endforeach;
				endif; ?>
				<div class="clearfix"></div>
				<div class="hastable">
					<form name="myform" class="pager-form" method="post" action="">
						<table id="sort-table">
							<thead>
							<tr>
								<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
								           class="submit"/></th>
								<th>Effective Date</th>
								<th>Commission %</th>
								<th style="width:128px">Options</th>
							</tr>
							</thead>
							<tbody>
							<?php if (isset($records)) : foreach ($records as $cms) : ?>
								<tr>
									<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/>
									</td>
									<td><?php echo $cms->cms_eff_date; ?></td>
									<td><?php echo $cms->cms_amount . '%' ?></td>
									<td>
										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
										   title="Edit Commission"
										   href="<?php echo site_url() . 'employee/employee_cms_edit/' . $cms->employee_cms_id . '/' . $cms->employee_id ?>">
											<span class="ui-icon ui-icon-wrench"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
										   title="Delete Commission"
										   href="<?php echo site_url() . 'employee/employee_cms_delete/' . $cms->employee_cms_id . '/' . $cms->employee_id ?>">
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
		<?php $this->load->view('modules/footer') ?>
		</body>
		</html>
