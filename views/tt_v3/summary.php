<?= $head ?>
<style>
	label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 3px;
		font-weight: normal;
	}
</style>

<!--<link rel="stylesheet" href="<? /*= base_url() */ ?>css/validationEngine.jquery.css" type="text/css"/>

<script type="text/javascript">

    $(document).ready(function () {
        $("#cc_payment").validationEngine('attach',
            {promptPosition: "Right", scroll: true});
    });
    jQuery(function ($) {
        $("#exp").mask("99/99");
        $("#ccv").mask("999");
    });
</script>-->

<body>
<!--<style type="text/css">
    #table-2 {
        border: 1px solid #e3e3e3;
        /*	background-color: #f2f2f2;
        */        width: 100%;
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
        */	background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e3e3e3), color-stop(.6,#B3B3B3));
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
        width:80px;
    }
    #table-2 td {
        line-height: 20px;
        /*	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; */
        font-size: 14px;
        border-bottom: 1px solid #fff;
        border-top: 1px solid #fff;
        width:80px;
    }
    #table-2 td:hover {
        background-color: #fff;
    }
    .error   { color: red; font-size:9px; position:relative}
</style>-->
<?= $header ?>
<!--<script>
    $(document).ready(function() {
        $('#registerForm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                password: {
                    validators: {
                        identical: {
                            field: 'confirmPassword',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        });
    });
</script>-->
<section class="section" id="section-summary">
	<div class="container">
		<div class=row>
			<div class=col-md-12>
				<h1 class="page-title">Here is the Summary of your Order</h1>
			</div>
		</div>
		<div class=row>
			<div class=col-md-5>
				<!-- !PAGE-CONTENT -->
				<?
				$i = 1;
				$total_price = 0.00;
				$sub_price = 0.00;
				?>

				<? if (isset($records)) : foreach ($records as $row) : ?>


				<div class="row">
					<div class="col-md-12">

						<table id="table-2" class="table  table-hover">

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

								<tr class="active">
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

								<tr>
									<td>Tax</td>
									<td>
									</td>
									<td>
										<?= '$' . number_format($ledger_tax * -1, 2); ?>
									</td>
								</tr>
							<? endif ?>
							</tbody>
							<tfoot>
							<tr>
								<td>You will be charged</td>
								<td></td>
								<td>
									<b><?= '$' . number_format($total_price, 2); ?></b>
								</td>
							</tr>
							</tfoot>

						</table>
					</div>
				</div>
			</div>
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-6">
				<? if ($row->promo_code) : ?>
					<? if ($row->exp_discount_price == 0) : ?>
						<h4 style="color: red">If a scheduling conflict arises and you need to reschedule, we are happy
							to
							reactivate your voucher. If a reschedule is requested within 10 days prior to your class, a
							fee
							will apply. (Rock climbing $25, backpacking $45) </h4>
					<? else : ?>
						<h4 style="color: red; padding-top:15px;">Your voucher is expired. Nevertheless you can still
							attend
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


						<? if ($total_price > 0) : // show cc only if something to pay for     ?>


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

								<form id="cc_payment" role="form" data-toggle="validator" method='post'
								      action='<?= $url; ?>'>
									<!--  Additional fields can be added here as outlined in the SIM integration
						 guide at: http://developer.authorize.net -->
									<input type='hidden' name='x_login' value='<?= $loginID; ?>'/>
									<input type='hidden' name='x_amount' value='<?= round($amount,2); ?>'/>
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
									<INPUT TYPE='hidden' NAME="x_relay_response" VALUE="TRUE">
									<INPUT TYPE='hidden' NAME="x_relay_url"
									       VALUE="<?= site_url() ?>tt_v3/relay_response">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_first_name">First</label>
												<input type='text' placeholder="First Name"
												       class="form-control"
												       id='x_first_name' id="x_first_name" name='x_first_name'
												       value='<?= $x_first_name; ?>'
												       required
												/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="col-md-6">

											<div class="form-group">
												<label for="x_last_name">Last</label>
												<input type='text' placeholder="Last Name"
												       class="form-control"
												       id='x_last_name' id="x_last_name" name='x_last_name'
												       value='<?= $x_last_name; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_address">Address</label>
												<input type='text' placeholder="Address"
												       class="form-control"
												       id='x_address' id="x_address" name='x_address'
												       value='<?= $x_address; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_city">City</label>
												<input type='text' placeholder="City"
												       class="form-control"
												       id='x_city' id="x_city" name='x_city'
												       value='<?= $x_city; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="x_zip">Zip</label>
												<input type='text' placeholder="Zip"
												       class="form-control"
												       id='x_zip' id="x_zip" name='x_zip'
												       value='<?= $x_zip; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_state">State</label>
												<input type='text' placeholder="State"
												       class="form-control"
												       id='x_state' id="x_state" name='x_state'
												       value='<?= $x_state; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="x_country">Country</label>
												<input type='text' placeholder="Country"
												       class="form-control"
												       id='x_country' id="x_country" name='x_country'
												       value='<?= $x_country; ?>' required
												"/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>

									<!--									6011000000000012-->
									<h4 class="sub-title" style="color:green">
										Card Information <span><img class="ximg-fluid"
										                            src="<?= site_url() ?>images/visa_mastercard.png"
										                            alt="Only Visa or Mastercard" width="100px"></span>
									</h4>


									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_card_num">Credit Card</label>
												<input type='text' placeholder="Credit Card Number"
												       class="form-control"
												       id='x_card_num' name='x_card_num'
												       value='' required
												/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_exp_date">EXP</label>
												<input type='text' placeholder="MM/YYYY"
												       class="form-control" id="x_exp_date"
												       name="x_exp_date"
												       value='' required/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="x_card_code">CCV</label>
												<input type='text' placeholder="CCV"
												       class=" form-control" id="x_card_code"
												       name='x_card_code'
												       value=''
												       required/>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									</div>
									<div class="row" style="margin-top: 2em">
										<div class="col-md-6  col-md-push-6">
											<div class="form-group">
												<button type="submit"
												        class="btn btn-primary btn-sm btn-fill"><?= $label; ?></button>
											</div>
											<!--                                            <input class="btn" type="submit" value="">-->
										</div>
									</div>
								</form>

							</div>

						<? else : // end if not something to pay           ?>
							<div class="sg-15">
							<div id="customer_data">
								<? if ($row->promo_code) : ?>
									<? if ($row->exp_discount_price > 0) : ?>
										<h4 style="color: red">Your voucher is expired. Nevertheless you can still
											attend the class
											for
											a very small fee.</h4>
									<? endif ?>
								<? endif ?>
								<p><strong>Please review your booking and click confirm to continue!<strong></p>

								<? $attributes = array('id' => 'groupon_booking', 'name' => 'groupon_booking');
								echo form_open('tt_v3/create_booking_with_discount/' . $x_ledger_id . '/' . $row->event_group_id, $attributes); ?>

								<div class="sg-30">

									<div id="customer_data" style="float:right">
										<input type="submit" value="CONFIRM" class="submit"/>
									</div>
									</form>
								</div>
							</div>
							<!---->
						<? endif // end if something to pay?>
						</div>
					<? endif;
				endforeach;
				endif ?>


			</div>


			<!-- !PAGE-CONTENT-END -->
		</div>
	</div>
</section>
<?= $footer ?>


<!--<script type="text/javascript" src="--><? //= base_url() ?><!--js_tt/jquery.validationEngine-en.js"></script>-->
<!--<script type="text/javascript" src="--><? //= base_url() ?><!--js_tt/jquery.validationEngine.js"></script>-->
<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.min.js"></script>
<script>
	$(document).ready(function () {
		$('#cc_payment').bootstrapValidator({
			framework: 'bootstrap',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				x_exp_date: {
					validators: {
						callback: {
							message: 'Wrong date',
							callback: function (value, validator) {

								var sections = value.split('/');

								if (sections.length !== 2) {
									return false;
								}

								var year = parseInt(sections[1], 10),
									month = parseInt(sections[0], 10),
									currentMonth = new Date().getMonth() + 1,
									currentYear = new Date().getFullYear();

								if (month <= 0 || month > 12 || year > currentYear + 10) {
									return false;
								}

								if (year < currentYear || (year == currentYear && month < currentMonth)) {
									return false;
								}
								return true;
							}
						}
					}
				},
				x_card_num: {
					validators: {
						creditCard: {
							message: 'The credit card number is not valid'
						}
					}
				},
				x_card_code: {
					validators: {
						cvv: {
							creditCardField: 'x_card_num',
							message: 'The cvv is not valid'
						}
					}
				}
			}
		});
		/*             $("#x_exp_date").mask("99/9999");
		 $("#x_card_code").mask("999");
		 $("#x_card_num").mask("9999 9999 9999 9999");*/
	});

</script>
</body>
</html>