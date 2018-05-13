<style>
	#booking_data h4 {
		font: normal 16px Arial, Helvetica, sans-serif;
		color: #464646;
		padding: 5px;
		margin: 0 0 0px 40px;
	}

	#booking_data h3 {
		font: normal 20px Arial, Helvetica, sans-serif;
		color: #464646;
		padding: 2px;
		margin: 0 0 0 20px;
	}

	#booking_data h2 {
		font: normal 28px Arial, Helvetica, sans-serif;
		color: #464646;
		padding: 5px;
		margin: 0 0 10px 0;
	}

	#booking_data h2 {
		border-bottom-color: #000000;
		border-bottom-style: dotted;
		border-bottom-width: thin;
	}

	#booking_data #total {
		border-top-color: #000000;
		border-top-style: dotted;
		border-top-width: thin;
	}

	#booking_data h2 span {
		color: #9eaf06;
	}

	#booking_data .bleft p {
		color: #4b4b4b;
		font: normal 14px Arial, Helvetica, sans-serif;
		padding: 5px 0;
		margin: 0 0 0 40px;
		line-height: 1.8em;
	}

	#booking_data a {
		color: #9eaf06;
		text-decoration: none;
		font: bold 12px Arial, Helvetica, sans-serif;
	}

	#booking_data ul {
		list-style: disc; /*width:130px; */
		float: left;
		padding: 0;
		margin: 10px 5px;
	}

	#booking_data li {
		padding: 2px 1px;
		margin: 0;
	}

	#booking_data li a {
		color: #9eaf06;
		font: normal 12px Arial, Helvetica, sans-serif;
		text-decoration: underline;
	}

	#booking_data li a:hover {
		color: #4b4b4b;
		text-decoration: none;
	}

	#booking_data .blok {
		width: 30%;
		float: left;
		padding: 15px 11px;
		margin: 0;
	}

	#booking_data .title {
		float: left;
		width: 100%;
		margin: 0;
		padding: 20px 0 0 0;
	}

	#booking_data .bleft {
		float: left;
		width: 60%;
		margin: 0;
		padding: 0 0 0px 0;
	}

	#booking_data .bright {
		float: right;
		width: 40%;
		margin: 0;
		padding: 0 0 0px 0;
	}

	#booking_data h3 span {
		font-size: 9px;
		font-weight: normal
	}
</style>
</head>
<body>
<link href="../../../css/tt/style-greeny.css" rel="stylesheet" type="text/css"/>
<div class="body">
	<div class="body_resize">
		<div class="left">
			<div id="booking_data">
				<div id="customer_data">
					<? foreach ($records AS $row) : ?>
					<h2>Thank you for booking <span><?= $row->name ?></span></h2>
					<div class="title">
						<h2>Booking Details</h2>
						<p>Invoice: <?= $row->invoice_num ?></p>
						<p>Card Number: <?= $row->account_number ?></p>
						<p>Name: <?= $row->first_name . ' ' . $row->last_name ?></p>
						<p>Amount: <?= $row->amount ?></p>
						<p>Authorization Code: <?= $row->auth_code ?></p>

						<? endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="blog"></div>
		</div>
		<!--Right-->
	</div>
	<div class="clr"></div>
