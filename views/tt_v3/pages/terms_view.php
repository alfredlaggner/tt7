<?= $head ?>
<body>

<?= $header ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Terms and Conditions</h1>
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-7">
			<div id="blog-post-content">
				<h4><strong>1. Registration and Payment</strong></h4>
				<p align="left">You may register for any of our Adventures using the online registration form. Early
					registrations are greatly appreciated, due to our bookings. This way we can guarantee a spot on our
					trip and a great booking price. </p>
				<p align="left">After your registration is submitted you will receive a written notification form.
					On<strong> international expeditions</strong> we require a $25 deposit to reserve your spot on the
					course/trip. A 50% downpayment is due within 30 days of the reservation. The remainder is due no
					later than 15 days prior to the start of the program. The 50% deposit is fully refundable 90 days
					prior to any of our programs. </p>
				<p align="left">For Treks and Tracks Mountain School programs we require that the class is paid in full
					before the date of the class.</p>;
				<p align="left"><strong>With registration to any of Treks and Tracks programs you agree to all Terms and
						Conditions Listed. </strong></p>
				<h4 align="left"><strong><span dir="ltr"> </span>2. Change of Itinerary </strong></h4>
				<p align="left">Treks and Tracks reserves the right to make changes of itinerary or cancel classes and
					programs at the discretion of Treks and Tracks staff. </p>
				<p align="left">We reserve the right to change the program due to dangerous avalanche conditions, bad
					weather, weak condition of participants, low participant numbaers or unfavorable
					conditions.&nbsp; </p>
				<p align="left">Rock Climbing specific cancellation policy about weather:<br/>
					<br/>
					In the event that the forecast clearly calls for rain showers we will cancel the course the day
					prior. You will be contacted via the email address we have on file on you so keep an eye out for any
					communication from us. In the case it begins to rain on the day of the course to the point where
					climbing is no longer possible we will cancel the class. Cancellations due to weather will of course
					be reschedule on a day when the
					weather is more suitable to a day of outside climbing. No refunds are issued due to cancelation due
					to weather however a 100% credit to any of our programs will be issued. </p>
				<p align="left">The participants agree to these terms with registration to any of our programs. </p>
				<h4 align="left"><strong><span dir="ltr"> </span>3. Cancellation by participant</strong></h4>
				<p align="left">Participants may cancel an expedition for a full refund 90 days prior to the departure
					date. A 4% processing fee of the gross expedition cost may apply to cancelations, or 100% of the
					funds may be used as credit with any of Treks and Tracks programs.</p>
				<p align="left"> Participants may cancel a class 30 days prior to the event date. A $10 processing fee
					may apply.</p>
				<p align="left">Please refer to your <span id="lw_1179254617_1">travelers insurance</span> to trip
					interruption insurance. </p>
				<h4 align="left"><strong>4. Cancellation by Treks and Tracks</strong></h4>
				<p align="left">There will be a 100% refund if Treks and Tracks cancels a trip before the day of the
					begin of a program. Refunds will not be issued if there is a change to a program due to unforseen
					circumstances such as weather. (refer to 2. Change of itinerary)</p>
				<h4 align="left"><strong>5. Minimum participant numbers</strong></h4>
				<p align="left">We reserve the right to cancel any of our programs 2 days prior to the begin of a
					program if there is not a minimum participant number. There will be a 100% refund issued or 100% of
					the funds may be transferred to any of our other programs. </p>
				<h4 align="left"><strong>6. International Insurance</strong></h4>
				<p align="left">With participation Treks and Tracks&rsquo; programs you may agree to conditions provided
					by other agencies. When working with 3rd party contractors we only work with fully recognized guides
					and agencies who will bear responsibility for all of their participants.</p>
				<p align="left"><strong>You will not be insured through our agency on international
						expeditions. </strong>We highly recommend that you have health care coverage and purchase <span
						id="lw_1179254617_0">travelers insurance</span> for all of our expeditions. </p>
				<p align="left"><strong>Please Note: Any activity in an outdoor environment is inherently dangerous.
						With your registration you acknowledge and accept the inherent dangerous that may not be
						preventable even with the best guiding techniques. Please refer to our liablility waiver form
						for more details on these risks. &nbsp;</strong></p>
				<p>
					<!--<a href="<?= site_url() . "menu_pages/environment" ?>"><img src="<?= base_url() . PAGES_IMAGE_DIR ?>logo_vert_standard_color.jpg" alt="one percent for the planet" width="182" height="267" align="left" /></a>--><img
						src="<?= base_url() . PAGES_IMAGE_DIR ?>amga_spi.jpg" alt="AMGA certified guides" width="200"
						height="256" align="right"/></p>
				<p>.</p>
			</div>
		</div>
		<div class="col-md-5">
			<!-- !sidebar -->
			<? $data['is_about_view'] = TRUE ?> <!--used to exlude member pictures on sidebar-->
			<? $this->load->view('tt_v3/blocks/pages_sidebar', $data); ?>
			<!-- !line -->
		</div>
	</div>
</div>
</body>
<?= $footer ?>
</html>