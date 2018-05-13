<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?= anchor('location', 'Home Slide'); ?>
			> <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span></span></div>
			<div id="inputform">
				<ul width="800" border="0">
					<?= form_open('home_slider/create'); ?>

					<label>Name</label>
					<li><input type="text" name="name" id="name" class="text"/></li>

					<label>Order</label>
					<li><input type="text" name="order" id="order" class="text"/></li>

					<label>Slogan</label>
					<li><input type="text" name="slogan" id="slogan" class="text"/></li>

					<label>Region</label>
					<li><select type="text" name="region_id" id="region_id" class="text" value=''/>

						<? if (isset($regions)) : foreach ($regions as $region): ?>
							<option value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
						<? endforeach; ?>
						<? endif; ?>
						</select></li>

					<label>Link</label>
					<li><input type="text" name="link" id="link" class="text"/></li>

					<label>Description</label>
					<li><textarea class="text_area" name="description_short" id="description_short" rows="3"
					              cols="30"></textarea></li>
					<li>
						<label>Featured</label>
						<?= form_checkbox('is_featured', 'no', FALSE) ?> </li>
					<li>
						<label>Active</label>
						<?= form_checkbox('is_active', 'no', FALSE) ?> </li>

					<li>
						<label><input type="submit" name="submit" value="Add" class="buttons"/>
							<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
					</li>

					<?= form_close(); ?>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note"></i>
		<? $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>