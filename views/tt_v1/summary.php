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
		<? $this->load->view('tt_v1/blocks/header'); ?>

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

				//	print_r2($records);	
				$sub_price = $row->ledger_price;
				$sub_price = $sub_price < 0 ? 0 : $sub_price;

				if ($row->discount_amount_type == FIXED_AMOUNT) $sub_price = $row->ledger_discount; // 12-30-2015

				$total_price += $sub_price;
				?>

				<? if ($i++ == 1): // title only once ?>
					<h3>
						<?= $row->name; ?>
					</h3>
					<h4> Location: <?= $row->location_name; ?></h4>
					<h4> On <b>
							<?= date('F jS  Y ', strtotime($row->date)); ?>
						</b> at <b>
							<?= date('g:i a', strtotime($row->time)); ?>
						</b> for <b>
							<?= $row->activity_duration . ' ' . $row->duration_text; ?>
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

							<? elseif ($discount_type != FIXED_AMOUNT) : ?>

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
				<!--<h1>&nbsp;<br><br></h1><br>-->
				<? if ($error) : ?>
					<p style="color:#F00">  <?= $error_text; ?> </p>
					<h3 class="sub-title">
						Please enter your correct card information </h3>
				<? else : ?>
					<h3 class="sub-title" style="color:green">
						Credit card information </h3>
				<? endif ?>
				<h4 class="sub-title" style="color:green">
					Billing Address </h4>
				<div id="customer_data">
					<?

					// This sample code requires the mhash library for PHP versions older than
					// 5.1.2 - http://hmhash.sourceforge.net/

					// the parameters for the payment can be configured here
					// the API Login ID and Transaction Key must be replaced with valid values

					// test account	
					//$testMode		= "false";
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
						<!--<input type='hidden' name='x_first_name' value='<?= $x_first_name; ?>' />
			<input type='hidden' name='x_last_name' value='<?= $x_last_name; ?>' />
			<input type='hidden' name='x_address' value='<?= $x_address; ?>' />
			<input type='hidden' name='x_city' value='<?= $x_city; ?>' />
			<input type='hidden' name='x_zip' value='<?= $x_zip; ?>' />-->

						<input type='hidden' name='x_cust_id' value='<?= $x_cust_id; ?>'/>
						<!--<input type='hidden' name='x_state' value='<?= $x_state; ?>' />
			<input type='hidden' name='x_country' value='<?= $x_country; ?>' />
			<input type='hidden' name='x_phone' value='<?= $x_phone; ?>' />-->
						<input type='hidden' name='x_email' value='<?= $x_email; ?>'/>
						<input type='hidden' name='x_ledger_id' value='<?= $x_ledger_id; ?>'/>
						<input type='hidden' name='x_event_id' value='<?= $x_event_id; ?>'/>
						<input type='hidden' name='x_activity_id' value='<?= $x_activity_id; ?>'/>
						<input type='hidden' name='x_location_id' value='<?= $x_location_id; ?>'/>
						<INPUT TYPE=HIDDEN NAME="x_relay_response" VALUE="TRUE">
						<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="<?= site_url() ?>tt_v1/relay_response">
						<!--								<INPUT TYPE=HIDDEN NAME="x_relay_url" VALUE="https://terramarinfo.fatcow.com/sunnydays/relay_response.php">
			-->
						<fieldset>
							<table>

								<tr>
									<td>
										<label>First</label>
										<input type='text' class="text validate[required,x_first_name] "
										       id='x_first_name' name='x_first_name' size="20"
										       value='<?= $x_first_name; ?>'/>
									</td>
									<td>
										<label>Last</label>
										<input type='text' class="text validate[required,x_last_name] " id='x_last_name'
										       name='x_last_name' size="20" value='<?= $x_last_name; ?>'/>
									</td>
								</tr>

								<tr>
									<td>
										<label>Address</label>
										<input type='text' class="text  validate[required,x_address] " id='x_address'
										       name='x_address' size="20" value='<?= $x_address; ?>'/>
									</td>
								</tr>
								<tr>
									<td>
										<label>City</label>
										<input type='text' class="text  validate[required,x_city] " id='x_city'
										       name='x_city' size="20" value='<?= $x_city; ?>'/>
									</td>
									<td>

										<label>Zip</label>
										<input type='text' class="text  validate[required,x_zip] " id='x_zip'
										       name='x_zip' size="4" value='<?= $x_zip; ?>'/>
									</td>
								</tr>

								<tr>
									<td>

										<label>State</label>
										<input type='text' class="text  validate[required,x_state] " id='x_state'
										       name='x_state' size="2" value='<?= $x_state; ?>'/>
									</td>


									<td>
										<label>Country</label>
										<input type='text' class="text" id='x_country' name='x_country'
										       value='<?= $x_country; ?>'/>
									</td>
								</tr>
							</table>
						</fieldset>

						<h4 class="sub-title" style="color:green">
							Card Information </h4>
						<table>
							<fieldset>
								<tr>
									<td>
										<label>Credit Card Number 6011000000000012</label>
										<input id="creditcard" type="text" class="validate[required,creditCard] text "
										       size="16" name="x_card_num" value=""><!--6011000000000012-->
										</input>
									</td>
									<td>
										<label>Exp</label>
										<input id="exp" type="text" class="text validate[required]" size="4"
										       name="x_exp_date" value="">
										</input>
									</td>
									<td>
										<label>CCV</label>
										<input id="ccv" type="text" class="text validate[required]" size="4"
										       name="x_card_code" value=""><!--782-->
										</input>
									</td>
								</tr>
							</fieldset>
							<tr>

								<td>
									</fieldset>
									<input type='submit' value='<?= $label; ?>' class="submit"/>
								</td>
							</tr>
						</table>
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
				echo form_open('tt_v1/create_booking_with_discount/' . $x_ledger_id . '/' . $row->event_group_id, $attributes); ?>

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

			<? $this->load->view('tt_v1/blocks/footer'); ?>
			<div id="sitelock_shield_logo" class="fixed_btm"
			     style="bottom:0;position:fixed;_position:absolute;right:0;"><a
					href="https://www.sitelock.com/verify.php?site=www.treksandtracks.com"
					onclick="window.open('https://www.sitelock.com/verify.php?site=www.treksandtracks.com','SiteLock','width=600,height=600,left=160,top=170');return false;"><img
						alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/www.treksandtracks.com"></a>
			</div>
</body>
</html>