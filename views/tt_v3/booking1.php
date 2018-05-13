<?= $head ?>
<!--<script src="/bootstrap4/js/main.js"></script>-->

<script>

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>

<body>
<?= $header ?>
<? $i = 1;
$j = 1 ?>
<section class="section" id="section-7">
	<div class="container">
		<? if (!$locations) : ?>
			<h3 class="title">There are currently no dates scheduled for this activity.</h3>
			<p class="title">Don't see the date or location that works for you? Email us at <a
					href="mailto:info@treksandtracks.com">info@treksandtracks.com</a></p>
		<? else : ?>
			<h1 class="page-header">Choose Location and Time</h1>
		<? endif ?>
		<div class="row">

			<div class="col-md-7">
				<? $test = 1; $k=1;
				if ($test) : ?>
					<? if (isset($event_data)) : foreach ($event_data as $row)  : ?>
						<? if ($row['location']) : ?>
							<div class="panel-group" id="location<?= $row['lc'] ?>">
							<div class="panel panel-info">
							<div class="panel-heading">
								<h4 class="panel-title"><a class="xpanel-toggle" data-toggle="xcollapse"
								                           data-parent="#location<?= $row['lc'] ?>"
								                           href="#collapse<?= $row['lc'] ?>">
										<?= $row['location'] ?>
									</a></h4>
							</div>
							<div id="xcollapse<?= $row['lc'] ?>" class="panel-body collapse in">
							<div class="panel-inner">
						<? endif ?>
						<? if ($row['month']) : ?>
						<div class="panel-group" id="month<?= $row['mc'] ?>">
						<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a class="xpanel-toggle" data-toggle="xcollapse"
							                           data-parent="#month<?= $row['mc'] ?>"
							                           href="#collapseInner<?= $row['mc'] ?><?= $row['ec'] ?>">
									<?= $row['month'] ?>
								</a></h4>
						</div>
						<div id="xcollapseInner<?= $row['mc'] ?><?= $row['ec'] ?>" class="panel-body xcollapse in">
						<div class="panel-inner btns-group">
					<? endif ?>
						<? if ($row['event_date']) : ?>
							<? $disable = "";
							$tooltip_call = "";
							if ($row['is_two_days']) {
								$disable = "disabled";
								$tooltip_call = "book_it" . $k;
							}
							if ( ! $row['available']){
								$disable = "disabled";
								$tooltip_call = "book_it" . $k;
                            }
							?>
							<div class="row">

								<div class="col-md-3">


									<p class="<?=$tooltip_call ?>" data-toggle="modal"
									   data-target="#myModal<?= $row['all_locations'] ?><?= $row['all_events'] ?>"><?= $row['event_date'] ?>
								</div>
								<div class="col-md-3">
									<span class="label label-primary"> <?= $row['available'] ?> </span> spots</p>
								</div>
								<div class="col-md-3">

									<button <?= $disable ?> type="button" class="btn btn-fill btn-sm book_it<?=$k?>"
									                        data-toggle="modal"
									                        data-toggle="tooltip"
									                        data-target="#myModal<?= $row['all_locations'] ?><?= $row['all_events'] ?>">
										Continue
									</button>
								</div>
								<div class="col-md-3"></div>

							</div>
							<script>$(document).ready(function () {
									$('.book_it<?= $k++ ?>').tooltip({
										title: '<?= $row['is_two_days_message'] ?>',
										html: true,
										placement: "top"
									});
								});
							</script>

						<? endif ?>
						<? if ($row['end_month'])    : ?>
						</div>
						</div>
						</div>
						</div>
					<? endif ?>
						<? if ($row['end_location'])    : ?>
							</div>
							</div>
							</div>
							</div>
						<? endif ?>

					<? endforeach; endif ?>
				<? endif ?>

			</div>
			<div class="col-md-5"></div>
		</div>
	</div>
</section>

<!-- Modal -->
<? $j = 1; ?>	<? $i = 1; ?>

