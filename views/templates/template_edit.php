<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<? $is_preview = isset($is_preview) ? $is_preview : FALSE ?>
<? $place_holders_text = isset($place_holders_text) ? $place_holders_text : "" ?>
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
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<table width="800" border="1">
						<?php echo form_open('customer_contact/manage_template/' . $template_id . '/' . $row->activity_id); ?>

						<td>eMail Subject</td>
						<? if ($is_preview) : ?>
							<td><input type="text" name="subject" id="subject" readonly class="text"
							           value='<?= $row->subject_substituted ?>'/></td>
						<? else : ?>
							<td><input type="text" name="subject" id="subject" class="text"
							           value='<?= $row->subject ?>'/></td>
						<? endif ?>
						<tr></tr>

						<td>eMail Body</td>
						<? if ($is_preview) : ?>
							<td><textarea class="text_area" rows="20" readonly name="body"
							              id="body"> <?= $row->body_substituted ?> 
</textarea></td>
						<? else : ?>
							<td><textarea class="text_area" name="body" id="body"> <?= $row->body ?> 
</textarea></td>
						<? endif ?>
						</tr>

						<td></td>
						<td><input type="submit" name="submit" value="Send Mails" class="buttons"/>
							<? if ($is_preview) : ?>
								<input type="submit" name="submit" value="Template View" class="buttons"/>
							<? else : ?>
							<input type="submit" name="submit" value="Preview Mail" class="buttons"/>
							<input type="submit" name="submit" value="Start Over" class="buttons"/>
							<input type="submit" name="submit" value="Save" class="buttons"/>
							<input type="submit" name="submit" value="Abort" class="buttons"/></td>
					<? endif ?>
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
								<td><p>Format Placeholders: Highlight the placeholder including {}; then apply eraser
										before formating.</td>
							</tr>
						<? endif; endif ?>
					</table>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>


		</div>
		<div class="clearfix"></div>
		<i class="note"></i>
		<?php $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
<?php $this->load->view('modules/footer') ?>
</body></html>