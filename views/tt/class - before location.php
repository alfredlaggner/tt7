<? if (isset($coordinates)) : foreach ($coordinates as $coordinate) : ?>
	<script type="text/javascript"
	        src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		var map;
		function initialize() {
			var myOptions = {
				zoom: 8,
				center: new google.maps.LatLng(<?= $coordinate->latitude; ?>,  <?= $coordinate->longitude; ?>),
				mapTypeId: google.maps.MapTypeId.TERRAIN
			};
			map = new google.maps.Map(document.getElementById('map_canvas'),
				myOptions);

			var marker = new google.maps.Marker({
				map: map,
				position: map.getCenter()
			});
			var infowindow = new google.maps.InfoWindow();
			infowindow.setContent('<b><?= $coordinate->location; ?></b>');
			google.maps.event.addListener(marker, 'click', function () {
				infowindow.open(map, marker);
			});
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
<? endforeach; endif ?>
<!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
-->
<script>
	$(function () {
		$("#accordion").accordion({
			fillSpace: false,
			autoHeight: true,
			collapsible: true
		});
	});
</script>

<? $i = 1; ?>
<? foreach ($events as $event) : ?>
	<script>
		$(function () {
				$("#go_book<?= $i; ?>").click(showDialog<?= $i; ?> );
				$myWindow<?= $i; ?> = jQuery('#do_book<?= $i; ?>');
				//instantiate the dialog
				$myWindow<?= $i; ?>.dialog({
					show: 'slide',
					modal: true,
					height: 230,
					autoOpen: false
//                        width: 300,
//                        position: 'center',
//                        title:'Hello World',
//                       overlay: { opacity: 0.1, background: 'black'}
				});
			}
		);
		//function to show dialog   
		var showDialog<?= $i; ?> = function () {
			//if the contents have been hidden with css, you need this
			$myWindow<?= $i; ?>.show();
			//open the dialog
			$myWindow<?= $i; ?>.dialog("open");
		};
		;

		//function to close dialog, probably called by a button in the dialog
		//    var closeDialog = function() {
		//        $myWindow<?  //echo $i; ?>.dialog("close");
		//    }
	</script>
	<script type="text/javascript">
		$(function () {
			$('#promo_code<?= $i; ?>').blur(function () {

				var name = $('#promo_code<?= $i; ?>').val();

//	if (!name) {
//		alert('Please enter your name ');
////		return false;
//	}

				var form_data = {
					name: $('#activity_id').val(),
					email: $('#event_date').val(),
					message: $('#promo_code').val(),
					ajax: '1'
				};

				$.ajax({
					url: "<?= site_url('tt/verify_promo_code1'); ?>",
					type: 'POST',
					data: form_data,
					success: function (html) {
						if (html.msg == 'success') {
							var post_id = html.msg;
							alert(post_id);
						}
					}
				});

				return false;
			});
		});

	</script>
	<? $i++ ?>
<? endforeach ?>

<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>
-->

</head>

<body>

<!--<link href="../../../css/tt/style-greeny.css" rel="stylesheet" type="text/css" />
-->
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css"/>
<div class="body">
	<div class="body_resize">
		<div class="left">


			<? foreach ($records as $row) : ?>
				<? $image_name = 'images/' . strtoupper($row->code) . '/' . strtolower($row->code) . '-main.jpg'; ?>
				<h2><span><?= $row->name ?></span></h2>
				<img src="<?= base_url() . $image_name ?>" alt="img" width="250" height="400" class="floated"/>
				<p class="big bgline">
					<? echo $row->description_long ?>
				</p>
				<div class="blog">
					<h2>Is this class for you?</h2>
					<p>Class Style : <b><?= $row->style_name ?> </b></p>
					<p>Physical Level: <b><?= $row->physical_level_name ?></b></p>
					<p>Service Level: <b><?= $row->service_level_name ?> </b></p>
					<p>Minimum Age: <b><?= $row->age_min ?> </b></p>
					<p></p>
				</div>
			<? endforeach ?>
		</div>
		<div class="right">
			<div class="blog">
				<h2><span>Book a Class</span></h2>

				<div id="accordion">

					<? $i = 1; ?>
					<? $pre_month = '0'; ?>
					<? $is_month = '-1'; ?>
					<? foreach ($events as $event) : ?>
					<? $is_month = date('m', strtotime($event['event_date'])); ?>
					<? if ($is_month != $pre_month) : ?>
					<? if ($pre_month != 0) : ?>
				</div>    <!--AccordionPanelContent -->
				<? endif ?>
				<h3><a href="#"> <?= date('F, Y', strtotime($event['event_date'])); ?></a></h3>
				<div>
					<? $pre_month = date('m', strtotime($event['event_date'])); ?>
					<? endif ?>
					<a href="#" id="go_book<?= $i ?>">
						<div id="content-box1"> <?= date('D, M j', strtotime($event['event_date'])); ?> </div>
						<div
							id="content-box2"> <?= date('g:i', strtotime($event['event_time'])) . ' - '; ?> <?= date('g:i', strtotime($event['event_time']) + $event['duration'] * 3600); ?> </div>
						<div id="content-box3"> $<?= $event['rate_price']; ?> </div>
						<div id="content-box4"> <?= $event['available']; ?> </div>
					</a>
					<? $i++ ?>
					<? endforeach ?>
				</div>
				<!--Content -->
			</div>
			<!--AccordionPanel -->
		</div>
		<!-- Accordion -->
	</div>
	<!-- blog-->
	<div class="blog">
		<? $j = 1; ?>
		<? foreach ($events as $event) : ?>

			<div style=" padding: 0.4em; padding-left: 1.5em;  padding-right: 1.5em; display: none; "
			     id="do_book<?= $j ?>" title="Number of Students and Promo Code">
				<div id="customer_data">
					<p><? $attributes = array('id' => 'booking');
						echo form_open('tt/class_booking/' . $event['event_event_id'] . "/0", $attributes); ?>
						<? $max_part = $event['available'] ?>
					<fieldset>
						<div>
							<label for="participants">Choose number of students</label>
							<input type="hidden" name="event_date" id="event_date<?= $j ?>"
							       value="<?= $event['event_date']; ?>"/>
							<input type="hidden" name="event_id" id="event_id<?= $j ?>"
							       value="<?= $event['event_event_id']; ?>"/>
							<select type="input" class="text" name="participants" id="participants" value="1"/>
							<? for ($i = 1; $i <= $max_part; $i++): ?>
								<? if ($i == 1) $plural = ""; else $plural = "s"; ?>
								<option value="<?= $i ?>"><?= $i . " student" . $plural ?></option>
							<? endfor; ?>

							</select>
						</div>
					</fieldset>
					<fieldset>
						<div>
							<label for="promo_code">Enter discount code or Groupon code </label>
							<input type="text" class="text" onMouseOut="xajax_verify_promo_code()" size="10"
							       id="promo_code<?= $j ?>" name="promo_code" value="">
						</div>
					</fieldset>
					<div>
						<input type="submit" id="update<?= $j ?>" name="update<?= $j ?>" value="Continue"
						       class="submit"/>
					</div>
					</form>
					</p>
					<div id="ajax_message<?= $j ?>"></div>
				</div><!-- customer_data-->
			</div><!-- do_book-->
			<? $j++ ?>
		<? endforeach ?>

	</div>


</div><!--Right-->

<div class="clr"></div>
<div class="FBG">
	<div class="FBG_resize">
		<div class="blok">
			<h2><span>Location</span></h2>
			<? if (isset($locations)) : foreach ($locations as $location) : ?>
				<h3><?= $location->name ?></h3>
				<p> <?= $location->address ?></p>
				<p> <?= $location->city ?>, <?= $location->state ?></p>
			<? endforeach; endif ?>
			<div style="height:300px; width:330px;" id="map_canvas"></div>
		</div>
		<div class="blok">
			<h2><span>Equipment</span> to bring</h2>
			<? foreach ($equipments as $equipment) : ?>
				<?= $equipment->equipment ?>
			<? endforeach ?>
		</div>
		<div class="blok">
			<h2>Image Gallery</h2>
			<img src="<?= base_url() ?>images/greeny/banner_1.gif" alt="img" width="68" height="68"/><img
				src="<?= base_url() ?>images/greeny/banner_2.jpg" alt="img" width="68" height="68"/><img
				src="<?= base_url() ?>images/greeny/banner_3.jpg" alt="img" width="68" height="68"/><img
				src="<?= base_url() ?>images/greeny/banner_4.jpg" alt="img" width="68" height="68"/><img
				src="<?= base_url() ?>images/greeny/banner_5.jpg" alt="img" width="68" height="68"/><img
				src="<?= base_url() ?>images/greeny/banner_6.jpg" alt="img" width="68" height="68"/>
			<div class="clr"></div>
			<h2>Lorem ipsum </h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. </p>
		</div>
		<div class="clr"></div>
	</div>
</div>