<? foreach ($locations as $location) : ?>
	<? foreach ($events as $event) : ?>
		<div class="modal fade" id="myModal<?= $j ?><?= $i ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<?= date('D, M j', strtotime($event['event_date'])) ?>
						</h4>
					</div>
					<div class="modal-body">
						<? $attributes = array('id' => 'booking' . $j . $i);
						echo form_open('tt_v3/class_booking/' . $event['event_event_id'] . "/0", $attributes); ?>
						<? $max_part = ($event['capacity'] - $event['attending']) ?>
						<input type="hidden" name="event_id" id="event_id<?= $j ?><?= $i ?>"
						       value="<?= $event['event_event_id']; ?>"/>
						<input type="hidden" class="text" readonly name="event_date" id="event_date<?= $j ?><?= $i ?>"
						       value="<?= $event['event_date']; ?>"/>
						<input type="hidden" name="location_id" id="location_id<?= $j ?><?= $i ?>"
						       value="<?= $event['location_id']; ?>"/>
						<input type="hidden" name="exp_discount_price" id="exp_discount_price<?= $j ?><?= $i ?>"
						       value="<?= $event['exp_discount_price'] ?>"/>
						<ul>
							<li>
								<label for="participants">How many are you? <a class="tooltip"
								                                               title="If you have NO discount code enter number of students. <br>If you have a discount code please enter one at a time. <br><br>Question? Call us at 650-557-4893 Mon-Fri, 9-5 PST or email info@treksandtracks.com"
								                                               href="#"> Help</a></label>
							</li>
							<li>
								<select class="text" name="participants" id="participants" value="1"/>

								<? for ($k = 1; $k <= $max_part; $k++): ?>
									<? if ($k == 1) $plural = ""; else $plural = "s"; ?>
									<option value="<?= $k ?>">
										<?= $k . " participant" . $plural ?>
									</option>
								<? endfor; ?>
								</select>
							</li>
							<br>
							<br>
							<li>
								<label for="promo_code">Enter Discount Code (Crtl-V to paste) <a class="tooltip"
								                                                                 title="If you have NO discount code leave blank. <br>If you already paid for this class with a discount website or got a discount from Treks and Tracks, please enter discount code here. <br><br>Question? Call us at 650-557-4893 Mon-Fri, 9-5 PST or email info@treksandtracks.com"
								                                                                 href="#"> Help</a>
								</label>
							</li>
							<li>
								<input type="text"
								       class="text"
								       autocomplete="off"
								       onKeyDown="displayResult<?= $j; ?><?= $i; ?>()"
								       onkeyup="xajax_verify_promo_code(xajax.getFormValues('booking<?= $j ?><?= $i ?>'),<?= $j ?><?= $i ?>,<?= $event['event_event_id'] ?>,<?= $event['exp_discount_price'] ?>);return false;"
								       size="10"
								       id="promo_code<?= $j ?><?= $i ?>"
								       name="promo_code"
								       value="">
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<div id="customer_data">
							<input type="submit" class="btn btn-fill btn-sm" role="button" id="update<?= $j ?><?= $i ?>"
							       onMouseOver=
							       "xajax_verify_promo_code(xajax.getFormValues('booking<?= $j ?><?= $i ?>'),<?= $j ?><?= $i ?>,<?= $event['event_event_id'] ?>,<?= $event['exp_discount_price'] ?>);return false;"
							       size="10" id="dspl_promo_code<?= $j ?><?= $i ?>" name="update" value="CONTINUE"
							       class="submit"/>
						</div>
						</form>
						<div class="pull-xs-left" id="warning_message<?= $j ?><?= $i ?>"></div>
					</div>
				</div>
			</div>
		</div>

		<? $i++ ?>
	<? endforeach ?>
	<? $j++ ?>
<? endforeach ?>


<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
       crossorigin="anonymous"></script>-->
<?= $footer ?>
<script>$(document).ready(function () {
		$('.book_it').tooltip({
			title: '<h3><span style="color:#00F" >Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span></h3>',
			html: true,
			placement: "top"
		});
	});
</script>

</body>
</html>