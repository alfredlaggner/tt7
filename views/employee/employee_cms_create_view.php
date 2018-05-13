<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function () {
		$('#cms_eff_date').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true,
			minDate: 0,
			maxDate: "+1Y"
		});
	});
	$(function () {
		$("#cms_eff_date").mask("9999/99/99");
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('employee', 'Employee'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Enter effective date and commission percentage for this employee.</span></div>
			<div id="inputform">
				<ul>
					<?php echo form_open('employee/add_employee_cms'); ?>
					<input type="hidden" name="employee_id" id="employee_id" class="text"
					       value='<?php echo $employee_id ?>'/>
					<li>
						<label>Effective Date</label>
						<input type="text" name="cms_eff_date" id="cms_eff_date" class="text" value=''/>
					</li>
					<li>
						<label>Rate in %</label>
						<input type="text" name="cms_amount" id="cms_amount" class="text" value=''/>
					</li>
					<li>
						<td>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</td>
					</li>
					<?php echo form_close(); ?>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
			pages.</i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>