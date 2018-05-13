<?= $head ?>
<? foreach ($locations as $location) {
	$location_name = $location->name;
	$location_longitude = $location->longitude;
	$location_latitude = $location->latitude;
	$location_directions = $location->directions;
}
?>

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


<style>
	#map {
		height: 100%;

	#floating-panel {
		position: absolute;
		top: 10px;
		left: 25%;
		z-index: 5;
		background-color: #fff;
		padding: 5px;
		border: 1px solid #999;
		text-align: center;
		font-family: 'Roboto', 'sans-serif';
		line-height: 30px;
		padding-left: 10px;
	}

	#right-panel {
		font-family: 'Roboto', 'sans-serif';
		line-height: 30px;
		padding-left: 10px;
	}

	#right-panel select, #right-panel input {
		font-size: 15px;
	}

	/*		#right-panel*/
	<?//= $i ?> /* select {*/
	/*			width: 100%;*/
	/*		}*/

	#right-panel i {
		font-size: 12px;
	}

	/*		#right-panel*/
	<?//= $i ?> /* {*/
	/*			height: 100%;*/
	/*			float: right;*/
	/*			width: 390px;*/
	/*			overflow: auto;*/
	}

	#map {
		/*	margin-right: 400px; */
	}

	#floating-panel {
		background: #fff;
		padding: 5px;
		font-size: 14px;
		font-family: Arial;
		border: 1px solid #ccc;
		box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
		display: none;
	}

	@media print {
		/*			#map





	 {
			height: 500px;
			margin: 0;
		}*/
		/*			#right-panel*/
	<?//= $i ?>/* {*/
		/*				float: none;*/
		/*				width: auto;*/
		/*			}*/
	}
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
			                           data-toggle="tab">Locations</a>
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

					<? foreach ($locations as $location) {
						$location_name = $location->name;
						$location_longitude = $location->longitude;
						$location_latitude = $location->latitude;
						$location_directions = $location->directions;
					}; ?>

					<button type="button" class="btn btn-fill btn-sm btn-block" data-toggle="modal"
					        data-target="#location">
						<?= $location_name ?>
					</button>

					<div class="modal fade" id="location" tabindex="-1" role="dialog"
					     aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<p>xxxx
								<div style="height:600px; width:100%;" id="mapModal"></div>
								</p>
								<p>
								<div style="height:100%; width:100%;" id="right-panel"></div>
								</p>

							</div>
						</div>
					</div>
				</div>
				<!--						<div role="tabpanel" class="tab-pane" id="location">
							<div class="row">
								<div class="card-deck-wrapper" style="margin-top: 1em">
									<div class="card-deck">
										<div class="card card-block row">
											<h4 class="card-header"> <? /*= $location_name */ ?></h4>
											<p class="card-text">
											<div style="height:400px; width:100%;" id="map<? /*= $i */ ?>"></div></p>
											<div id="right-panel<? /*= $i */ ?>"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
-->
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


<div id="floating-panel">
	<strong>Start:</strong>
	<input id="start">
</div>

<?= $footer ?>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXVQA8Jdyxlebt7y_jkcMfViJhBkcgPQs&callback=initMap"
        async
        defer></script>

<script>
	function initMap() {


		var directionsDisplay = new google.maps.DirectionsRenderer;
		var directionsService = new google.maps.DirectionsService;

		var mapDiv = document.getElementById('mapModal');

		var map = new google.maps.Map(mapDiv, {
			center: {lat: <?= $location_latitude ?>, lng: <?= $location_longitude ?>},
			zoom: 7
		});


		var contentString = '<?= $location_directions ?>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var marker = new google.maps.Marker({
			position: {lat: <?=$location_latitude ?>, lng: <?=$location_longitude ?>},
			map: map,
			title: '<?= $location_name ?>'
		});

		google.maps.event.addListener(map, 'idle', function () {
			map.panTo(marker.getPosition());
		});
		// directions :
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById('right-panel'));

		var control = document.getElementById('floating-panel');
		control.style.display = 'block';
		map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

		var onChangeHandler = function () {
			calculateAndDisplayRoute(directionsService, directionsDisplay);
		};
		document.getElementById('start').addEventListener('change', onChangeHandler);
		//	document.getElementById('end').addEventListener('change', onChangeHandler);


	}


	$(document).ready(function () {

		$("#location").on("shown.bs.modal", function () {
			/*		$('a[href="#location"]').on('shown.bs.tab', function (e) {*/
			google.maps.event.trigger(map, 'resize');

		});
	});


	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		var start = document.getElementById('start').value;
		//	var end = document.getElementById('end').value;
		var end = '<?= $location_latitude ?>, <?=$location_longitude ?>';


		directionsService.route({
			origin: start,
			destination: end,
			travelMode: google.maps.TravelMode.DRIVING
		}, function (response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	}


</script>
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
				var
					c = (this.t != "") ? "<br/>" + this.t : "";
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


</body>
</html >


<!--<script>
ABQIAAAAr0bshN4cQiVOhgPo6Ypm7RTNsElaGkaOa0i523uXAdE31ey5aRSNPRly0nT7KWMJUpFhEb2m6u6xag
	$("#map<? /*= ++$i */ ?>") . gMap();

	$(function () {
		$("#map<? /*= $i */ ?>") . gMap({
			markers: [{
				latitude: <? /*= $location_latitude; */ ?>,
longitude: <? /*= $location_longitude; */ ?>,
html: "<? /*= $location_location; */ ?>",
popup: true
}],
zoom: 15
});
});
</script>
<
script >
function initMap() {
	var uluru = {lat: -25.363, lng: 131.044};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 4,
		center: uluru
	});


	var marker = new google.maps.Marker({
		position: uluru,
		map: map,
		title: 'Uluru (Ayers Rock)'
	});
	marker.addListener('click', function () {
		infowindow.open(map, marker);
	});
}
</script>-->