<?= $head ?>


<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<style>
	#preview {
		position: absolute;
		border: 1px solid #ccc;
		/*background:#333;
		padding:2px;*/
		display: none;
		color: #fff;
	}

	/* pre{
		 display:block;
		 font:100% "Courier New", Courier, monospace;
		 padding:10px;
		 border:1px solid #bae2f0;
		 background:#e3f4f9;
		 margin:.5em 0;
		 overflow:auto;
		 width:100%;
	 }*/
	/*  */

</style>

<body>

<?= $header ?>
<section class="section" id="section-7">
	<div class="container">
		<? if ($error) : ?>
			<h3 style="margin-left:20px"> Credit card error:
				<?= $error ?>
				<?= $error_text ?>
			</h3>
		<? endif ?>
		<? foreach ($records as $row) : ?>

			<h1 class="page_header"><?= $row->name ?></h1>

			<? $main_picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '2.jpg'; ?>
		<? endforeach ?>
		<? foreach ($pictures as $picture) : ?>
			<? break ?>
		<? endforeach ?>
		<div class="row">
			<div class="col-md-6"><img src="<?= $main_picture ?>" alt="activity phptp" class="img-responsive"/>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6"><span class="label label-primary">level</span> <span id="service_level"
					                                                                           class="monospaced">
												<?= $row->service_level_name ?>
												</span></div>
					<div class="col-md-6"><span class="label label-primary">style</span> <span id="styles"
					                                                                           class="monospaced">
												<?= $row->style_name ?>
												</span></div>
				</div>
				<div class="row">
					<div class="col-md-6"><span class="label label-primary">challenge</span> <span
							id="physical_levels"
							class="monospaced">
												<?= $row->physical_level_name ?>
												</span></div>
					<div class="col-md-6"><span class="label label-primary">age</span> <span class="monospaced">
												<?= $row->age_min ?>
												</span></div>
				</div>
				<div class="row" style="margin-top: 1em">
					<div class="card-deck-wrapper hidden-xs " hidden-sm
					"" >
					<div class="card-deck">
						<? $i = 1;
						foreach ($pictures as $picture) : ?>
							<? if ($i <= 3) : ?>
								<div class="col-md-4">
									<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $picture->picture ?>
									<div class="card-deck-wrapper">

										<div class="card"><a href="<?= $picture ?>" class="preview"><img
													class="img-responsive" src="<?= $picture ?>" alt=""></a>
										</div>
									</div>
								</div>
							<? endif;
							$i++;
						endforeach ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 bottom-rule">
					<h2 class="product-price">$
						<?= $row->price ?>
					</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4"><a class="btn btn-sm btn-fill btn-brand btn-full-width btn-block"
				                         href="<?= site_url() . 'tt_v3/product_booking1/' . $row->activity_id ?>"
				                         id="product-image-buy-link">See Event Dates</a></div>
			</div>
			<div class="row">
				<div class="col-md-4"><a class="btn  btn-fill btn-brand btn-full-width btn-block"
				                         href="<?= site_url() . 'tt_v3/product_booking1/' . $row->activity_id ?>"
				                         id="product-image-buy-link">Book Now</a></div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 2em">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs nav-justified" role="tablist">
			<li role="presentation" class="active "><a href="#description" aria-controls="description" role="tab"
			                                           data-toggle="tab">About Class</a></li>
			<li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Need to
					Know</a></li>
			<li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">What's
					Great </a></li>
			<li role="presentation"><a href="#location" aria-controls="location" role="tab"
			                           data-toggle="tab">Location</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="description">
					<p>
						<?= $row->description_long ?>
					</p>
				</div>
				<div role="tabpanel" class="tab-pane top-10" id="location">
					<h3>Locations</h3>
					<ul class="nav nav-pills nav-justified">
						<? $i = 1 ?>
						<? foreach ($locations as $location) : ?>

						<? if ($location->map_link) : ?>

							<? $locref = 'map' . $i ?>
							<? if ($i == 1) : ?>
								<li class="active"><a data-toggle="pill"
								                      href="#<?= $locref ?>"> <?= $location->name ?></a>
								</li>
							<? else  : ?>
								<li><a data-toggle="pill" href="#--><?= $locref ?>"><?= $location->name ?></a>
								</li>
							<? endif ?>

						<? endif ?>


					</ul>
					<div class="tab-content">
						<div style="height:400px; width:400px;" id="map<?= $i ?>"></div>

					</div>
					<? $i++ ?>
					<? endforeach ?>

					<div class="xtab-content">
						<? $i = 0 ?>
						<? foreach ($locations as $location) : ?>
						<? if ($location->map_link) : ?>
						<? $locref = 'map' . ++$i ?>
						<? if ($i == 1) : ?>
						<div id="<?= $locref ?>" class="tab-pane fade in active">
							<? else : ?>
							<div id="<?= $locref ?>" class="tab-pane fade">
								<? endif ?>
								<h3><?= $location->name ?></h3>
								<p><? if ($location->map_link) echo $location->map_link ?></p>
							</div>
							<? endif ?>
							<? endforeach ?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="notes">
						<?= $row->description_detailled ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="reviews">
						<div class="row">
							<div class="card-deck-wrapper" style="margin-top: 1em">
								<div class="card-deck">
									<div class="card card-block">
										<h4 class="card-header">What to expect</h4>
										<p class="card-text">
											<?= $row->to_expect ?>
										</p>
									</div>
									<div class="card card-block">
										<h4 class="card-header">We provide</h4>
										<p class="card-text">
											<?= $row->we_provide ?>
										</p>
									</div>
									<div class="card card-block">
										<h4 class="card-header">You bring</h4>
										<p class="card-text">
											<?= $row->they_bring ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? if ($activities_related) : ?>
			<div class="row" style="margin-top: 2em">
				<div class="col-md-12">
					<h2>Related Activities</h2>
				</div>
				<div class="card-deck-wrapper">
					<div class="card-deck">
						<? foreach ($activities_related as $related) : ?>
							<div class="col-md-3">
								<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($related->code) . '/' . $related->picture; ?>
								<div class="card"><a
										href="<?= site_url() . "tt_v3/activity_detail/" . $related->activity_id ?>"><img
											class="img-responsive" src="<?= $picture ?>"></a>
									<div class="card-block">
										<h4 class="card-title"><a
												href="<?= site_url() . "tt_v3/activity_detail/" . $related->activity_id ?>">
												<?= $related->name ?>
											</a></h4>
										<p class="card-text">
											<small class="text-muted"><span>$</span>
												<?= $related->price ?>
											</small>
										</p>
									</div>
								</div>
							</div>
						<? endforeach ?>
					</div>
				</div>
			</div>
		<? endif ?>
	</div>
