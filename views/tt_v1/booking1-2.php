<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/js/jquery-ui-1.8.18.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/tt/themes/redmond/jquery.ui.all.css" media="all"/>
<?= $head ?>
<script>
	$(function () {
		$("#content_accordion").accordion({
			fillSpace: false,
			collapsible: true,
			active: false,
			icons: false,
			autoHeight: false,
			clearStyle: true
		});
	});
</script>
<? $j = 1; ?>
<? foreach ($locations as $location) : ?>
	<script>
		$(function () {
			$("#location_accordion<?= $j; ?>").accordion({
				header: '.location',
				fillSpace: true,
				collapsible: true,
//			event: "mouseover",
				animated: "bounceslide",
//			animated: "easeslide",
				active: false,
				icons: false,
				autoHeight: false,
				clearStyle: true
			});
		});
	</script>
	<script>
		$(function () {
			$("#accordion<?= $j; ?>").accordion({
				header: '.month',
				fillSpace: true,
				collapsible: true,
				//		animated: "easeslide",
				animated: "bounceslide",
//			event: "mouseover",
				active: false,
				autoHeight: false,
				clearStyle: true
			});
		});
		function stopEnterKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type == "text")) {
				return false;
			}
		}

		document.onkeypress = stopEnterKey;
		// disable contextg menu
		$(function () {
			$(this).bind("contextmenu", function (e) {
				e.preventDefault();
			});
		});

		//		document.oncontextmenu = document.body.oncontextmenu = function() {return false;}	
		//$.extend($.ui.accordion.animations, {
		//  fastslide: function(options) {
		//    $.ui.accordion.animations.slide(options, { duration: 1000 }); }
		//  });
	</script>
	<style></style>
<? $i = 1; ?>
<? foreach ($events as $event) : ?>
	<script>
		$(function () {
				$("#go_book<?= $j; ?><?= $i; ?>").click(showDialog<?= $j; ?><?= $i; ?> );
				$myWindow<?= $j; ?><?= $i; ?> = jQuery('#do_book<?= $j; ?><?= $i; ?>');
				//instantiate the dialog
				$myWindow<?= $j; ?><?= $i; ?>.dialog({
					show: 'explode',
					modal: true,
					height: 300,
					width: 600,
//                        position: 'center',
					autoOpen: false
				});
			}
		);
		//function to show dialog   
		var showDialog<?= $j; ?><?= $i; ?> = function () {
			//if the contents have been hidden with css, you need this
			$myWindow<?= $j; ?><?= $i; ?>.show();
			//open the dialog
			$myWindow<?= $j; ?><?= $i; ?>.dialog("open");
		};
		;

		//function to close dialog, probably called by a button in the dialog
		//    var closeDialog = function() {
		//        $myWindow<?  //echo $i; ?>.dialog("close");
		//    }
	</script>
	<script>
		function displayResult<?= $j; ?><?= $i; ?>() {
			var x = document.getElementById("promo_code<?= $j; ?><?= $i; ?>");
			x.value = x.value.toUpperCase();
		}

		$(function () {
			$(".tooltip").tipTip();
		});
	</script>
	<? $i++ ?>
<? endforeach ?>
	<? $j++ ?>
<? endforeach ?>

<body>
<div id="page-wrapper">
	<?= $header ?>
	<div class="page-title-container">
		<div class="container">
			<div class="page-title pull-left">
				<h2 class="entry-title">Booking 1</h2>
			</div>
			<ul class="breadcrumbs pull-right">
				<li><a href="#">HOME</a></li>
				<li><a href="#">PAGES</a></li>
				<li class="active">Full Width</li>
			</ul>
		</div>
	</div>
	<section id="content">
		<div class="container">
			<div id="page" class="sg-35">
				<? if (isset($records)) : foreach ($records as $row) : ?>
				<h1>Checkout for
					<?= $row->name ?>
				</h1>
				<article class="blog-post">
					<? if (!$locations) : ?>
						<h3 class="title">There are currently no dates scheduled for this activity.</h3>
						<p class="title">Don't see the date or location that works for you? Email us at <a
								href="mailto:info@treksandtracks.com">info@treksandtracks.com</a></p>
					<? else : ?>
						<h3 class="title">Choose Location and Time</h3>
					<? endif ?>
					<? $j = 1; ?>
					<? if (isset($locations)) : foreach ($locations as $location) : ?>
					<!--<?= "&nbsp;" ?>-->
					<div id="location_accordion<?= $j; ?>">
						<h2 style="color:#333" ; class="location"><a href="#">
								<?= $location->name ?>
							</a></h2>
						<div id="wrap_location<?= $j; ?>">
							<div id="accordion<?= $j; ?>">
								<? $pre_month = '0'; ?>
								<? $is_month = '-1'; ?>
								<!--						<div class="content-box1"> Date/Time </div>
				<div class="content-box2"> Time </div>
									<div class="content-box3"> $
			Price
			</div>

				<div class="content-box4"> Avail. </div>-->
								<? $i = 1; ?>
								<? $k = 1; ?>
								<? if (isset($events)) :foreach ($events as $event) : ?>
								<? if ($location->location_id == $event['location_id']) : ?>
								<? $is_month = date('m', strtotime($event['event_date'])); ?>
								<? if ($is_month != $pre_month) : ?>
								<? if ($pre_month != 0) : ?>
							</div>
							<!-- AccordionPanelContent -->
							<? endif ?>
							<h3 class="month"><a href="#">
									<?= date('F, Y', strtotime($event['event_date'])); ?>
								</a></h3>
							<div>
								<? $pre_month = date('m', strtotime($event['event_date'])); ?>
								<? $k++ ?>
								<? endif ?>
								<? if ($event['is_two_days'] and get_cookie('set_admin_status')) $disable = "X"; else $disable = ""; ?>
								<a title="Click to select date and time" style="font-size:12px; text-decoration:none"
								   href="#" id="go_book<?= $disable ?><?= $j ?><?= $i ?>">
									<!--								<div class="xcontent-box1">
