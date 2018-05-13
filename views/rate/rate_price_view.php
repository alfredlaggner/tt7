<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$().ready(function () {
		// validate signup form on keyup and submit
		$("#rate").validate({
			rules: {
				price: {
					number: true
				},
				price_weekend: {
					number: true
				},
				weekend_days: {
					number: true,
					minlength: 7
				}
			},
			messages: {
				price: {
					number: "Must be a number"
				},
				price_weekend: {
					number: "Must be a number"
				},
				weekend_days: {
					number: "Must be a number",
					minlength: "Must be 7 digits. One for each weekday. "
				}
			}
		});
	});

</script>
<!--<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.3.2.js"></script>
-->
<link href="<?php echo base_url() ?>css/ui/ui.datepicker.css" rel="stylesheet" media="all"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/ui/ui.datepicker.js"></script>
<script type="text/javascript">
	//	$(function() {
	//		$('xxeffective_date').datepicker({
	//			changeMonth: true,
	//			changeYear: true,
	//		});
	//	});

	$(function () {
		$('#effective_date').datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeYear: true
//			showAnim: 'fold'
//			showButtonPanel: true
		});
//		$('#effective_date').datepicker( "option", "showAnim", 'fold' );
	});
</script>


<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span><a href="#" title="Home">Home</a> > <a href="#"
		                                             title="Dashboard">Dashboard</a> > <?php echo anchor('rate', 'Rate Price Overview'); ?>
			> <?php echo $title_action ?></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>Rate for : <?php echo $activity_name ?> </span></div>
			<div class="content-box">
				<?php if (isset($records)) : foreach ($records as $row) : ?>
					<div id="inputform"> <?php $attributes = array('id' => 'rate');
						echo form_open('activity_rate/update_rate_price/' . $row->rate_price_id . '/' . $activity_id, $attributes); ?>
						<table>
							<td><input type="hidden" name="activity_id" id="activity_id"
							           value='<?php echo $row->activity_id ?>'/></td>
							<tr>
							<tr>
								<td>Effective Date</td>
								<td><input type="text" name="effective_date" id="effective_date" class="text"
								           value='<?php echo $row->effective_date ?>'/></td>
							</tr>
							<td>Wholesale Price</td>
							<td><input type="text" name="wholesale_price" id="wholesale_price" class="text"
							           value='<?php echo $row->wholesale_price ?>'/></td>
							</tr>
							</tr>
							<td>Price</td>
							<td><input type="text" name="price" id="price" class="text"
							           value='<?php echo $row->price ?>'/></td>
							</tr>
							<tr>
								<td>Expired Discount Price</td>
								<td><input type="text" name="exp_discount_price" id="exp_discount_price" class="text"
								           value='<?php echo $row->exp_discount_price ?>'/> />
								</td>
							</tr>
							<tr>
								<td>Weekend Price</td>
								<td><input type="text" name="price_weekend" id="price_weekend" class="text"
								           value='<?php echo $row->price_weekend ?>'/></td>
							</tr>

							<tr>
								<td>Weekend Days</td>
								<td><?php foreach ($week_end_days as $day) :

										$data = array(
											'name' => $day['day_name'],
											'id' => $day['day_name'],
											'value' => '0',
											'checked' => $day['day_selected'],
										);
										echo form_checkbox($data);
										echo $day['day'] ?>
									<?php endforeach; ?></td>
							</tr>


							<tr>
								<td>
									<input type="submit" name="update" value="Save" class="buttons"/>
									<input type="submit" name="return" value="Save & Return" class="buttons"/>
									<input type="submit" name="cancel" value="Cancel" class="buttons"/></td>
							</tr>
						</table>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>

				<?php echo form_close(); ?> </div>
			<div class="clearfix"></div>
			<!--			<i class="note">* To see more boxes examples, like the ones above, visit for the menu, the Layout Options pages.</i>
			--> <?php $this->load->view('modules/sidebar') ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php //$this->load->view('modules/footer') ?>
</body></html>