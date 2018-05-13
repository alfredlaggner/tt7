<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>

<div id="sub-nav">
	<div class="page-title">
		<h1>Discount Upload</h1>
	</div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>Upload</h2>
			</div>
			<div class="content-box">
				<div id="inputform"> <?php echo $error; ?>
					<?php /*echo form_open_multipart('discount/do_upload');<?php */ ?>
					<?php echo form_open_multipart('discount/do_upload'); ?>
					<ul>
						<li>
							<input type="file" name="userfile" size="20" class="text"/>
						</li>
						<li>
							<input type="submit" value="Choose Activities" class="buttons"/>
						</li>
						</form>
					</ul>
				</div>
			</div>
			<h3 style="color: green">New: Use Ctrl+click to select multiple activities </h3>

			<p>Important - before you upload make sure everything is in place!</p>
			<p>File Name: groupon_codes.csv</p>
			<p>Format: </p>
			<p>1. Column - Groupon Code</p>
			<p>2. Column - Description</p>
			<p>3. Column - Expiration Date in yyyymmdd format. Put apostroph as first character before the date.</p>
			<p>4. Column - Internal Code 9 </p>
			<p>Create in Excel, set the date format with custom format</p>
			<p>Save it, and the save it as Comma delimited CSV file</p>

		</div>
	</div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>