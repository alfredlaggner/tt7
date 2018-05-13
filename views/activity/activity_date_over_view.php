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
			</div>
			<div class="content-box">
				<div id="inputform">
					<?php if (isset($records)) : foreach ($records as $row) : ?>
						<h3>Event Dates for <?php echo $row->name ?></h3>
						<ul>
							<?php $attributes = array('id' => 'employee');
							echo form_open('activity', $attributes) ?>
							<li>
								<input type="submit" name="cancel" value="Return to Activity Overview" class="buttons"/>
							</li>
							<?php echo form_close(); ?>
						</ul>
					<?php endforeach; endif; ?>
				</div>
			</div>
			<div class="hastable">
				<p style="float:right" ;>
					<?php echo anchor('activity_date/activity_date_create/' . $row->activity_id, 'Add New Event ') ?>
				</p>
				<table id="sort-table">
					<thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Max. Group</th>
						<th>Instructors</th>
						<th style="width:128px">Options</th>
					</tr>
					</thead>
					<tbody>
					<?php if (isset($dates)) : foreach ($dates as $row2) : ?>
						<tr>
							<td><?php echo $row2->date; ?></td>
							<td><?php echo $row2->time; ?></td>
							<td><?php echo $row2->capacity_max; ?></td>
							<td><?php echo $this->activity_date_to_employee_model->get_employee_string($row2->activity_date_id); ?></td>
							<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit Event"
							       href="<?php echo site_url() . 'activity_date/activity_date_view/' ?><?php echo $row2->activity_date_id; ?>/<?php echo $row->activity_id; ?>">
									<span class="ui-icon ui-icon-calendar"></span> </a> <a
									class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									title="Assign Instructors"
									href="<?php echo site_url() . 'activity_date/assign_employees/' ?><?php echo $row2->activity_date_id . '/' . $row->activity_id; ?>">
									<span class="ui-icon ui-icon-plus"></span> </a> <a
									class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									title="Delete Event"
									href="<?php echo site_url() . 'activity/delete/' ?><?php echo $row->activity_id; ?>">
									<span class="ui-icon ui-icon-trash"></span> </a></td>
						</tr>
					<?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="clear"></div>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</div>
</body></html>