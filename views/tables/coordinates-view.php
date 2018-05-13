<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

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
				<span><?php echo $top_note ?></span></div>
			<div class="content-box">
				<div id="inputform">
					<ul>
						<li>
							Location/Coordinates
						</li>
						<?php if (isset($records)) :
						foreach ($records as $row) : ?>
							<?php echo form_open('coordinates/update/' . $row->coordinates_id); ?>

							<input type="hidden" name="" id="coordinates_id"
							       value='<?php echo $row->coordinates_id; ?>'/>
							<input type="hidden" name="location_id" id="location_id"
							       value='<?php echo $row->location_id; ?>'/>

							<li><input type="text" name="location" id="location" class="text"
							           value='<?php echo $row->location; ?>'/></li>
							<li><input type="text" name="longitude" id="longitude" class="text"
							           value='<?php echo $row->longitude; ?>'/></li>
							<li><input type="text" name="latitude" id="latitude" class="text"
							           value='<?php echo $row->latitude; ?>'/></li>

							<li><input type="submit" name="submit" value="Update" class="buttons"/>
								<input type="submit" name="delete" value="Delete" class="buttons"/></li>
							</li>
							<?php echo form_close(); ?>
						<?php endforeach; ?>
					</ul>
					<?php else : ?>
						<p>No records were returned.</p>
					<?php endif; ?>
					<hr/>
					<h3>Create</h3>
					<?php echo form_open('coordinates/create'); ?>
					<ul>
						<li>Location/Coordinates</li>

						<input type="hidden" name="location_id" id="location_id" value='<?php echo $location_id; ?>'/>

						<li><input type="text" name="location" id="location" class="text" value=''/></li>
						<li><input type="text" name="longitude" id="longitude" class="text" value=''/></li>
						<li><input type="text" name="latitude" id="latitude" class="text" value=''/></li>

						<li><input type="submit" value="Create" class="buttons"/></li>
					</ul>
					<?php echo form_close(); ?> </div>
			</div>
			<div class="clearfix"></div>
			<i class="note"><?php echo $bottom_note ?></i>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<div class="clear"></div>
</div>
</div>
<?php $this->load->view('modules/footer') ?>
</div>
</body></html>