</section>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->
<?= $footer ?>
<script>
	$(document).ready(function () {
		$("iframe").wrap('<div class="embed-responsive embed-responsive-16by9"/>');
		$("iframe").addClass('embed-responsive-item');
	});
	this.imagePreview = function () {
		/* CONFIG */
		xOffset = 10;
		yOffset = 30;

// these 2 variable determine popup's distance from the cursor
// you might want to adjust to get the right result

		/* END CONFIG */
		$("a.preview").hover(function (e) {
				this.t = this.title;
				this.title = "";
				var c = (this.t != "") ? "<br/>" + this.t : "";
				$("body").append("<p id='preview'><img src='" + this.href + "' alt='Image preview' />" + c + "</p>");
				$("#preview")
					.css("top", (e.pageY - xOffset) + "px")
					.css("left", (e.pageX + yOffset) + "px")
					.fadeIn("fast");
			},
			function () {
				this.title = this.t;
				$("#preview").remove();
			});
		$("a.preview").mousemove(function (e) {
			$("#preview")
				.css("top", (e.pageY - xOffset) + "px")
				.css("left", (e.pageX + yOffset) + "px");
		});
	};

	// starting the script on page load
	$(document).ready(function () {
		imagePreview();
	});
	$(document).ready(function () {
		$('#service_level').tooltip({
			title: "<h3><?= $service_levels_list ?></h3> ",
			html: true,
			placement: "right"
		});
		$('#styles').tooltip({title: "<h3><?= $styles_list ?></h3> ", html: true, placement: "right"});
		$('#physical_levels').tooltip({
			title: "<h3><?= $physical_levels_list ?></h3> ",
			html: true,
			placement: "right"
		});
	});
</script>
<script
	src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAr0bshN4cQiVOhgPo6Ypm7RTNsElaGkaOa0i523uXAdE31ey5aRSNPRly0nT7KWMJUpFhEb2m6u6xag"
	type="text/javascript"></script>
<script type="text/javascript" src="http://trecksandtraks.com/js/jmaps.js"></script>
<? $i = 0 ?>
<? foreach ($locations as $location) : ?>
	<script>

		$("#map<?= ++$i ?>").gMap();

		$(function () {
			$("#map<?= $i ?>").gMap({
				markers: [{
					latitude: <?= $location->latitude; ?>,
					longitude: <?= $location->longitude; ?>,
					html: "<?= $location->location; ?>",
					popup: true
				}],
				zoom: 15
			});
		});
	</script>
<? endforeach; ?>

</body>
</html >