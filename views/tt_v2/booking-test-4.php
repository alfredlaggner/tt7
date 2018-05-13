<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
<head>
	<!-- Page Title -->
	<title>Travelo | Responsive HTML5 Travel Template</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template"/>
	<meta name="description" content="Travelo | Responsive HTML5 Travel Template">
	<meta name="author" content="SoapTheme">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Theme Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/animate.min.css">

	<!-- Current Page Styles -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>travelo/components/revolution_slider/css/settings.css"
	      media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>travelo/components/revolution_slider/css/style.css"
	      media="screen"/>
	<link rel="stylesheet" type="text/css"
	      href="<?= base_url() ?>travelo/components/jquery.bxslider/jquery.bxslider.css" media="screen"/>

	<!-- Main Style -->
	<link id="main-style" rel="stylesheet" href="<?= base_url() ?>travelo/css/style.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/custom.css">

	<!-- Updated Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/updates.css">

	<!-- Responsive Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>travelo/css/responsive.css">

	<!-- CSS for IE -->
	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<![endif]-->

	<!-- Javascript -->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
	<![endif]-->
</head>
<body>
<div id="page-wrapper">
	<?= $header ?>
	<div class="page-title-container">
		<div class="container">
			<div class="page-title pull-left">
				<h2 class="entry-title">Accordions &amp; Toggles</h2>
			</div>
			<ul class="breadcrumbs pull-right">
				<li><a href="#">HOME</a></li>
				<li><a href="#">PAGES</a></li>
				<li><a href="#">SHORTCODES</a></li>
				<li class="active">Accordions &amp; Toggles</li>
			</ul>
		</div>
	</div>
	<section id="content" class="gray-area">
		<div class="container shortcode">
			<div class="block">
				<div class="row">


					<!--test area-->
					<? if (isset($records)) : foreach ($records as $row) : ?>

					<div class="col-sm-6">
						<h2>Accordions 01</h2>
						<div class="toggle-container box" id="accordion1">
							<? endforeach //records  ?>
							<? endif ?>

							<? $j = 1; ?>
							<? if (isset($locations)) : foreach ($locations as $location) : ?>
								<? $i = 1; ?>
								<? $pre_month = '0'; ?>
								<? $is_month = '-1'; ?>

								<div class="panel style1">
									<h4 class="panel-title">
										<a class="collapsed" href="#acc<?= $j ?><?= $i ?>" data-toggle="collapse"
										   data-parent="#accordion1"><?= $location->name ?></a>
									</h4>
									<div class="panel-collapse collapse" id="acc<?= $j ?><?= $i ?>">
										<div class="panel-content">
											<? //echo $calendar ?>

											<? if (isset($events)) :foreach ($events as $event) : ?>
												<? if ($location->location_id == $event['location_id']) : ?>
													<? $is_month = date('m', strtotime($event['event_date'])); ?>
													<? $month = date('F, Y', strtotime($event['event_date'])); ?>
													<? if ($is_month != $pre_month) : ?>
														<h4>
															<a href="#"><?= $month ?></a>
														</h4>
														<? $pre_month = date('m', strtotime($event['event_date'])); ?>
													<? endif ?>
													<!--events content-->
													<? if ($event['is_two_days'] and get_cookie('set_admin_status'))
														$disable = "X";
													else $disable = "";
													?>


													<h5><a title="Click to select date and time"
													       style="font-size:12px; text-decoration:none" href="#"
													       id="go_book<?= $disable ?><?= $j ?><?= $i ?>">
															<?= date('D, M j', strtotime($event['event_date'])); ?>
															from
															<?= date('g:i', strtotime($event['event_time'])); ?>
															to
															<?= date('g:i', strtotime($event['event_time']) + $event['duration'] * 3600); ?>
															<?
															$available = $event['capacity'] - $event['attending'] < 0 ? 0 : $event['capacity'] - $event['attending'];
															$available_calc = $event['capacity'] - $this->ledger_model->attending($event['event_event_id']);;
															if ($available_calc) {
																if ($available_calc == 1)
																	echo " <span style='color:#F00'>" . $available_calc . " spot </span>";
																else
																	echo $available_calc . " spots ";
															} else {
																echo " <span style='color:#F00'>FULL! </span>";
															}
															?>
															)
														</a></h5>
													<? if ($event['is_two_days']) : ?>
														<span style="color:#00F">Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span>
													<? endif ?>

													<? $i++ ?>
												<? endif // event of this location ?>
											<? endforeach //event  ?>
											<? endif ?>

										</div><!-- end content -->
									</div>
								</div>
								<? $j++ ?>
							<? endforeach //location  ?>
							<? endif ?>

						</div>
					</div>


					<!-- end test area-->

				</div>
			</div>
		</div>
	</section>
	<?= $footer ?>
</div>

<!-- Javascript -->
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery.noconflict.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/modernizr.2.7.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery-ui.1.10.4.min.js"></script>

<!-- Twitter Bootstrap -->
<script type="text/javascript" src="<?= base_url() ?>travelo/js/bootstrap.js"></script>

<!-- load revolution slider scripts -->
<script type="text/javascript"
        src="<?= base_url() ?>travelo/components/revolution_slider/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript"
        src="<?= base_url() ?>travelo/components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- load BXSlider scripts -->
<script type="text/javascript"
        src="<?= base_url() ?>travelo/components/jquery.bxslider/jquery.bxslider.min.js"></script>

<!-- parallax -->
<script type="text/javascript" src="<?= base_url() ?>travelo/js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="<?= base_url() ?>travelo/js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="<?= base_url() ?>travelo/js/theme-scripts.js"></script>
<script type="text/javascript" src="<?= base_url() ?>travelo/js/scripts.js"></script>

<!--added acalendar stuff-->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/calendar.js"></script>

<!-- parallax -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/theme-scripts.js"></script>

<script type="text/javascript">
	tjq(document).ready(function () {
		// calendar panel
		var cal = new Calendar();
		var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
		var price_arr = {
			3: '$170',
			4: '$170',
			5: '$170',
			6: '$170',
			7: '$170',
			8: '$170',
			9: '$170',
			10: '$170',
			11: '$170',
			12: '$170',
			13: '$170',
			14: '$170',
			15: '$170',
			16: '$170',
			17: '$170'
		};

		var current_date = new Date();
		var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
		tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
		cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
		tjq(".calendar").html(cal.getHTML());

		tjq("#select-month").change(function () {
			var selected_year_month = tjq("#select-month option:selected").val();
			var year = parseInt(selected_year_month.split("-")[0], 10);
			var month = parseInt(selected_year_month.split("-")[1], 10);
			cal.generateHTML(month - 1, year, unavailable_days, price_arr);
			tjq(".calendar").html(cal.getHTML());
		});


		tjq(".goto-writereview-pane").click(function (e) {
			e.preventDefault();
			tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show')
		});

		// editable rating
		tjq(".editable-rating.five-stars-container").each(function () {
			var oringnal_value = tjq(this).data("original-stars");
			if (typeof oringnal_value == "undefined") {
				oringnal_value = 0;
			} else {
				//oringnal_value = 10 * parseInt(oringnal_value);
			}
			tjq(this).slider({
				range: "min",
				value: oringnal_value,
				min: 0,
				max: 5,
				slide: function (event, ui) {

				}
			});
		});
	});

	<!-- end calendar stuff -->

	</
	body >
	< / html >;
	;
