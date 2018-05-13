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
							<th>Name</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $activity) : ?>
							<tr>
								<td><?php echo $activity->name; ?></td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>
					</table>
				</form>
				<div class="hastable">
					<?php
					$attributes = array(
						'id' => 'add_regions',
						'class' => "pager-form",
					);
					echo form_open('activity/add_region_to_activity/' . $activity->activity_id . '/' . $region_count, $attributes) ?>

					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/>
							</th>
							<th>Region</th>
						</tr>
						</thead>
						<?php $i = 0; ?>
						<?php if (isset($regions)) : foreach ($regions as $region) : ?>
						<?php $i++; ?>
						<tbody>
						<tr>
							<input type="hidden" value="<?php echo $region->region_id; ?>"
							       name="region_id<?php echo $i ?>" id="region_id<?php echo $i ?>"/>
							<?php if (isset($activity_region)) {
								$checked = FALSE;
								foreach ($activity_region as $dpr) {
									if ($dpr->activity_id == $activity_id AND $dpr->region_id == $region->region_id)
										$checked = TRUE;
								}
							}
							?>
							<td class="center"><?php echo form_checkbox('region_add' . $i, $checked, $checked) ?></td>
							<td><?php echo $region->region; ?></td>
						</tr>
						<?php endforeach;
						endif; ?>
						</tbody>
						<tr>
							<input type="submit" name="cancel" value="Cancel"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="return" value="Assign & Return"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="assign_region" value="Assign Regions"
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
