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
				<span>&nbsp;</span>
				<p style="float:right" ;>
					<?php echo anchor('tax/tax_create', 'Create New Tax') ?>
				</p>
			</div>
			<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
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
							<th style="width:128px">Options</th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($records)) : foreach ($records as $row) : ?>
							<tr>
								<td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td>
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
								<td><a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="Edit Tax"
								       href="<?php echo site_url() . 'tax/tax_edit/' ?><?php echo $row->tax_id; ?>">
										<span class="ui-icon ui-icon-wrench"></span> </a>

									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip confirmClick"
									   title="Delete Tax"
									   href="<?php echo site_url() . 'tax/tax_delete/' ?><?php echo $row->tax_id ?>">
										<span class="ui-icon ui-icon-trash"></span> </a>

								</td>
							</tr>
						<?php endforeach; endif; ?>
						</tbody>
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
