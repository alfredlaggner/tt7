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
					<h2><span>REVIEW YOUR CLASS BOOKING</span></h2>
					<?
					$sub_price = 0.00;
					$total_price = 0.00;
					?>
					<div class="title">
						<h2>Students</h2>
					</div>
					<? foreach ($records as $row) : ?>
						<div class="bleft">
							<?
							$sub_price = $row->ledger_price - $row->ledger_discount + $row->ledger_tax;
							$total_price += $sub_price;
							?>
							<h3><?= $row->first_name; ?> <?= $row->last_name; ?> </h3>
						</div>
						<div class="bright">
							<h3>
								<? echo '$' . $sub_price; ?>
								<span><?= 'Regular $' . $row->ledger_price; ?></span></h3>
						</div>
					<? endforeach ?>
					<div class="title">
						<h2>Class</h2>
					</div>
					<div class="bleft">
						<? $i = 1 ?>
						<? foreach ($records as $row) : ?>
						<? if ($i++ == 1) : ?>

						<? $x_first_name = $row->first_name; ?>
						<? $x_last_name = $row->last_name; ?>
						<? $x_address = $row->address1; ?>
						<? $x_city = $row->city; ?>
						<? $x_state = $row->state; ?>
						<? $x_zip = $row->zip; ?>
						<? $x_country = $row->country; ?>
						<? $x_phone = $row->cell; ?>
						<? $x_email = $row->email; ?>
						<? $x_cust_id = $row->customer_id; ?>
						<? $x_ledger_id = $row->ledger_id; ?>
						<? $x_event_id = $row->event_id; ?>
						<? $x_activity_id = $row->activity_id; ?>
						<? $x_location_id = $row->location_id; ?>

						<h3><?= $row->name; ?></h3>
						<h4> On <b><?= date('F jS  Y ', strtotime($row->date)); ?></b> from
							<b><?= date('g:i a', strtotime($row->time)); ?> </b> to
							<b><?= date('g:i a', strtotime($row->time) + $row->duration * 3600); ?></b></h4>
					</div>
					<div class="title">
						<h2></h2>
					</div>
					<div class="bleft">
						<h3>Total</h3>
						<? if ($row->ledger_discount > 0) echo '<p> Your discount is  $' . $row->ledger_discount . ' per student</p>'; ?>
						<? if ($row->ledger_tax > 0) echo '<p> Your tax is  $ ' . $row->ledger_tax . ' per student </p>'; ?>
					</div>
					<div class="bright">
						<h3> <?= '$' . $total_price; ?> </h3>
					</div>
				</div>
			</div>
		</div>
		<div class="right">
			<? if ($total_price) : // show cc only if something to pay for ?>
				<div class="blog">
					<div id="customer_data">


						<?

						if ($error)
							echo "Something went wrong : " . $error;
						// This sample code requires the mhash library for PHP versions older than
						// 5.1.2 - http://hmhash.sourceforge.net/

						// the parameters for the payment can be configured here
						// the API Login ID and Transaction Key must be replaced with valid values

						// test account	
						$testMode = "false";
						$loginID = "75DKLjwjEr3s";
						$transactionKey = "5eK46Ptp68xFH94d";
						$url = "https://test.authorize.net/gateway/transact.dll";

						// real account	
						//	$testMode		= "true";
						//	$loginID		= "2J4dmY37";
						//	$transactionKey = "9BvNLdJ37398ewxm";
						//	$url = "https://secure.authorize.net/gateway/transact.dll";

						// By default, this sample code is designed to post to our test server for
						// developer accounts: https://test.authorize.net/gateway/transact.dll
						// for real accounts (even in test mode), please make sure that you are
						// posting to: https://secure.authorize.net/gateway/transact.dll


						$amount = $total_price;
						$description = $row->name;
						$label = "Submit Payment"; // The is the label on the 'submit' button


						// If an amount or description were posted to this page, the defaults are overidden
						if (array_key_exists("amount", $_REQUEST)) {
							$amount = $_REQUEST["amount"];
						}
						if (array_key_exists("amount", $_REQUEST)) {
							$description = $_REQUEST["description"];
						}

						// an invoice is generated using the date and time
						$invoice = $row->event_group_id /*date('YmdHis')*/
						;
						// a sequence number is randomly generated
						$sequence = rand(1, 1000);
						// a timestamp is generated
						$timeStamp = time();

						// The following lines generate the SIM fingerprint.  PHP versions 5.1.2 and
						// newer have the necessary hmac function built in.  For older versions, it
						// will try to use the mhash library.
						if (phpversion() >= '5.1.2') {
							$fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey);
						} else {
							$fingerprint = bin2hex(mhash(MHASH_MD5, $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey));
						}
						?>

						<!-- Print the Amount and Description to the screen. -->
						<!--						Amount: <?= $amount; ?> <br />
						Description: <?= $description; ?> <br />
