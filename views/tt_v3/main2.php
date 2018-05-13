<?= $head ?>
<body xmlns="http://www.w3.org/1999/html">
<style>
	.carousel .carousel-item {
		width: 100%; /*slider width*/
		max-height: 400px; /*slider height*/
	}

	.carousel .carousel-item img {
		width: 100%; /*img width*/
	}

	/*full width container*/
	@media (max-width: 767px) {
		.block {
			margin-left: -20px;
			margin-right: -20px;
		}
	}

	/*
	inspired from http://codepen.io/Rowno/pen/Afykb
	*/
	.carousel-fade .carousel-inner .carousel-item {
		opacity: 0;
		transition-property: opacity;
	}

	.carousel-fade .carousel-inner .active {
		opacity: 1;
	}

	.carousel-fade .carousel-inner .active.left,
	.carousel-fade .carousel-inner .active.right {
		left: 0;
		opacity: 0;
		z-index: 1;
	}

	.carousel-fade .carousel-inner .next.left,
	.carousel-fade .carousel-inner .prev.right {
		opacity: 1;
	}

	.carousel-fade .carousel-control {
		z-index: 2;
	}

	/*
	WHAT IS NEW IN 3.3: "Added transforms to improve carousel performance in modern browsers."
	now override the 3.3 new styles for modern browsers & apply opacity
	*/
	@media all and (transform-3d), (-webkit-transform-3d) {
		.carousel-fade .carousel-inner > .item.next,
		.carousel-fade .carousel-inner > .item.active.right {
			opacity: 0;
			-webkit-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}

		.carousel-fade .carousel-inner > .item.prev,
		.carousel-fade .carousel-inner > .item.active.left {
			opacity: 0;
			-webkit-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}

		.carousel-fade .carousel-inner > .item.next.left,
		.carousel-fade .carousel-inner > .item.prev.right,
		.carousel-fade .carousel-inner > .item.active {
			opacity: 1;
			-webkit-transform: translate3d(0, 0, 0);
			transform: translate3d(0, 0, 0);
		}
	}
</style>

<?= $header ?>

<section class="block">
	<div id="myCarousel" class="carousel slide  carousel-fade" data-ride="carousel" data-interval="15000">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<? $i = 0 ?>
			<? if ($activity_groups) : ;
				foreach ($activity_groups as $row) : ;
					?>
					<? if ($i == 0) : ?>
						<li data-target="#myCarousel" data-slide-to="<?= $i ?>" class="active"></li>
					<? else : ?>
						<li data-target="#myCarousel" data-slide-to="<?= $i ?>"></li>
					<? endif ?>
					<? $i++ ?>
				<? endforeach; endif ?>

		</ol>
		<!--    <div class="container">-->
		<!-- Wrapper for slides -->

		<!--        <div id="myCarousel" class="carousel slide">-->
		<div class="carousel-inner" role="listbox">

			<? $i = 0 ?>
			<? if ($activity_groups) :;
			foreach ($activity_groups as $row) :;
			?>
			<? if ($i == 0) : ?>
			<div class="carousel-item active">
				<? else : ?>
				<div class="carousel-item">
					<? endif ?>
					<img src="<?= base_url() ?>images/<?= $row['picture'] ?>" width="100%" alt="First slide">
					<div class="carousel-caption">
						<h1><?= $row['slogan'] ?></h1>
						<h3><?= $row['name'] ?></h3>
						<p><?= $row['description'] ?></p>
					</div>
				</div>
				<? $i++ ?>
				<? endforeach;
				endif ?>

			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<!--            </div>-->
		<button type="button" id="myBtn2" class="btn btn-sm" id="myBtn">Stop slide</button>
	</div>
</section>
<section class="section" id="section-activities">
	<div class="container">
		<div class="row">
			<div class="btns-group">
				<? if ($activity_groups) : ;
					foreach ($activity_groups as $row) : ;
						?>
<!--						<div class="col-sm-12">-->

							<a type="button" class="btn btn-sm btn-fill "
							   onClick="xajax_getProducts(<?= $row['id'] ?>);return false;" href="#">
								<?= $row['name'] ?>
							</a>
<!--						</div>-->

					<? endforeach; endif ?>
			</div>
		</div>
		<div class="row">
			<div id="product_display">
				<? $i = 0 ?>
				<? if ($all_classes) : foreach ($all_classes as $row) : ?>
					<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
					<div class="col-lg-4 col-md-6">
						<a href="<?= site_url() . 'tt_v3/activity_detail/' . $row->activity_id ?>">
							<article class="card-item" style="background-image: url(' <?= $picture ?>');"><img
									class="card-item-pic" src="<?= $picture ?>" alt="">
								<div class="card-item-hover">
									<span style="display: block; margin: 3px;"><?= $row->description_short ?></span>
								</div>
								<header class="card-item-caption">
									<h4>
										<?= $row->name ?><!--<br><span-->
										<!--                                       style="font-weight: normal">  $ -->
										<? //= $row->rate_price_price ?><!--</span>-->
									</h4>
								</header>
							</article>
						</a>
					</div>
					<? $i++ ?>

				<? endforeach ?>
				<? else : ?>
					<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose
						from
						another group. </p>
				<? endif ?>
			</div>
		</div>
	</div>
</section>
<?= $footer ?>
<script>
	$(document).ready(function () {
		// Activate Carousel
		$("#myCarousel").carousel();
		// Click on the button to stop sliding

		$("#myBtn2").click(function () {
			$("#myCarousel").carousel("pause");
		});

		// Enable Carousel Indicators
		$(".item1").click(function () {
			$("#myCarousel").carousel(0);

		});
		$(".item2").click(function () {
			$("#myCarousel").carousel(1);
		});
		$(".item3").click(function () {
			$("#myCarousel").carousel(2);
		});
		$(".item4").click(function () {
			$("#myCarousel").carousel(3);
		});

		// Enable Carousel Controls
		$(".left").click(function () {
			$("#myCarousel").carousel("prev");
			$("#myCarousel").carousel("cycle");

		});
		$(".right").click(function () {
			$("#myCarousel").carousel("next");
			$("#myCarousel").carousel("cycle");
		});

		$('#myCarousel').on('slide.bs.carousel', function () {
				currentIndex = $('div.active').index();

				<? for ($x = 0; $x < count($activity_groups); $x++) :  ?>

				if (currentIndex == <?= $x  ?>) {
					<? if ($x + 1 >= count($activity_groups)) : ?>
					xajax_getProducts(<?= $activity_groups[0]['id'] ?>);
					<? else : ?>
					xajax_getProducts(<?= $activity_groups[$x + 1]['id'] ?>);
					<? endif ?>
				}

				<? endfor; ?>
			}
		)
	});
</script>
</body>
</html>