-->
									<?= date('D, M j', strtotime($event['event_date'])); ?>
									<!--								</div>
--> <!--<div class="xcontent-box2">-->
									from
									<?= date('g:i', strtotime($event['event_time'])); ?>
									to
									<?= date('g:i', strtotime($event['event_time']) + $event['duration'] * 3600); ?>
									<!--								</div>
--> <!--<div class="xcontent-box4">-->
									(
									<?
									$available = $event['capacity'] - $event['attending'] < 0 ? 0 : $event['capacity'] - $event['attending'];
									$available_calc = $event['capacity'] - $this->ledger_model->attending($event['event_event_id']);;
									if ($available_calc) {
										if ($available_calc == 1)
											echo " <span style='color:#F00'>" . $available_calc . " spot </span>";
										else
											echo $available_calc . " spots ";
									} else
										echo " <span style='color:#F00'>FULL! </span>";
									?>
									)
									<!--								</div>
--> </a>
								<? if ($event['is_two_days']) : ?>
									<span style="color:#00F">Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span>
								<? endif ?>
								<div class="clear"></div>
								<? endif ?>
								<? $i++ ?>
								<? endforeach; ?>
								<? endif ?>
								<? //endif		?>
							</div>
							<!--Content -->
						</div>
					</div>
					<!--AccordionPanel -->
			</div>
			<? $j++ ?>
			<? endforeach; ?>
			<? endif ?>
		</div>
</div>
</div>
</article>
</div>
<div class="clear"></div>

<!-- !pagination -->
<? endforeach ?>
<? endif ?>
<? $j = 1; ?>
<? foreach ($locations as $location) : ?>
	<? $i = 1; ?>
	<? foreach ($events as $event) : ?>
		<div style=" padding: 0.4em; padding-left: 1.5em;  padding-right: 1.5em; display: none; "
		     id="do_book<?= $j ?><?= $i ?>"
		     title="You chose <?= date('D, M j', strtotime($event['event_date'])) ?>   (Press ESC to go back)">
			<div id="customer_data">
				<? $attributes = array('id' => 'booking' . $j . $i);
				echo form_open('tt_v1/class_booking/' . $event['event_event_id'] . "/0", $attributes); ?>
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
								<?= $k . " student" . $plural ?>
							</option>
						<? endfor; ?>
						</select>
					</li>
					<br>
					<br>
					<li>
						<label for="promo_code">Enter Discount Code (Crtl-V to paste) <a class="tooltip"
						                                                                 title="If you have NO discount code leave blank. <br>If you already paid for this class with a discount website or got a discount from Treks and Tracks, please enter discount code here. <br><br>Question? Call us at 650-557-4893 Mon-Fri, 9-5 PST or email info@treksandtracks.com"
						                                                                 href="#"> Help</a> </label>
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
					<div id="customer_data">
						<input type="submit" id="update<?= $j ?><?= $i ?>" onMouseOver=
						"xajax_verify_promo_code(xajax.getFormValues('booking<?= $j ?><?= $i ?>'),<?= $j ?><?= $i ?>,<?= $event['event_event_id'] ?>,<?= $event['exp_discount_price'] ?>);return false;"
						       size="10" id="dspl_promo_code<?= $j ?><?= $i ?>" name="update" value="CONTINUE"
						       class="submit"/>
					</div>
					</form>
				</ul>
				</p>
			</div>
			<!-- customer_data-->
		</div>
		<!-- do_book-->
		<? $i++ ?>
	<? endforeach ?>
	<? $j++ ?>
<? endforeach ?>
</div>
</div>
</section>
<?= $footer ?>
</div>

<!-- Javascript -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.noconflict.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/modernizr.2.7.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery-ui.1.10.4.min.js"></script>

<!-- Twitter Bootstrap -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/bootstrap.js"></script>

<!-- parallax -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/theme-scripts.js"></script>
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/scripts.js"></script>
</body>
</html>
