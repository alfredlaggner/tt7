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
				<span><?php echo $top_note ?></span>
			</div>
			<div class="hastable">
				<? $attributes = array('id' => 'template_select'); ?>
				<?= form_open('template/template_over_view', $attributes); ?>
				<div id="inputform">
					<div>
						<ul>
							<li>
								<label>Event</label>
								<select type="text" name="activity_id" id="activity_id" class="text"
								        value='<?= $activity_id ?>'/>

								<option value="0"> All</option>
								<? if (isset($activities)) : foreach ($activities as $activity): ?>
									<? if ($activity_id == $activity->activity_id) : ?>
										<option selected class="text" value="<?= $activity->activity_id; ?>">
											<?= $activity->code . '  ' . $activity->name; ?>
										</option>
									<? else : ?>
										<option value="<?= $activity->activity_id; ?>">
											<?= $activity->code . '  ' . $activity->name; ?>
										</option>
									<? endif; ?>
								<? endforeach;endif; ?>
								</select>
							</li>
							<br/>
							<li>
								<input type="submit" name="template_view" value="List View" class="buttons"/>
							</li>
						</ul>
						<?= form_close(); ?>
					</div>
				</div>

				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body></html>