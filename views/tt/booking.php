<script src="<?= base_url() ?>js_tt/maskedinput.js" type="text/javascript"></script>

</head>

<body>
<link href="../../../css/tt/style-greeny.css" rel="stylesheet" type="text/css"/>
<div class="body">
	<div class="body_resize">
		<div class="left">
			<? for ($i = 1; $i <= $nr_of_students; $i++) : ?>
				<script>
					jQuery(function ($) {
						$("#date_of_birth<?= $i ?>").mask("9999-99-99");
						$("#emergency_phone<?= $i ?>").mask("9999-99-99");
						$("#cell<?= $i ?>").mask("(999) 999-9999");
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
						echo form_open('tt/create_booking', $attributes); ?>
						<? foreach ($events as $event) : ?>
							<input type="hidden" name="event_id" value="<?= $event_id ?>">
							<input type="hidden" name="nr_of_students" value="<?= $nr_of_students ?>">
							<input type="hidden" name="promo_code" value="<?= $promo_code ?>">
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
							<input type="hidden" name="discount" id="discount" class="text" readonly
							       value='<?= $event['discount'] ?>'/>
							<input type="hidden" name="tax" id="tax" class="text" readonly
							       value='<?= $event['tax'] ?>'/>
							<input type="hidden" name="available" id="available" class="text" readonly
							       value='<?= $event['available']; ?>'/>
							<input type="hidden" name="attending" id="attending" class="text" readonly
							       value='<?= $event['attending']; ?>'/>
						<? endforeach ?>
					<? endif ?>
					<div id="left"> <!--inside the input area-->
						<fieldset>
							<div>
								<label>First Name<span> *</span></label>
								<input type="text" class="text" size="15" name="first_name<?= $i ?>"
								       id="first_name<?= $i ?> " value=""/>
							</div>
							<div>
								<label>Last Name<span> *</span></label>
								<input type="text" class="text" size="14" name="last_name<?= $i ?>"
								       id="last_name<?= $i ?>" value="">
								</input>
							</div>
							<div>
								<label>Date of Birth<span> *</span></label>
								<input type="text" class="text" size="1" name="date_of_birth<?= $i ?>"
								       id="date_of_birth<?= $i ?>" value="">
								</input>
							</div>
							<div>
								<label>Phone</label>
								<input type="text" class="text" size="10" name="cell<?= $i ?>" id="cell<?= $i ?>"
								       value="">
								</input>
							</div>
						</fieldset>
						<fieldset>
							<div>
								<label>Email<span> *</span></label>
								<input type="text" class="text" size="26" name="email<?= $i ?>" id="email<?= $i ?>"
								       value="">
								</input>
							</div>
						</fieldset>
						<fieldset>
							<div>
								<label>Emergency Contact<span> *</span></label>
								<input type="text" class="text" size="14" name="emergency_contact<?= $i ?>"
								       id="emergency_contact<?= $i ?>" value="">
								</input>
							</div>
							<div>
								<label>Emergency Phone<span> *</span></label>
								<input type="text" class="text" size="10" name="emergency_phone<?= $i ?>"
								       id="emergency_phone<?= $i ?>" value="">
								</input>
							</div>
						</fieldset>
					</div><!--left area-->
					<div id="right">     <!--inside the input area-->
						<fieldset>
							<div>
								<label>Address</label>
								<input type="text" class="text" size="26" name="address1<?= $i ?>"
								       id="address1<?= $i ?>" value=""></input>
							</div>
							<div>
								<label>City</label>
								<input type="text" class="text" size="15" name="city<?= $i ?>" id="city<?= $i ?>"
								       value=""></input>
							</div>
						</fieldset>
						<fieldset>
							<div>
								<label>State</label>
								<input type="text" class="text" size="4" name="state<?= $i ?>" id="state<?= $i ?>"
								       value=""></input>
							</div>
							<div>
								<label>Zip Code</label>
								<input type="text" class="text" size="9" name="zip<?= $i ?>" id="zip<?= $i ?>"
								       value=""></input>
							</div>
							<div>
								<label>Country</label>
								<input type="text" class="text" size="" name="country<?= $i ?>" id="country<?= $i ?>"
								       value=""></input>
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
		<div class="right">
			<div class="blog">
				<? foreach ($events as $event) : ?>
					<h2><span>Student Registration</span></h2>
					<p>
						<span><?= $event['activity_name'] ?></span><br/>
						On <b><?= date('M-d-y', strtotime($event['event_date'])); ?></b>
						<br/>
						From <b><?= date('g:i a', strtotime($event['event_time'])); ?> </b> to
						<b><?= date('g:i a', strtotime($event['event_time']) + $event['duration'] * 3600); ?></b>

					</p>

				<? endforeach ?>
				<p>&nbsp;</p>
				<p>Please provide us with a complete set of information about our students. We need this information to
					organize our classes that best serves your needs.</p>
				<p> Please refer to our privacy policy if you have questions. </p>
				<p> Thank you ! </p>
			</div>
			<!-- blog-->
			<div class="blog"></div>
		</div>
		<!--Right-->
	</div>
	<div class="clr"></div>
