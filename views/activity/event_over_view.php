<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>

<?php $this->xajax->printJavascript(); ?>

<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->

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
					<?php echo anchor('event/event_create/' . $row->activity_id, 'Add New Event ') ?>
				</p>
				<table id="sort-table">
					<thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Max. Group</th>
						<th>Instructors</th>
						<th>Status</th>
						<th style="width:128px">Options</th>
					</tr>
					</thead>
					<tbody>
					<?php $i = 0;
					if (isset($dates)) : foreach ($dates as $row2) : ?>
						<?
						$status = "";
						if ($row2->is_deleted)
							$status = "Invisible";
						else
							$status = "";
						?>
						<tr>
							<td><?php echo $row2->date; ?></td>
							<td><?php echo $row2->time; ?></td>
							<td><?php echo $row2->capacity_max; ?></td>
							<td><?php echo $this->event_to_employee_model->get_employee_string($row2->event_id); ?></td>
							<td id='status<?= $i ?>'><?php echo $status; ?></td>

							<td>
								<a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit Event"
								   href="<?php echo site_url() . 'event/event_view/' ?><?php echo $row2->event_id; ?>/<?php echo $row->activity_id; ?>">
									<span class="ui-icon ui-icon-calendar"></span> </a>
								<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
								   title="Assign Instructors"
								   href="<?php echo site_url() . 'event/assign_employees/' ?><?php echo $row2->event_id . '/' . $row->activity_id; ?>">
									<span class="ui-icon ui-icon-plus"></span>
								</a>

								<a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Make invisible"
								   onClick="xajax_delete_event(<?php echo $row2->event_id ?>,<?php echo $i ?>);return false;"
								   href="#"> <span class="ui-icon ui-icon-trash"></span> </a>

						</tr>
						<? $i++ ?>
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