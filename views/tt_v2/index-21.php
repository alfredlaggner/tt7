<!DOCTYPE HTML>
<html lang="en-US">
<?= $head ?>
<body>
<div id="page-wrapper">
	<?= $header ?>
	<div id="slideshow">
		<div class="fullwidthbanner-container">
			<div class="revolution-slider" style="height: 0; overflow: hidden;">
				<ul>
					<!-- SLIDE  -->
					<!-- Slide1 -->
					<li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
						<!-- MAIN IMAGE -->
						<img src="<?= base_url() ?>images/classes/RAPTT/IMGP1294.JPG" alt=""></li>

					<!-- Slide2 -->
					<li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">
						<!-- MAIN IMAGE -->
						<img src="<?= base_url() ?>images/classes/RAPTT/RAPTT3.jpg" alt=""></li>

					<!-- Slide3 -->
					<li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500">
						<!-- MAIN IMAGE -->
						<img src="<?= base_url() ?>images/classes/RAPTT/RAPTT4.jpg" alt=""></li>
					<!--<img src="http://placehold.it/2080x646" alt="">-->
					</li>
				</ul>
			</div>
		</div>
	</div>
	<section id="content">
		<div class="search-box-wrapper">
			<div class="search-box container">
				<ul class="search-tabs clearfix">
					<li class="active"><a href="#hotels-tab" data-toggle="tab">OUR CLASSES</a></li>
					<? if ($styles) : foreach ($styles as $style) : ?>
						<li><a onClick="xajax_getProducts(<?= $style->style_id ?>);return false;" href="#hotels-tab"
						       data-toggle="tab">
								<?= $style->name ?>
							</a></li>
					<? endforeach; endif ?>

					<!--		<li><a href="#flights-tab" data-toggle="tab">FLIGHTS</a></li>
				<li><a href="#flight-and-hotel-tab" data-toggle="tab">FLIGHT &amp; HOTELS</a></li>
				<li><a href="#cars-tab" data-toggle="tab">CARS</a></li>
				<li><a href="#cruises-tab" data-toggle="tab">CRUISES</a></li>
				<li><a href="#flight-status-tab" data-toggle="tab">FLIGHT STATUS</a></li>
				<li><a href="#online-checkin-tab" data-toggle="tab">ONLINE CHECK IN</a></li>
		-->
				</ul>
				<div class="visible-mobile">
					<ul id="mobile-search-tabs" class="search-tabs clearfix">
						<li class="active"><a href="#hotels-tab">ALL CLASSES</a></li>
						<? if ($styles) : ;
							foreach ($styles as $style) : ;
								?>
								<li><a onClick="xajax_getProducts(<?= $style->style_id ?>);return false;"
								       href="#hotels-tab">
										<?= $style->name ?>
									</a></li>
							<? endforeach; endif ?>

						<!--			<li class="active"><a href="#hotels-tab">HOTELS</a></li>
					<li><a href="#flights-tab">FLIGHTS</a></li>
					<li><a href="#flight-and-hotel-tab">FLIGHT &amp; HOTELS</a></li>
					<li><a href="#cars-tab">CARS</a></li>
					<li><a href="#cruises-tab">CRUISES</a></li>
					<li><a href="#flight-status-tab">FLIGHT STATUS</a></li>
					<li><a href="#online-checkin-tab">ONLINE CHECK IN</a></li>
		-->
					</ul>
				</div>
				<div class="search-tab-content">
					<div class="tab-pane fade active in" id="hotels-tab">
						<div id="product_display" class="row image-box style1 add-clearfix">
							<? $i = 0 ?>
							<? if ($all_classes) : foreach ($all_classes as $row) : ?>
								<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '2.jpg'; ?>
								<div class="col-sms-6 col-sm-6 col-md-3">
									<article class="box">
										<figure class="animated" data-animation-type="fadeInDown"
										        data-animation-duration="1"><a
												href="<?= site_url() . 'tt_v2/product/' . $row->activity_id . '/photos_tab' ?>"
												title="" class="hover-effect"><img src=<?= $picture ?> alt=""
										                                           width="270" height="160"/></a>
										</figure>
										<div class="details">
											<h4 class="box-title"><a
													href="<?= site_url() . 'tt_v2/product/' . $row->activity_id ?>">
													<?= $row->name ?>
													<small>Paris</small>
												</a></h4>
											<div><span class="price"><small></small>$
													<?= $row->rate_price_price ?>
									</span></div>
										</div>
										<hr>
										<div class="text-center">
											<div class="times"><i class="soap-icon-clock yellow-color"></i> <span>01 Nov 2014 - 08 Nov 2014</span>
											</div>
										</div>
										<a href="<?= site_url() . 'tt_v2/product_booking1/' . $row->activity_id ?>"
										   class="button btn-small full-width">CHECK DATES</a></article>
								</div>
								<? $i++ ?>
							<? endforeach ?>
							<? else : ?>
								<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please
									choose from another group. </p>
							<? endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<!-- Honeymoon -->

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
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/bootstrap.min.js"></script>

		<!-- load revolution slider scripts -->
		<script type="text/javascript"
		        src="<?= base_url() . COMPONENTS_DIR ?>components/revolution_slider/js/jquery.themepunch.plugins.min.js"></script>
		<script type="text/javascript"
		        src="<?= base_url() . COMPONENTS_DIR ?>components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

		<!-- load BXSlider scripts -->
		<script type="text/javascript"
		        src="<?= base_url() . COMPONENTS_DIR ?>components/jquery.bxslider/jquery.bxslider.min.js"></script>

		<!-- Flex Slider -->
		<script type="text/javascript"
		        src="<?= base_url() . COMPONENTS_DIR ?>components/flexslider/jquery.flexslider.js"></script>

		<!-- parallax -->
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.stellar.min.js"></script>

		<!-- parallax -->
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/jquery.stellar.min.js"></script>

		<!-- waypoint -->
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/waypoints.min.js"></script>

		<!-- load page Javascript -->
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/theme-scripts.js"></script>
		<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/scripts.js"></script>
		<script type="text/javascript">
			tjq(document).ready(function () {
				tjq('.revolution-slider').revolution(
					{
						dottedOverlay: "none",
						delay: 8000,
						startwidth: 1170,
						startheight: 646,
						onHoverStop: "on",
						hideThumbs: 10,
						fullWidth: "on",
						forceFullWidth: "on",
						navigationType: "none",
						shadow: 0,
						spinner: "spinner4",
						hideTimerBar: "on",
					});
			});
		</script>
</body>
</html>
