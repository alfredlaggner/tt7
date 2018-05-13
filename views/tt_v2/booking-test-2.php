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
					<div class="col-sm-6">
						<? if (isset($records)) : foreach ($records as $row) : ?>
						<h2>Checkout for
							<?= $row->name ?>
						</h2>
						<? if (!$locations) : ?>
							<h3 class="title">There are currently no dates scheduled for this activity.</h3>
							<p class="title">Don't see the date or location that works for you? Email us at <a
									href="mailto:info@treksandtracks.com">info@treksandtracks.com</a></p>
						<? else : ?>
							<h3 class="title">Choose Location and Time</h3>
						<? endif ?>
						<? $j = 1; ?>
						<? if (isset($locations)) : foreach ($locations as $location) : ?>
						<div class="toggle-container box" id="location">
							<div class="panel style1">
								<? $pre_month = '0'; ?>
								<? $is_month = '-1'; ?>
								<? $i = 1; ?>
								<? $k = 1; ?>
								<h4 class="panel-title"><a class="collapsed" href="#acc<?= $j; ?>"
								                           data-toggle="collapse" data-parent="#location">
										<?= $location->name ?>
									</a></h4>
								<div class="panel-collapse collapse" id="acc<?= $j; ?>">
									<div class="panel-content">
										<div class="toggle-container box" id="months">
											<div class="panel style1">
												<? if (isset($events)) :foreach ($events as $event) : ?>
												<? if ($location->location_id == $event['location_id']) : ?>
												<? $is_month = date('m', strtotime($event['event_date'])); ?>
												<? if ($is_month != $pre_month) : ?>
												<? if ($pre_month != 0) : ?>
											</div>
										</div>
									</div>
									<!-- AccordionPanelContent -->
									<? endif ?>
									<? else : ?>
									<h4 class="panel-title"><a href="#acc<?= $j; ?><?= $i; ?>" data-toggle="collapse"
									                           data-parent="#months">
											<?= date('F, Y', strtotime($event['event_date'])); ?>
										</a></h4>
									<div class="panel-collapse collapse in" id="acc<?= $j; ?><?= $i; ?>">
										<? $pre_month = date('m', strtotime($event['event_date'])); ?>
										<? $k++ ?>
										<? endif ?>
										<div class="panel-content">
											<div class="toggle-container box" id="day">
												<? if ($event['is_two_days'] and get_cookie('set_admin_status'))
													$disable = "X";
												else $disable = "";
												?>
												<a title="Click to select date and time"
												   style="font-size:12px; text-decoration:none" href="#"
												   id="go_book<?= $disable ?><?= $j ?><?= $i ?>">
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
													} else {
														echo " <span style='color:#F00'>FULL! </span>";
													}
													?>
													)
													<!--								</div>
--> </a>
												<? if ($event['is_two_days']) : ?>
													<span style="color:#00F">Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span>
												<? endif ?>
												<? endif ?>
												<? $i++ ?>
												<? endforeach //event  ?>
												<? endif ?>
											</div>    <!--day -->
										</div>
										<!-- end content -->
										<? $j++ ?>
										<? endforeach // location ?>
										<? endif ?>
										<? endforeach //records ?>
										<? endif ?>
									</div>
								</div>
							</div>
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
</body>
</html>
