<!DOCTYPE HTML>
<html lang="en-US">
<body>

<!-- !top-bar -->
<?= $region_name ?>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<? $this->load->view('tt_v2/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<div id="page" class="sg-35">
			<? foreach ($records AS $row) : ?>

			<h2>Thank you for booking! <span style="font-style:italic"></span></h2>
			<div class="line"></div>

			<div id="page-content">
				<h4>Activity: <span><?= $row->name ?></span></h4>
				<h4>Location: <span><?= $row->location_name; ?></span></h4>
				<h4> Date/Time: <b>
						<?= date('F jS  Y ', strtotime($row->date)); ?>
					</b> from <b>
						<?= date('g:i a', strtotime($row->time)); ?>
					</b> to <b>
						<?= date('g:i a', strtotime($row->time) + $row->duration * 3600); ?>
					</b></h4>
				<div class="line"></div>

				<h3>Booking Details</h3>
				<p>Invoice Number: <?= $row->event_group_id ?></p>
				<p>Promo Code: <?= $row->promo_code ?></p>

				<p>Amount
					Paid: <? if ($row->ledger_price - $row->ledger_discount <= 0) echo '$0.00'; else echo '$' . $row->ledger_price - $row->ledger_discount; ?></p>
				<div class="line"></div>
				<b>Please check your inbox for confirmation email.</b>

				<? break  // need only 1 record ?>
				<? endforeach ?>

			</div>

			<!-- !PAGE-CONTENT-END -->

			<!-- !line -->
			<div class="sg-35 line"></div>


		</div>
	</div>
	<? $this->load->view('tt_v2/blocks/footer'); ?>

</body>
<!-- Google Code for Course Booking Conversion Page -->
<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 985272587;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "_QgHCK3t2QUQi6Lo1QM";
	var google_conversion_value = 0;
	/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
	<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt=""
		     src="//www.googleadservices.com/pagead/conversion/985272587/?value=0&amp;label=_QgHCK3t2QUQi6Lo1QM&amp;guid=ON&amp;script=0"/>
	</div>
</noscript>
</html>