<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>File Uploads</h2>
				<span><?php echo $error; ?></span></div>
			<div id="inputform">

				<table width="800" border="0">


					<?php echo form_open_multipart('attachment/do_upload'); ?>

					<tr>
						<td><input type="file" name="userfile"/>
						<td>
					</tr>
					<tr>
						<td><input type="submit" value="upload"/></td>
					</tr>

					<?php echo form_close(); ?>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note"></i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>