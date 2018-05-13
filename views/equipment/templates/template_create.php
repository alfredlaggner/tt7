<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('template', 'template'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span></span></div>
			<div id="inputform">
				<table width="800" border="1">
					<?php echo form_open('template/create'); ?>
					<tr>
						<input type="text" name="activity_id" id="activity_id" value= <?= $activity_id ?>/>
					</tr>
					<tr>

					<tr>
						<td>Name</td>
						<td><input type="text" name="name" id="name" class="text"/></td>
					<tr>
						<td>eMail Subject</td>
						<td><input type="text" name="subject" id="subject" class="text"/></td>
					<tr></tr>

					<td>eMail Body</td>
					<td><textarea class="text_area" name="body" id="body"> 
</textarea></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Save" class="buttons"/>
							<input type="submit" name="submit" value="Abort" class="buttons"/>
						</td>
					</tr>
					<?php echo form_close(); ?>
					<? if (isset($place_holders_text)) : if ($place_holders_text) : ?>
						<tr>
							<td></td>
							<td><p>Valid Placeholders:
									<?= $place_holders_text ?>
								</p></td>
						</tr>
						<tr>
							<td></td>
							<td><p>Format Placeholders: Highlight the placeholder including {}; then apply eraser before
									formating.</td>
						</tr>
					<? endif; endif ?>
				</table>
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