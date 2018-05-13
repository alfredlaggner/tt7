<?php $this->load->view('modules/head') ?>

<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="content-box">
				<div class="response-msg inf ui-corner-all"> <span>
					<h2><?php echo $title_action ?></h2>
						<?php if (isset($records)) : foreach ($records as $row) : ?>
					</span>Customer <b><?php echo $row->first_name . ' ' . $row->last_name ?> </b>and all their
					information will be permanently deleted.
				</div>
				<?php $attributes = array('id' => 'customer'); ?>
				<?php echo form_open('customer/delete/' . $row->customer_id, $attributes); ?>
				<ul>
					<li>
						<input type="submit" name="delete" value="Delete" class="buttons"/>
						<input type="submit" name="cancel" id="cancel" value="Cancel" class="cancel buttons"/>
					</li>
				</ul>
				<?php echo form_close(); ?> </div>
			<?php endforeach; ?>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>
</body></html>