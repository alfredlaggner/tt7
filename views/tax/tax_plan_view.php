<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		$("#tax_plan").validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				name: {
					required: "Please enter a tax group name",
					minlength: "Minimum length is 3"
				}
			}

		});
	});
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('tax_plan', 'Tax Plan Overview'); ?>
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
						<?php $attributes = array('id' => 'tax_plan'); ?>
						<?php echo form_open('tax/update_tax_plan/' . $row->tax_plan_id, $attributes) ?>
						<ul>
							<input type="hidden" name="tax_plan_id" id="tax_plan_id" class="text"
							       value='<?php echo $row->tax_plan_id; ?>'/>
							<li>
								<label> Name</label>
								<input type="text" name="name" id="name" minlength="3" class="text"
								       value='<?php echo $row->name; ?>'/>
							</li>
							<li>
								<label> Description</label>
								<textarea class="text_area" name="description"
								          id="description"><?php echo $row->description; ?></textarea>
							</li>
							<li>
								<label> Active</label>
								<?php echo form_checkbox('is_active', $row->is_active, $row->is_active) ?>
							</li>
							<li>
								<input type="submit" name="update" value="Update" class="buttons"/>
								<input type="submit" name="return" value="Save & Return" class="buttons"/>
								<input type="submit" name="cancel" value="Cancel" class=" cancel buttons"/>
							</li>
						</ul>
						<?php echo form_close(); ?>
					<?php endforeach; endif ?>
				</div>

				<div class="clear"></div>
				<div class="hastable">
					<?php
					$attributes = array(
						'id' => 'add_taxes',
						'class' => "pager-form",
					);
					echo form_open('tax/add_taxes/' . $row->tax_plan_id, $attributes) ?>
					<table id="sort-table">
						<thead>
						<tr>
							<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
							           class="submit"/></th>
							<th>Name</th>
							<th>Authority</th>
							<th>Amount</th>
							<th>Type</th>
							<th>Exempt</th>
							<th style="width:28px">Options</th>
						</tr>
						</thead>
						<tbody>

						<?php if (isset($taxs)) : foreach ($taxs as $tax) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
								<td><?php echo $tax->name; ?></td>
								<td><?php echo $tax->authority; ?></td>
								<td><?php echo $tax->amount; ?></td>
								<td>
									<?php $data['amount_type'] = $tax->amount_type;
									$this->load->view('modules/amount_type', $data) ?>
								</td>
								<td><?php
									if ($tax->is_exempt) echo 'Yes'; else  echo 'No'; ?>
								</td>
								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
								       title="Remove Tax"
								       href="<?php echo site_url() . 'tax/delete_tax_plan_to_tax/' . $row->tax_plan_id . '/' . $tax->tax_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a></td>
							</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<?php echo 'No record found' ?>
						<?php endif; ?>
						</tbody>
						<input type="submit" name="add_taxes" value="Add Taxes"
						       class="ui-state-default float-right ui-corner-all ui-button"/>

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
