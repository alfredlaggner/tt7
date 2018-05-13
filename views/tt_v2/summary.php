<style type="text/css">
	#table-2 {
		border: 1px solid #e3e3e3;
		/*	background-color: #f2f2f2;
		*/
		width: 100%;
		border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
	}

	#table-2 td, #table-2 th {
		padding: 5px;
		color: #333;
	}

	#table-2 thead {
		/*font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; */
		padding: .2em 0 .2em .5em;
		text-align: left;
		color: #4B4B4B;
		/*	background-color: #C8C8C8;
		*/
		background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e3e3e3), color-stop(.6, #B3B3B3));
		background-image: -moz-linear-gradient(top, #D6D6D6, #B0B0B0, #B3B3B3 90%);
		border-bottom: solid 1px #999;
	}

	#table-2 th {
		/*	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; */
		font-size: 16px;
		line-height: 20px;
		font-style: normal;
		font-weight: bold;
		text-align: left;
		text-shadow: white 1px 1px 1px;
		width: 80px;
	}

	#table-2 td {
		line-height: 20px;
		/*	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; */
		font-size: 14px;
		border-bottom: 1px solid #fff;
		border-top: 1px solid #fff;
		width: 80px;
	}

	#table-2 td:hover {
		background-color: #fff;
	}

	.error {
		color: red;
		font-size: 9px;
		position: relative
	}
</style>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/validationEngine.jquery.css" type="text/css"/>

<script type="text/javascript">

	$(document).ready(function () {
		$("#cc_payment").validationEngine('attach',
			{promptPosition: "Right", scroll: true});
	});
	jQuery(function ($) {
		$("#exp").mask("99/99");
		$("#ccv").mask("999");
	});
</script>

<body>

<!-- !top-bar -->
<div id="top-bar">
	<div id="top-bar-content"><?= $region_name ?> </div>
