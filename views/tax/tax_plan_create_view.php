<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#tax_plan").validate(
			{
				rules: {
					name: {
						required: true,
						minlength: 3
					}
				},
				messages: {
					name: {
						required: "Please enter a tax group name",
						minlength: "Minimum length is 3"
					}
				}
			});
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('tax_plan', 'tax Plan Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span></span></div>
			<div class="content-box">
				<?php $attributes = array('id' => 'tax_plan'); ?>
				<div id="inputform"> <?php echo form_open('tax/add_tax_plan', $attributes); ?>
					<ul>
						<!--						<input type="hidden" name="tax_plan_id" id="tax_plan_id"  value='<?php // echo $tax_plan_id ?>' />
-->                        </td>
						<li>
							<label>Name </label>
							<input type="text" name="name" id="name" class=" required text"/>
							</td>
						</li>
						<li>
							<label>Description</label>
							<textarea class="text_area" name="description" id="description"></textarea>
						</li>
						<li>
							<label>Active</label>
							<?php echo form_checkbox('is_active', 'no', TRUE) ?> </li>
						<li>
							<input type="submit" id="create" name="create" value="Create" class="buttons"/>
							<input type="submit" id="cancel" name="cancel" value="Cancel" class="cancel buttons"/>
						</li>
					</ul>
					<?php echo form_close(); ?> </div>
			</div>
			<div class="clearfix"></div>
			<i class="note">&nbsp;</i>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>