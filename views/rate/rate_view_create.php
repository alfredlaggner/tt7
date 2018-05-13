<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate the comment form when it is submitted
		$("#xrate").validate();

		// validate signup form on keyup and submit
		$("#rate").validate({
			rules: {
				name: {
					minlength: 3
				},
				order: {
					required: true,
					range: [1, 10]
				},
				status_dependent_text: {
					required: "#is_status_dependent:checked"
				}
			},
			messages: {
				order: {
					required: "Please enter a value between 1 and 10",
					range: "Order must be between 1 and 10"
				},
				name: {
					required: "Please enter a name for this rate",
					range: "Minimum length is 3"
				},
				status_dependent_text: {
					required: "Status dependent text is checked, enter text"
				}
			}
		});
//	$("#is_status_dependent").click(function() {
//	  $("#is_status_dependent").valid();});

	});

</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate', 'Rate Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<?php if (isset($rate_plans)) : foreach ($rate_plans as $rate_plan) : ?>
					<span>Rate Plan: <?php echo $rate_plan->name ?></span>
				<?php endforeach ?>
				<?php endif ?>
			</div>
			<div class="content-box">
				<div id="inputform">
					<ul>
						<?php $attributes = array('id' => 'rate');
						echo form_open('rate/add_rate', $attributes) ?>
						<input type="hidden" name="rate_plan_id" id="rate_plan_id" class="text"
						       value='<?php echo $rate_plan_id ?>'/>
						<li>
							<label>Name</label>
							<input type="text" name="name" id="name" class="required text" minlength="2" value=''/>
						</li>
						<li>
							<label>Order</label>
							<input type="text" name="order" id="order" class="text" minlength="1" value=''/>
						</li>
						<li>
							<label>Description</label>
							<textarea class="text_area" name="description" id="description"></textarea>
						</li>
						<li>
							<label>Status dependent</label>
							<?php
							//						$data = array(
							//								'name'        => 'is_status_dependent',
							//								'id'          => 'is_status_dependent',
							//								'value'       => 0,
							//								'checked'     => FALSE
							//								);
							//						
							//						
							//						echo form_checkbox('is_status_dependent',$data) ?>
							<input type="checkbox" name="is_status_dependent" value="0" checked=""/>
						</li>
						<li>
							<label>Status dependent text</label>
							<input type="text" name="status_dependent_text" id="status_dependent_text" class="text"
							       value=''/>
						</li>
						<li>
							<label>Minimum Age</label>
							<input type="text" name="age_from" id="age_from" class="text" value=''/>
						</li>
						<li>
							<label>Maximum Age</label>
							<input type="text" name="age_to" id="age_to" class="text" value=''/>
						</li>
						<li>
							<label>Minimum Party Size</label>
							<input type="text" name="party_size_min" id="party_size_min" class="text" value=''/>
						</li>
						<li>
							<label>Maximum Party Size</label>
							<input type="text" name="party_size_max" id="party_size_max" class="text" value=''/>
						</li>
						<li>
							<label>Active</label>
							<?php echo form_checkbox('is_active', 'no', FALSE) ?> </li>
						<li>
							<input type="submit" name="create" value="Create" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="buttons"/>
						</li>
						<?php echo form_close(); ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout
					Options pages.</i>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
	</body>
	</html>