</div>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<? $this->load->view('tt_v2/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<div id="page" class="sg-22">

			<h1>Here is the Summary of your Order </h1>

			<div class="line"></div>

			<?
			$i = 1;
			$total_price = 0.00;
			$sub_price = 0.00;
			?>

			<? if (isset($records)) : foreach ($records as $row) : ?>

			<table id="table-2" width="200" border="1">
				<?
				//print_r($records);


				$sub_price = $row->ledger_price;
				$sub_price = $sub_price < 0 ? 0 : $sub_price;

				$total_price += $sub_price;
				?>
				<? if ($i++ == 1): // title only once ?>
					<h3>
						<?= $row->name; ?>
					</h3>
					<h4> Location: <?= $row->location_name; ?></h4>
					<h4> On <b>
							<?= date('F jS  Y ', strtotime($row->date)); ?>
						</b> from <b>
							<?= date('g:i a', strtotime($row->time)); ?>
						</b> to <b>
							<?= date('g:i a', strtotime($row->time) + $row->activity_duration * 3600); ?>
						</b></h4>
					<h4>&nbsp;</h4>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Price</th>
					</tr>
					<?
					$ledger_discount = $row->ledger_discount;
					$ledger_tax = $row->ledger_tax;
					$discount_type = $row->discount_amount_type;
					?>

				<? endif ?>
				<tbody>
				<tr>
					<td><?= $row->first_name; ?></td>
					<td><?= $row->last_name; ?></td>
					<td><?= '$' . str_pad($sub_price, 6, ' ', STR_PAD_LEFT); ?></td>
				</tr>


				<!-- !PAGE-CONTENT-END -->
				<? endforeach;
				endif ?>
				</tbody>
				<? if ($ledger_discount > 0) : ?>
					</tr>
					<tr>
						<td>Discount</td>
						<td>
							<? echo '<p>(Promo code ' . $row->promo_code . ')</p>'; ?>
						</td>
						<td>
							<? if ($discount_type == DISCOUNT_FIXED_AMOUNT) : ?>

								<?= '$' . number_format($ledger_discount * -1, 2); ?>
								<? $total_price = $total_price - $ledger_discount; ?>

							<? else : ?>
								<?= number_format($ledger_discount * -1, 2) . '%'; ?>
								<? $total_price = $total_price - ($total_price / 100 * $ledger_discount) ?>
							<? endif ?>
						</td>
					</tr>
				<? endif ?>
				<? if ($ledger_tax > 0) : ?>
					<? $total_price = $total_price - $ledger_tax ?>
					</tr>
					<tr>
						<td>Tax</td>
						<td>
						</td>
						<td>
							<?= '$' . number_format($ledger_tax * -1, 2); ?>
						</td>
					</tr>
				<? endif ?>
				<tr>
					<td>Total Price</td>
					<td></td>
					<td>
						<bold><?= '$' . number_format($total_price, 2); ?></bold>
					</td>
				</tr>

			</table>
			<? if ($row->promo_code) : ?>
				<? if ($row->exp_discount_price == 0) : ?>
					<h4 style="color: red">If a scheduling conflict arises and you need to reschedule, we are happy to
						reactivate your voucher. If a reschedule is requested within 10 days prior to your class, a fee
						will apply. (Rock climbing $25, backpacking $45) </h4>
				<? else : ?>
					<h4 style="color: red; padding-top:15px;">Your voucher is expired. Nevertheless you can still attend
						the class for a small fee.</h4>
				<? endif ?>
			<? endif ?>

			<? $i = 1 ?>
			<? if (isset($records)) : foreach ($records as $row) : ?>
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
			<? $x_promo_code = $row->promo_code; ?>


		</div>
		<? if ($total_price > 0) : // show cc only if something to pay for ?>

			<div class="sg-10">
				<div class="sg-10 line"></div>
				<h1>&nbsp;<br><br></h1><br>
				<? if ($error) : ?>
					<p style="color:#F00">  <?= $error_text; ?> </p>
					<h3 class="sub-title">
						Please enter your correct card information </h3>
				<? else : ?>
					<h3 class="sub-title" style="color:green">
						Please enter your credit card information </h3>
				<? endif ?>

				<div id="customer_data">
					<?

					// This sample code requires the mhash library for PHP versions older than
					// 5.1.2 - http://hmhash.sourceforge.net/

					// the parameters for the payment can be configured here
					// the API Login ID and Transaction Key must be replaced with valid values

					// test account	
					//	$testMode		= "false";
					//	$loginID		= "75DKLjwjEr3s";
					//	$transactionKey = "9H6r9sx5pV98T8tk";
					//	$url = "https://test.authorize.net/gateway/transact.dll";

					//real account	
					$testMode = "false";
					$loginID = "2J4dmY37";
					$transactionKey = "546Uq6F37Qf2xQ79";
					$url = "https://secure.authorize.net/gateway/transact.dll";

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
					<?
					//echo " loginID " . $loginID;
					//echo " sequence " .$sequence;
					//echo " timeStamp " .$timeStamp;
					//echo " amount " .$amount;
					//echo " transactionKey " .$transactionKey;
					//echo  " fingerprint " .$fingerprint;
					//die;
					?>
					<!-- Print the Amount and Description to the screen. -->
					<!--						Amount: <?= $amount; ?> <br />
						Description: <?= $description; ?> <br />
--> <!-- Create the HTML form containing necessary SIM post values -->
					<form id="cc_payment" method='post' action='<?= $url; ?>'>
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
			-->
						<input type='hidden' name='x_first_name' value='<?= $x_first_name; ?>'/>
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
						<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="<?= site_url() ?>tt_v2/relay_response">
						<!--								<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="https://terramarinfo.fatcow.com/sunnydays/relay_response.php">
			-->
						<fieldset>
							<ul>
								<li>
									<label>Credit Card Number</label>
									<input id="creditcard" type="text" class="validate[required,creditCard] text "
									       size="16" name="x_card_num" value=""><!--6011000000000012-->
									</input>
								</li>
								<li>
									<label>Exp.(mm/yy)</label>
									<input id="exp" type="text" class="text validate[required]" size="4"
									       name="x_exp_date" value="">
									</input>
								</li>
								<li>
									<label>CCV</label>
									<input id="ccv" type="text" class="text validate[required]" size="4"
									       name="x_card_code" value=""><!--782-->
									</input>
						</fieldset>
						<input type='submit' value='<?= $label; ?>' class="submit"/>
						</li>
						</ul>
					</form>
				</div>
			</div>
		<? else : // end if not something to pay ?>
		<div class="sg-15">
			<div id="customer_data">
				<? if ($row->promo_code) : ?>
					<? if ($row->exp_discount_price > 0) : ?>
						<h4 style="color: red">Your voucher is expired. Nevertheless you can still attend the class for
							a very small fee.</h4>
					<? endif ?>
				<? endif ?>
				<p><strong>Please review your booking and click confirm to continue!<strong></p>

				<? $attributes = array('id' => 'groupon_booking', 'name' => 'groupon_booking');
				echo form_open('tt_v2/create_booking_with_discount/' . $x_ledger_id . '/' . $row->event_group_id, $attributes); ?>

				<div class="sg-30">

					<div id="customer_data" style="float:right">
						<input type="submit" value="CONFIRM" class="submit"/>
					</div>
					</form>
				</div>
			</div>
			<!---->
			<? endif // end if something to pay?>
			<? endif;
			endforeach;
			endif ?>

			<!-- !line -->
			<div class="sg-35 line"></div>

			<? $this->load->view('tt_v2/blocks/footer'); ?>
			<a href="#"
			   onclick="window.open('https://www.sitelock.com/verify.php?site=treksandtracks.com','SiteLock','width=600,height=600,left=160,top=170');"><img
					alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/trecksandtracks.com"/></a>
</body>
</html>