<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Tabs
		$('#tabs').tabs();
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('employee', 'Employee'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</span>
			</div>
			<div id="inputform">
				<ul>
					<?php echo form_open('employee/create'); ?>
					<li>
						<label>First Name</label>
						<input type="text" name="first_name" id="first_name" class="text" value=''/>
					</li>
					<li>
						<label>Last Name</label>
						<input type="text" name="last_name" id="last_name" class="text" value=''/>
					</li>
					<li>
						<label>Initials</label>
						<input type="text" name="initials" id="initials" class="text" maxlength="3" value=''/>
					</li>
					<li>
						<label>DOB</label>
						<input type="text" name="dob" id="dob" class="text" value=''/>
					</li>
					<li>
						<label>Function</label>
						<input type="text" name="employee_function_id" id="employee_function_id" class="text" value=''/>
					</li>
					<li>
						<label>Function</label>
						<select type="text" name="employee_function_id" id="employee_function_id" class="text"
						        value=''/>

						<?php if (isset($employee_functions)) : foreach ($employee_functions as $employee_function) : ?>
							<option
								value="<?php echo $employee_function->employee_function_id; ?>"><?php echo $employee_function->name; ?></option>
						<?php endforeach; ?>
						<?php endif; ?>
						</select>
					</li>
					<li>
						<label>Picture</label>
						<input type="text" name="picture" id="picture" class="text" value=''/>
					</li>
					<li>
						<label>Bio</label>
						<textarea class="text_area" name="bio" id="bio"> </textarea>
					</li>
					<li>
						<label>Certifications</label>
						<textarea class="text_area" name="about" id="about"></textarea>
					</li>
					<li>
						<label>Published Title</label>
						<input type="text" class="text" name="subtitle" id="subtitle" value=''/>
					</li>
					<li>
						<label>Published Slogan</label>
						<input type="text" class="text" name="slogan" id="slogan" value=''/>
					</li>
					<li>
						<label>Order</label>
						<input type="text" class="text" name="order" id="order" value=''/>
					</li>
					<li>
						<label>AMGA Certified?</label>
						<?= form_checkbox('is_amga', 'no', FALSE) ?> </li>
					</li>
					<li>
						<label>Published?</label>
						<?= form_checkbox('is_published', 'no', FALSE) ?> </li>
					</li>
					<li>
						<td><input type="submit" name="submit" value="Add" class="buttons"/></td>
					</li>
					<?php echo form_close(); ?>
				</ul>
			</div>
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