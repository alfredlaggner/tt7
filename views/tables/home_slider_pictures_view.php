<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
	</div>
	<div id="page-layout">
		<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2><?php echo $title_action ?></h2>
				<span> Slider Name: <?= $home_slider_name ?>				
</span></div>
				<div class="content-box">
					<div id="inputform">
						<table>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php if (isset($records)) :
							foreach ($records as $row) : ?>
								<?php echo form_open('home_slider_pictures/update/' . $row->home_slider_picture_id); ?>
								<input type="hidden" name="home_slider_picture_id" id="home_slider_picture_id"
								       value='<?php echo $row->home_slider_picture_id; ?>'/>
								<input type="hidden" name="home_slider_id" id="home_slider_id"
								       value='<?php echo $row->home_slider_id; ?>'/>
								<input type="hidden" name="folder" id="folder" value='<?php echo $row->folder; ?>'/>
								<tr>
									<td><img
											src="<?= base_url() . CLASSES_IMAGE_DIR . $row->folder . '/' . $row->picture ?>"
											width="150" height="150"/></td>

									<td><input type="text" name="picture" id="picture" class="text"
									           value='<?php echo $row->picture; ?>'/>
									</td>
									<td><input type="submit" name="submit" value="Update" class="buttons"/></td>
									<td><input type="submit" name="delete" value="Delete" class="buttons"/></td>
								</tr>
								<?php echo form_close(); ?>
							<?php endforeach; ?>
						</table>
						<?php endif; ?>
						<hr/>
						<h3>Create</h3>
						<?php echo form_open('home_slider_pictures/create'); ?>
						<table>
							<tr>
								<td>Picture</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<input type="hidden" name="folder" id="folder" value='<?php echo $folder; ?>'/>
								<input type="hidden" name="home_slider_id" id="home_slider_id"
								       value='<?php echo $home_slider_id; ?>'/>
								<td><input type="text" name="picture" id="picture"
								           class="text" value='<?php echo $folder; ?>'/>
								<td><input type="submit" value="Create" class="buttons"/></td>
							</tr>
						</table>
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