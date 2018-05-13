<?= $head ?>
<body>
<?= $header ?>
<section class="section-promo" id="section-main">
	<div class="container">
		<div class="section-promo-txt">
			<h1>Come with us!</h1>
			<li>Backpacking Tours</li>
			<li>Rock Climbing</li>
			<li>Survival Classes</li>
			<li>Summer Classes for Children</li>
			<div class="btns-group"><a href="#" class="btn btn-inverse">Find out more</a></div>
		</div>
		<div class="section-promo-pic"><img src="/bootstrap4/content/316591_10150293849480666_148987571_n.jpg" alt="">
		</div>
	</div>
</section>
<section class="section" id="section-activities">
	<div class="container">
		<!--        				<header class="title-section">-->
		<!--        						<h3>Choose what's best for you!</h3>-->
		<!--        						<div class="sub">This is what we do</div>-->
		<!--        			</header>-->

		<div class="btns-group">
			<? if ($styles) : ;
				foreach ($styles as $style) : ;
					?>
					<a role="button" class="btn btn-sm btn-primary "
					   onClick="xajax_getProducts(<?= $style->style_id ?>);return false;" href="#">
						<?= $style->name ?>
					</a>
				<? endforeach; endif ?>
			<a href="#" role="button" class="btn btn-sm btn-primary"
			   onClick="xajax_getProducts(0);return false;">All </a></div>
		<div class="row">
			<div id="product_display">
				<? $i = 0 ?>
				<? if ($all_classes) : foreach ($all_classes as $row) : ?>
					<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
					<div class="col-lg-4 col-md-6">
						<article class="card-item" style="background-image: url(' <?= $picture ?>');"><img
								class="card-item-pic" src="<?= $picture ?>" alt="">
							<div class="card-item-hover"><a
									href="<?= site_url() . 'tt_v3/activity_detail/' . $row->activity_id ?>"
									class="btn btn-inverse-colored">Continue

								</a></div>
							<header class="card-item-caption">
								<h4>
									<?= $row->name ?><br><span
										style="font-weight: normal">  $ <?= $row->rate_price_price ?></span>
								</h4>
							</header>
						</article>
					</div>
					<? $i++ ?>

				<? endforeach ?>
				<? else : ?>
					<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose from
						another group. </p>
				<? endif ?>
			</div>
		</div>
	</div>
</section>
</body>
<?= $footer ?>
</html>
