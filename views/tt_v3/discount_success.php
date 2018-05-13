<?= $head ?>
<body>
<?= $header ?>
<style>
	.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
		background-color: #FFFF00;
		color: #FFC0CB;
	}
</style>
<!-- !top-bar -->
<? //=$region_name;  ?>

<div class="container">
	<? foreach ($records AS $row) : ?>
		<div class=row>
			<div class=col-md-12>
				<h1 class="page-title">Thank you for booking!</h1>
			</div>
		</div>
		<div class=row>
			<div class=col-md-6><h4>Activity: <span><?= $row->name ?></span></h4>
				<h4>Location: <span><?= $row->location_name; ?></span></h4>
				<h4> Date/Time: <b>
						<?= date('F jS  Y ', strtotime($row->date)); ?>
					</b> meeting time <b>
						<?= date('g:i a', strtotime($row->time)); ?>
					</b> </h4>
				<div class="line"></div>

				<h3>Booking Details</h3>
				<p>Invoice Number: <?= $row->event_group_id ?></p>
				<p>Promo Code: <?= $row->promo_code ?></p>

				<p>Amount
					Paid: <? if ($row->ledger_price - $row->ledger_discount <= 0) echo '$0.00'; else echo '$' . $row->ledger_price - $row->ledger_discount; ?></p>
				<div class="line"></div>
				<b>Please check your inbox for confirmation email.</b>

			</div>
		</div>
		<? break  // need only 1 record ?>
	<? endforeach ?>
	<? if ($attachments) : ?>
		<hr>
		<h3>Please download these documents</h3>
		<p class="small"> (You can also download them from your confirmation email)</p>
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<? foreach ($attachments AS $row) : ?>
						<li class="small"><a href="<?= $row->file_name ?>"
						                     download="<?= $row->file_name ?>"><?= $row->attachment_name ?></a></li>
					<? endforeach; ?>
				</ul>
			</div>
		</div>
	<? endif ?>
</div>
<?= $footer ?>
</body>

</html>