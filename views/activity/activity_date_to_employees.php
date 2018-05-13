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
				<span>&nbsp;</span></div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
					<table id="sort-table">
						<thead>
						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Group Size</th>
							<th>Instructors</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $activity_date) : ?>
							<tr>
								<td><?php echo $activity_date->date; ?></td>
								<td><?php echo $activity_date->time; ?></td>
								<td><?php echo $activity_date->capacity_max; ?></td>
								<td><?php echo $intials; ?></td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>
					</table>
				</form>
				<div class="hastable">
					<?php
					$attributes = array(
						'id' => 'add_employees',
						'class' => "pager-form",
					);
					echo form_open('activity_date/add_activity_date_to_employees/' . $activity_date->activity_date_id . '/' . $employee_count . '/' . $activity_id, $attributes) ?>

					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/>
							</th>
							<th>Initials</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Function</th>
						</tr>
						</thead>
						<?php $i = 0; ?>
						<?php if (isset($employees)) : foreach ($employees as $employee) : ?>
						<?php $i++; ?>
						<tbody>
						<tr>
							<input type="hidden" value="<?php echo $employee->employee_id; ?>"
							       name="employee_id<?php echo $i ?>" id="employee_id<?php echo $i ?>"/>
							<?php if (isset($activity_date_employees)) {
								$checked = FALSE;
								foreach ($activity_date_employees as $dpr) {
									if ($dpr->activity_date_id == $activity_date_id AND $dpr->employee_id == $employee->employee_id)
										$checked = TRUE;
								}
							}
							?>
							<td class="center"><?php echo form_checkbox('employee_add' . $i, $checked, $checked) ?></td>
							<td><?php echo $employee->initials; ?></td>
							<td><?php echo $employee->first_name; ?></td>
							<td><?php echo $employee->last_name; ?></td>
							<td><?php
								if (isset($employee_functions)) {
									foreach ($employee_functions as $employee_function) {
										if ($employee_function->employee_function_id == $employee->employee_function_id)
											echo $employee_function->name;
									}
								}
								?>
							</td>
						</tr>
						<?php endforeach;
						endif; ?>
						</tbody>
						<tr>
							<input type="submit" name="cancel" value="Cancel"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="return" value="Assign & Return"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="assign_employees" value="Assign Instructors"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
						</tr>
					</table>
					</form>
					<i class="note"></i></div>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
