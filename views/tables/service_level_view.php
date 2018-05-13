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
					<table>
						<tr>
							<td>Level/Name/Description</td>
							<td></td>
							<td></td>
						</tr>
						<?php if (isset($records)) :
						foreach ($records as $row) : ?>
							<?php echo form_open('service_level/update/' . $row->service_level_id); ?>
							<tr>
								<input type="hidden" name="" id="service_level_id"
								       value='<?php echo $row->service_level_id; ?>'/>
								<td><input type="text" name="level" id="level" class="text"
								           value='<?php echo $row->level; ?>'/><br/>
									<input type="text" name="name" id="name" class="text"
									       value='<?php echo $row->name; ?>'/><br/>
									<textarea class="text_area" name="description"
									          id="description"><?php echo $row->description; ?></textarea></td>
								<td><input type="submit" name="submit" value="Update" class="buttons"/></td>
								<td><input type="submit" name="delete" value="Delete" class="buttons"/></td>
							</tr>
							<?php echo form_close(); ?>
						<?php endforeach; ?>
					</table>
					<?php else : ?>
						<p>No records were returned.</p>
					<?php endif; ?>
					<hr/>
					<h3>Create</h3>
					<?php echo form_open('service_level/create'); ?>
					<table>
						<tr>
							<td>Level/Name/Description</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								<input type="text" name="level" id="level" class="text"/><br/>
								<input type="text" name="name" id="name" class="text"/><br/>
								<textarea class="text_area" name="description" id="description"></textarea></td>
							<td><input type="submit" value="Create" class="buttons"/></td>
						</tr>
					</table>
					<?php echo form_close(); ?> </div>
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