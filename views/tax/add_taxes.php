<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>

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
				<span>Check the taxes you would like to add to tax group <?php echo $tax_plan_name ?> then click  'Add Taxes'.</span>
			</div>
			<div class="hastable">
				<?php
				$attributes = array(
					'id' => 'add_taxes',
					'class' => "pager-form",
				);
				echo form_open('tax/add_tax_plan_to_tax/' . $tax_plan_id . '/' . $tax_count, $attributes) ?>

				<!--				<table id="sort-table">
				-->
				<table>
					<thead>
					<tr>
						<th><input id="tax_add_submit" name="tax_add_submit" type="checkbox" value="check_none"
						           onclick="this.value=check(this.form.list)" class="submit"/></th>
						<th>Name</th>
						<th>Authority</th>
						<th>Type</th>
						<th>Amount</th>
						<th>Exempt</th>
					</tr>
					</thead>
					<tbody>
					<?php $i = 0;
					if (isset($records)) : foreach ($records as $row) : ?>
						<?php $i++; ?>
						<tr>
							<td class="center"><input type="checkbox" id="tax_add<?php echo $i ?>"
							                          name="tax_add<?php echo $i ?>" value="1" class="checkbox"/></td>

							<input type="hidden" id="tax_id<?php echo $i ?>" name="tax_id<?php echo $i ?>"
							       value="<?php echo $row->tax_id; ?>"/>

							<td><?php echo $row->name; ?></td>
							<td><?php echo $row->authority; ?></td>
							<td><?php echo $row->amount; ?></td>
							<td>
								<?php $data['amount_type'] = $row->amount_type;
								$this->load->view('modules/amount_type', $data) ?>
							</td>
							<td><?php
								if ($row->is_exempt) echo 'Yes'; else  echo 'No'; ?>
							</td>
						</tr>
					<?php endforeach; endif; ?>
					</tbody>
					<input type="submit" name="add_taxes" value="Add Taxes"
					       class="ui-state-default float-right ui-corner-all ui-button"/>
				</table>
				</form>
				<div class="clear"></div>
				<?php $this->load->view('modules/sidebar') ?>
			</div>
		</div>
		<?php $this->load->view('modules/footer') ?>
	</div>
	</body>
	</html>
