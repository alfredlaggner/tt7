<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>

<div id="sub-nav">
	<div class="page-title">
		<h1>Upload Result</h1>
	</div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="content-box">
				<div id="inputform">

					<h4 style="color: red"><?= $success_message ?></h4>
					<br>
					<h3 style="text-decoration: underline"><?php echo anchor('discount/upload', 'Click here to upload another discount'); ?></h3><br>
					<h3 style="text-decoration: underline"><?php echo anchor('discount/index/1', 'Click here to see imported discounts'); ?></h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>