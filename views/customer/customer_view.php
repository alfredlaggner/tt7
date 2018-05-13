<? $this->load->view('modules/head') ?>
<? $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	<?
	if (!$is_update) {
		$this->session->set_userdata(array('back_url' => $_SERVER['HTTP_REFERER']));
	}

	//echo 'xxxx' . $_SERVER['HTTP_REFERER'];

	?>
	$().ready(function () {
		$("#customer").validate(
			{
				rules: {
					cancel: "cancel",
					first_name: {
						required: true,
						minlength: 2
					},
					last_name: {
						required: true,
						minlength: 2
					}
				},
				messages: {
					first_name: {
						required: "Please enter first name",
						minlength: "Minimum length is 2"
					},
					last_name: {
						required: "Please enter last name",
						minlength: "Minimum length is 2"
					},
					sex: {
						required: "Please enter gender",
						maxlength: "Maximum length is 1",
						minlength: "Minimum length is 1"
					}
				}
			});
	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?= $title ?></h1>
        <span><a href="#" title="Home">Home</a> > <a href="#"
                                                     title="Dashboard">Dashboard</a> > <?= anchor('customer', 'Customer'); ?>
	        > <?= $title_action ?></span></div>
	<? $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?= $title_action ?></h2>
				<span>Update customer record ...</span></div>
			<div id="inputform">
				<? if (isset($records)) : foreach ($records as $row) : ?>
					<ul>
						<? $attributes = array('id' => 'customer'); ?>
						<?= form_open('customer/update/' . $row->customer_id, $attributes); ?>
						<li>
							<label>First Name</label>
							<input type="text" name="first_name" id="first_name" class="text"
							       value='<?= $row->first_name ?>'/>
						</li>
						<li>
							<label>Last Name</label>
							<input type="text" name="last_name" id="last_name" class="text"
							       value='<?= $row->last_name ?>'/>
						</li>
						<label>Address 1</label>
						<input type="text" name="address1" id="address1" class="text" value='<?= $row->address1 ?>'/>
						</li>
						<li>
							<label>Address 2</label>
							<input type="text" name="address2" id="address2" class="text"
							       value='<?= $row->address2 ?>'/>
						</li>
						<li>
							<label>City</label>
							<input type="text" name="city" id="city" class="text" value='<?= $row->city ?>'/>
						</li>
						<li>
							<label>State</label>
							<? $data = ['class' => 'text']; ?>
							<?= form_dropdown('state', $states, $row->state, $data); ?>
						</li>

						<li>
							<label>Zip</label>
							<input type="text" name="zip" id="zip" class="text" value='<?= $row->zip ?>'/>
						</li>

						<li>
							<label>Country</label>
							<input type="text" name="country" id="country" class="text" value='<?= $row->country ?>'/>
						</li>
						<li>
							<label>Email</label>
							<input type="text" name="email" id="email" class="text" value='<?= $row->email ?>'/>
						</li>
						<li>
							<label>Telephone</label>
							<input type="text" name="cell" id="cell" class="text" value='<?= $row->cell ?>'/>
						</li>
						<li>
							<label>Emergency Contact</label>
							<input type="text" name="emergency_contact" id="emergency_contact" class="text"
							       value='<?= $row->emergency_contact ?>'/>
						</li>
						<li>
							<label>Emergency Phone</label>
							<input type="text" name="emergency_phone" id="emergency_phone" class="text"
							       value='<?= $row->emergency_phone ?>'/>
						</li>
						<li>
							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="button" class="cancel buttons" value="Return"
							       ONCLICK="window.location='<?= $this->session->userdata('back_url'); ?>'"/>
						</li>
						<?= form_close(); ?>
					</ul>
				<? endforeach; ?>
				<? endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options
			pages.</i>
		<? $this->load->view('modules/sidebar') ?>
	</div>
	<div class="clear"></div>
</div>
<? $this->load->view('modules/footer') ?>
</body></html>