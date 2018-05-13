<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/validationEngine.jquery.css" type="text/css"/>


<script type="text/javascript">
	$(document).ready(function () {
		$("#ledger").validationEngine('attach',
			{promptPosition: "topRight", scroll: true});
	});
	jQuery(function ($) {
		$("#exp").mask("99/99");
		$("#ccv").mask("999");
	});
</script>

<body>

<!-- !top-bar -->
<?= $region_name ?>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<!-- !header -->
		<? $this->load->view('tt_v2/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<div id="page" class="sg-35">

			<h1>Enter Student Information</h1>
			<div class="line"></div>

			<div id="page-content">
				<? for ($i = 1; $i <= $nr_of_students; $i++) : ?>
					<script>
						jQuery(function ($) {
							$("#cell<?= $i ?>").mask("(999) 999-9999");
							$("#emergency_phone<?= $i ?>").mask("(999) 999-9999");
						});
					</script>
					<div id="customer_data">
						<div class="clr"></div>
						<? if ($i == 1) : ?>
							<h2><span>STUDENT </span>
							<? if ($nr_of_students > 1) : ?>
								Primary Contact</h2>
							<? else : ?>
								</h2>
							<? endif ?>
						<? else : ?>
							<hr/>
							<h2><span>STUDENT </span>
								<? if ($error) echo "Something went wrong : " . $error; ?>
								<?= $i ?></h2>
						<? endif ?>
						<? if ($i == 1) : ?>
							<? $attributes = array('id' => 'ledger', 'name' => 'ledger');

							echo form_open('tt_v2/create_booking', $attributes); ?>
							<? if (isset($events)) : foreach ($events as $event) : ?>
								<input type="hidden" name="event_id" value="<?= $event_id ?>">
								<?= form_hidden('nr_of_students', $nr_of_students); ?>
								<input type="hidden" name="promo_code" class="text" value="<?= $promo_code ?>">
								<input type="hidden" name="location_id" value="<?= $location_id ?>">
								<input type="hidden" name="activity_id" id="activity_id"
								       value='<?= $event['activity_id'] ?>'/>
								<input type="hidden" name="booking_date" id="booking_date"
								       value='<?= date("Y-m-d g:i:s") ?>'/>
								<input type="hidden" name="name" id="name" class="text" readonly="readonly" value=''/>
								<input type="hidden" name="date" id="date" class="text" readonly
								       value='<? echo $event['event_date'] ?>'/>
								<input type="hidden" name="time" id="time" class="text" readonly
								       value='<?= $event['event_time'] ?>'/>
								<input type="hidden" name="duration" id="duration" class="text" readonly
								       value='<? echo $event['duration'] ?>'/>
								<input type="hidden" name="instructor" id="instructor" class="text" readonly value='
							<? $event['instructor'] = $this->event_to_employee_model->get_employee_string($event['event_event_id']);
								echo $event['instructor'] ?>'/>
								<input type="hidden" name="price" id="price" class="text" readonly
								       value='<? echo $event['rate_price'] ?>'/>
								<input type="hidden" name="exp_discount_price" id="exp_discount_price" class="text"
								       readonly value='<? echo $event['exp_discount_price'] ?>'/>
								<input type="hidden" name="discount" id="discount" class="text" readonly
								       value='<?= $event['discount'] ?>'/>
								<input type="hidden" name="tax" id="tax" class="text" readonly
								       value='<?= $event['tax'] ?>'/>
								<input type="hidden" name="available" id="available" class="text" readonly
								       value='<?= $event['available']; ?>'/>
								<input type="hidden" name="attending" id="attending" class="text" readonly
								       value='<?= $event['attending']; ?>'/>
							<? endforeach ?>
							<? else : ?>
								<?= "no events delivered!" ?>
							<? endif ?>
						<? endif ?>
						<div id="left"> <!--inside the input area-->
							<!--				<fieldset>
							-->
							<? if ($i == 1) : ?>
								<div style="float:left"><label>First Name<span> *</span></label>
									<input type="text" class="text validate[required]" size="14"
									       name="first_name<?= $i ?>" id="first_name<?= $i ?>" value="">
									</input>
								</div>
							<? else : ?>
								<div style="float:left"><label>First Name</label>
									<input type="text" class="text" size="14" name="first_name<?= $i ?>"
									       id="first_name<?= $i ?>" value="">
									</input>
								</div>
							<? endif ?>
							<div>
								<? if ($i == 1) : ?>
									<label>Last Name<span> *</span></label>
									<input type="text" class="text validate[required]" size="14"
									       name="last_name<?= $i ?>" id="last_name<?= $i ?>" value="">
									</input>
								<? else : ?>
									<label>Last Name</label>
									<input type="text" class="text validate[required]" size="14"
									       name="last_name<?= $i ?>" id="last_name<?= $i ?>" value="">
									</input>
								<? endif ?>
							</div>
							<!--				</fieldset>
											<fieldset>
													<div>
							-->
							<div style="float:left">
								<? if ($i == 1) : ?>
									<label>Email<span> *</span></label>
									<input type="text" class="text validate[required,custom[email]]" size="26"
									       name="email<?= $i ?>" id="email<?= $i ?>" value="">
									</input>
								<? else : ?>
									<label>Email<span></span></label>
									<input type="text" class="text" size="26" name="email<?= $i ?>" id="email<?= $i ?>"
									       value="">
									</input>
								<? endif ?>
							</div>
							<div>
								<? if ($i == 1) : ?>
									<label>Phone<span> *</span></label>
									<input type="text" class="text validate[required]" size="12" name="cell<?= $i ?>"
									       id="cell<?= $i ?>" value="">
									</input>
								<? else : ?>
									<label>Phone</label>
									<input type="text" class="text" size="12" name="cell<?= $i ?>" id="cell<?= $i ?>"
									       value="">
									</input>
								<? endif ?>
							</div>
							<!--						</div>
											</fieldset>-->
							<fieldset>
								<div style="float:left">
									<label>Emergency Contact<span> </span></label>
									<input type="text" class="text" size="26" name="emergency_contact<?= $i ?>"
									       id="emergency_contact<?= $i ?>" value="">
									</input>
								</div>
								<div>
									<label>Emergency Phone<span> </span></label>
									<input type="text" class="text" size="12" name="emergency_phone<?= $i ?>"
									       id="emergency_phone<?= $i ?>" value="">
									</input>
								</div>
							</fieldset>
						</div><!--left area-->
						<div id="right">     <!--inside the input area-->
							<!--            <fieldset>
							-->
							<div style="float:left">
								<label>Address</label>
								<input type="text" class="text" size="26" name="address1<?= $i ?>"
								       id="address1<?= $i ?>" value=""></input>
							</div>
							<div>
								<? if ($i == 1) : ?>
									<label>City<span> *</span></label>
									<input type="text" class="text validate[required]" size="15" name="city<?= $i ?>"
									       id="city<?= $i ?>" value=""></input>
								<? else : ?>
									<label>City</label>
									<input type="text" class="text" size="15" name="city<?= $i ?>" id="city<?= $i ?>"
									       value=""></input>
								<? endif ?>
							</div>
							<!--            </fieldset>
							-->
							<fieldset>
								<div>
									<label>State</label>
									<input type="text" class="text" size="4" name="state<?= $i ?>" id="state<?= $i ?>"
									       value="CA"></input>
								</div>
								<div>
									<label>Zip Code</label>
									<input type="text" class="text" size="9" name="zip<?= $i ?>" id="zip<?= $i ?>"
									       value=""></input>
								</div>
								<div>
									<label>Country</label>
									<input type="text" class="text" size="" name="country<?= $i ?>"
									       id="country<?= $i ?>" value="USA"></input>
								</div>
							</fieldset>
						</div> <!--right area-->
					</div>    <!--customer_data-->
				<? endfor ?>
				<div id="customer_data">
					<input type="submit" value="CONTINUE" class="submit"/>
				</div>
				</form>

			</div>

		</div>

		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<div class="sg-35 line"></div>

		<? $this->load->view('tt_v2/blocks/footer'); ?>

		<!--        </div>
			</div>
		-->
</body>
</html>