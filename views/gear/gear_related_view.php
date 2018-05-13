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
							<th>Code</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($selected_activities)) : foreach ($selected_activities as $row) : ?>
							<tr>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->code; ?></td>
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
					echo form_open('gear_related/create/' . $gear_id . '/' . $gear_count, $attributes) ?>

					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/>
							</th>
							<th>Name</th>
							<th>Code</th>
						</tr>
						</thead>

						<?php $i = 0; ?>
						<?php if (isset($activities)) : foreach ($activities as $row) : ?>
						<?php $i++; ?>
						<tbody>
						<tr>
							<input type="hidden" value="<?php echo $row->gear_id; ?>"
							       name="gear_related_id<?php echo $i ?>" id="gear_related_id<?php echo $i ?>"/>

							<?php if (isset($gear_related)) {
								$checked = FALSE;
								foreach ($gear_related as $dpr) {
									if ($dpr->gear_id == $gear_id AND $dpr->gear_related_id == $row->gear_id)
										$checked = TRUE;
								}
							}
							?>
							<td class="center"><?php echo form_checkbox('gear_related_add' . $i, $checked, $checked) ?></td>
							<td><?php echo $row->name; ?></td>
							<td><?php echo $row->code; ?></td>
						</tr>
						<?php endforeach;
						endif; ?>
						</tbody>
						<tr>
							<input type="submit" name="cancel" value="Cancel"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="return" value="Assign & Return"
							       class="ui-state-default float-right ui-corner-all ui-button"/>
							<input type="submit" name="assign_gear" value="Assign Gear"
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
