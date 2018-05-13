<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#rate_plan").validate();
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate_plan', 'rate_plan Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>&nbsp;</span></div>
			<div class="content-box">
				<div id="inputform">
					<?php if (isset($records)) : foreach ($records as $row) : ?>
					<ul>
						<?php $attributes = array('id' => 'rate_plan');
						echo form_open('rate/update_rate_plan/' . $row->rate_plan_id, $attributes) ?>
						<input type="hidden" name="rate_plan_id" id="rate_plan_id" class="text"
						       value='<?php echo $row->rate_plan_id; ?>'/>
						<li>
							<label>Name</label>
							<input type="text" name="name" id="name" class="required text"
							       value='<?php echo $row->name; ?>'/>
						</li>
						<li>
							<label>Description</label>
							<textarea class="text_area" name="description"
							          id="description"><?php echo $row->description; ?></textarea>
						</li>

						<li>
							<label>Tax Plan</label>
							<select type="text" name="tax_plan_id" id="tax_plan_id" class="text"
							        value='<?php echo $row->tax_plan_id; ?>'/>

							<?php if (isset($tax_plans)) : foreach ($tax_plans as $tax_plan): ?>
								<?php if ($row->tax_plan_id == $tax_plan->tax_plan_id) : ?>
									<option selected
									        value="<?php echo $tax_plan->tax_plan_id; ?>"><?php echo $tax_plan->name; ?></option>
								<?php else : ?>
									<option
										value="<?php echo $tax_plan->tax_plan_id; ?>"><?php echo $tax_plan->name; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							</select>
						</li>
						<li>
							<label class="desc">Type</label>
							<?php
							$activity_checked = $row->type == 'A';
							$lodging_checked = $row->type == 'L';
							$data = array(
								'name' => 'type',
								'id' => 'type',
								'value' => 'A',
								'checked' => $activity_checked,
							);
							echo form_radio($data);
							?> Activity
							<?php
							$data = array(
								'name' => 'type',
								'id' => 'type',
								'value' => 'L',
								'checked' => $lodging_checked,
							);

							echo form_radio($data);
							?> Lodging
						</li>

						<li>
							<label>Active</label>
							<?php echo form_checkbox('is_active', $row->is_active, $row->is_active) ?>
						</li>
						<li>

							<input type="submit" name="update" value="Update" class="buttons"/>
							<input type="submit" name="return" value="Save & Return" class="buttons"/>
							<input type="submit" name="cancel" value="Cancel" class="cancel buttons"/>

						</li>
						<?php echo form_close(); ?>
					</ul>
				</div>
				<i class="note"></i>
				<p style="float:right" ;>
					<?php echo anchor('rate/rate_create/' . $row->rate_plan_id, 'Add New Rate') ?>
				</p>
				<?php endforeach; ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div class="hastable">
					<form name="myform" class="pager-form" method="post" action="">
						<table id="sort-table">
							<thead>
							<tr>
								<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
								           class="submit"/></th>
								<th>Name</th>
								<th>Order</th>
								<th>Description</th>
								<th>Active Y/N</th>
								<th style="width:128px">Options</th>
							</tr>
							</thead>
							<tbody>

							<?php if (isset($rates)) : foreach ($rates as $rate) : ?>
								<tr>
									<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/>
									</td>
									<td><?php echo $rate->name; ?></td>
									<td><?php echo $rate->order; ?></td>
									<td><?php echo $rate->description; ?></td>
									<td><?php if ($rate->is_active) echo 'Yes'; else  echo 'No'; ?></td>

									<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									       title="Edit Rate"
									       href="<?php echo site_url() . 'rate/rate_edit/' . $rate->rate_id . '/' . $row->rate_plan_id ?>">
											<span class="ui-icon ui-icon-wrench"></span> </a>

										<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
										   title="Delete Rate"
										   href="<?php echo site_url() . 'rate/rate_delete/' . $rate->rate_id . '/' . $row->rate_plan_id ?>">
											<span class="ui-icon ui-icon-trash"></span> </a></td>
								</tr>
							<?php endforeach; ?>
							<?php else: ?>
								<?php echo 'No record found' ?>
							<?php endif; ?>
							</tbody>

						</table>
					</form>
					<div class="clear"></div>
					<?php $this->load->view('modules/sidebar') ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
		</body>
		</html>
