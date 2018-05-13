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
				<div id="inputform">
					<?php echo $error; ?>



					<?php echo form_open_multipart('discount/upload_test'); ?>
					<ul>
						<li><input type="file" name="userfile" size="20" class="text"/></li>

						<li><select multiple type="text" name="activity[]" id="division_id" value=''/>
							<?php if (isset($activities)) : foreach ($activities as $activitiy): ?>
								<option
									value="<?php echo $activitiy->activity_id; ?>"><?php echo $activitiy->activity_id . ' ' . $activitiy->name; ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
							</select></li>

						<li>
							<input type="submit" value="upload" class="buttons"/></li>
					</ul>
					</form>
				</div>
				<p>Important - before you upload make sure everything is in place!</p>
				<p>File Name: groupon_codes.csv</p>
				<p>Format: </p>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td width="64">241-IN</td>
						<td width="450">4-Hour Beginners' Rock-Climbing Excursion for 1 Person (an $89 value)</td>
						<td align="right" width="68">2012-10-1</td>
						<td align="right" width="64">9</td>
					</tr>
				</table>
				<p>1. Column - Groupon Code</p>
				<p>2. Column - Description</p>
				<p>3. Column - Expiration Date in yyyy-mm-dd format</p>
				<p>4. Column - Internal Code 9 (may disappear in future versions)</p>
				<p>Create in Excel, set the date format with custom format</p>
				<p>Save it, and the save it as Comma delimited CSV file</p>
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