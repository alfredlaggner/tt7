<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>
<? if (isset($records)) : foreach ($records as $row) : ?>

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
					<?= form_open('home_slider/update/' . $row->home_slider_id); ?>

					<label>Name</label>
					<li><input type="text" name="name" id="name" class="text" value='<?= $row->name; ?>'/></li>

					<label>Order</label>
					<li><input type="text" name="order" id="order" class="text" value='<?= $row->order; ?>'/></li>

					<label>Slogan</label>
					<li><input type="text" name="slogan" id="slogan" class="text" value='<?= $row->slogan; ?>'/></li>

					<label>Region</label>
					<li><select type="text" name="region_id" id="region_id" class="text"
					            value='<?= $row->region_id; ?>'/>

						<? if (isset($regions)) : foreach ($regions as $region): ?>
							<? if ($row->region_id == $region->region_id) : ?>
								<option selected value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
							<? else : ?>
								<option value="<?= $region->region_id; ?>"><?= $region->region; ?></option>
							<? endif; ?>
						<? endforeach; ?>
						<? endif; ?>

						</select></li>

					<label>Link</label>
					<li><input type="text" name="link" id="link" class="text" value='<?= $row->link; ?>'/></li>

					<label>Description</label>
					<li><textarea class="text_area" name="description_short" id="description_short" rows="3"
					              cols="30"><?= $row->description_short; ?> </textarea></li>

					<li>
						<label>Featured</label>
						<?= form_checkbox('is_featured', $row->is_featured, $row->is_featured) ?>
					</li>
					<li>&nbsp;
					</li>
					<li>
						<label>Active</label>
						<?= form_checkbox('is_active', $row->is_active, $row->is_active) ?>
					</li>
					<li>
						<input type="submit" name="update" value="Update" class="buttons"/>
						<input type="submit" name="return" value="Save & Return" class="buttons"/>
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
	<? endforeach;
	endif ?>
</div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>