-->                        <!-- Create the HTML form containing necessary SIM post values -->
						<form method='post' action='<?= $url; ?>'>
							<!--  Additional fields can be added here as outlined in the SIM integration
guide at: http://developer.authorize.net -->
							<input type='hidden' name='x_login' value='<?= $loginID; ?>'/>
							<input type='hidden' name='x_amount' value='<?= $amount; ?>'/>
							<input type='hidden' name='x_description' value='<?= $description; ?>'/>
							<input type='hidden' name='x_invoice_num' value='<?= $invoice; ?>'/>
							<input type='hidden' name='x_fp_sequence' value='<?= $sequence; ?>'/>
							<input type='hidden' name='x_fp_timestamp' value='<?= $timeStamp; ?>'/>
							<input type='hidden' name='x_fp_hash' value='<?= $fingerprint; ?>'/>
							<input type='hidden' name='x_test_request' value='<?= $testMode; ?>'/>
							<!--								<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
							--> <input type='hidden' name='x_first_name' value='<?= $x_first_name; ?>'/>
							<input type='hidden' name='x_last_name' value='<?= $x_last_name; ?>'/>
							<input type='hidden' name='x_address' value='<?= $x_address; ?>'/>
							<input type='hidden' name='x_city' value='<?= $x_city; ?>'/>
							<input type='hidden' name='x_zip' value='<?= $x_zip; ?>'/>
							<input type='hidden' name='x_cust_id' value='<?= $x_cust_id; ?>'/>
							<input type='hidden' name='x_state' value='<?= $x_state; ?>'/>
							<input type='hidden' name='x_country' value='<?= $x_country; ?>'/>
							<input type='hidden' name='x_phone' value='<?= $x_phone; ?>'/>
							<input type='hidden' name='x_email' value='<?= $x_email; ?>'/>
							<input type='hidden' name='x_ledger_id' value='<?= $x_ledger_id; ?>'/>
							<input type='hidden' name='x_event_id' value='<?= $x_event_id; ?>'/>
							<input type='hidden' name='x_activity_id' value='<?= $x_activity_id; ?>'/>
							<input type='hidden' name='x_location_id' value='<?= $x_location_id; ?>'/>
							<INPUT TYPE=HIDDEN NAME="x_relay_response" VALUE="TRUE">
							<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="<?= site_url() ?>tt/relay_response">
							<!--								<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="https://terramarinfo.fatcow.com/sunnydays/relay_response.php">
							-->
							<fieldset>
								<div>
									<label>Credit Card Number</label>
									<input type="text" class="text required creditcard" size="15" name="x_card_num"
									       value="6011000000000012"></input>
								</div>
								<div>
									<label>Exp.</label>
									<input type="text" class="text required" size="4" name="x_exp_date"
									       value="04/15"></input>
								</div>
								<div>
									<label>CCV</label>
									<input type="text" class="text required" size="4" name="x_card_code"
									       value="782"></input>
								</div>
							</fieldset>
							<input type='submit' value='<?= $label; ?>' class="submit"/>
						</form>
					</div>
				</div>
			<? else : // end if something to pay?>
				<div class="blog">
					<div id="customer_data">
						<h2>Thank you for booking this class with a Groupon discount</h2>
						<p>Please check to see if the data is correct and click confirm.</p>
						<? $attributes = array('id' => 'groupon_booking', 'name' => 'groupon_booking');
						echo form_open('tt/create_booking_groupon/' . $x_ledger_id, $attributes); ?>
						<div id="customer_data">
							<input type="submit" value="CONFIRM" class="submit"/>
						</div>
						</form>

					</div>
				</div>
			<? endif // end if something to pay?>
		</div>        <!--Right-->
	</div>
	<div class="clr"></div>
	<? endif;
	endforeach; ?>
