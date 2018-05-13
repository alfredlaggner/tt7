<?= $head ?>
<style>
	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 3px;
		font-weight: normal;
	}
</style>


<body>
<?= $header ?>

<section class="section" id="section-summary">
	<div class="container">
		<div class=row>
			<div class=col-md-12>
				<h1 class="page-title">Here is the Summary of your Order</h1>
			</div>
		</div>
		<div class="row">


			<div class=col-md-7>
				<? foreach ($records AS $row) : ?>
				<h2>Thank you for booking! <span style="font-style:italic"></span></h2>
				<div class="line"></div>
				<div id="page-content">
					<h4>Activity: <span>
				<?= $row->name ?>
				</span></h4>
					<h4>Location: <span>
				<?= $row->location_name; ?>
				</span></h4>
					<h4> Date/Time: <b>
							<?= date('F jS  Y ', strtotime($row->date)); ?>
						</b> meeting time <b>
							<?= date('g:i a', strtotime($row->time)); ?>
						</b>
						<!-- to <b>
							<?= date('g:i a', strtotime($row->time) + $row->duration * 3600); ?>
						</b> -->
					</h4>
					<div class="line"></div>
					<h3>Booking Details</h3>
					<p>Invoice Number:
						<?= $row->invoice_num ?>
					</p>
					<p>Card Number:
						<?= $row->account_number ?>
					</p>
					<p>Name of Card Holder:
						<?= $row->first_name . ' ' . $row->last_name ?>
					</p>
					<p>Amount Paid:
						<?= $row->amount ?>
					</p>
					<p>Authorization Code:
						<?= $row->auth_code ?>
					</p>
					<div class="line"></div>
					<b>Please check your inbox for confirmation email.</b>
					<? break ?>
					<? endforeach ?>
				</div>
			</div>
		</div>
		<? if ($attachments) : ?>
			<hr>
			<h3>Please download these documents</h3>
			<p class="small"> (You can also download them from your confirmation email)</p>
			<div class="navbar">
				<div class="navbar-inner">
					<ul class="nav">
						<? foreach ($attachments AS $row) : ?>
							<li class="small"><a href="<?= $row->file_name ?>"
							                     download="<?= $row->file_name ?>"><?= $row->attachment_name ?></a>
							</li>
						<? endforeach; ?>
					</ul>
				</div>
			</div>
		<? endif; ?>
	</div>
</section>
<?= $footer ?>

</body>
</html>