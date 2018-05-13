<body>
<!-- !top-bar -->

<link type="text/css" href="<?= base_url() ?>js_tt/css/south-street/jquery-ui-1.8.18.custom.css" rel="Stylesheet"/>
<script type="text/javascript" src="<?= base_url() ?>js_tt/js/jquery-ui-1.8.18.custom.min.js"></script>
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

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<? $this->load->view('tt_v1/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->
		<? if ($error) : ?>
			<h3 style="margin-left:20px">  <?= $error ?> <?= $error_text ?> </h3>
		<? endif ?>
		<div id="product-image" class="sg-17">
			<? foreach ($records as $row) : ?>
			<? foreach ($pictures as $picture) : ?>
				<? $picture = base_url() . GEARS_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '2.jpg'; ?>

				<a rel="shadowbox[gallery]" href="<?= $picture ?>"> <img src="<?= $picture ?>" class="preload" alt=""/></a>
				<? break ?>
			<? endforeach ?>
			<div id="product-image-price">
				<div id="product-image-price-valuta">$</div>
				<div id="product-image-price-value">
					<?= $row->price ?>
				</div>
			</div>
		</div>
		<div id="product-description" class="sg-17">
			<h1>
				<?= $row->name ?>
			</h1>
			<div id="product-description-data">
				<div class="line"></div>
				<div class="product-description-data-row"><span
						class="product-description-data-row-label">level</span><span>
					<!--<?= $row->service_level_name ?>-->
					</span></div>
				<div class="product-description-data-row"><span
						class="product-description-data-row-label">style</span><span>
					<!--<?= $row->gear_Groupname ?>-->
					</span></div>
				<div class="line"></div>
				<div class="product-description-data-row"><span
						class="product-description-data-row-label">challenge</span><span>
					<!--<?= $row->physical_level_name ?>-->
					</span></div>
				<div class="product-description-data-row"><span
						class="product-description-data-row-label">age</span><span>
					<!--<?= $row->age_min ?>-->
					</span></div>
				<div class="line"></div>

				<div id="product-description-data-thumbs">
					<? $i = 1; ?>
					<? foreach ($pictures as $picture) : ?>
						<? if ($i > 1 and $i <= 5) : ?>
							<? $picture = base_url() . GEARS_IMAGE_DIR . strtoupper($row->code) . '/' . $picture->picture ?>
							<a rel="shadowbox[gallery]" href="<?= $picture ?>"><img width="100" class="preload"
							                                                        src="<?= $picture ?>" alt=""/></a>
						<? endif ?>
						<? $i++ ?>
					<? endforeach ?>
				</div>
			</div>
		</div>

	<!-- !line -->
		<div class="clear"></div>
		<div class="sg-35 line"></div>
		<div class="sg-35">

			<!--			<div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ed647e85c970dff"></script> 
			-->        </div>
		<div class="sg-22">
			<div class="line"></div>
			<h3 class="title">
				<?= $row->slogan ?>
			</h3>
			<div id="product-description-text">
				<p><?= $row->description_long ?></p>
			</div>
		</div>
		<div class="sg-12">
			<div class="line"></div>

			<div class="product-description-data-row-goals"><span class="product-description-data-row-label">What’s Great</span><span>
					<?= $row->description_detailled ?></span></div>
			<div class="line"></div>
			<div class="product-description-data-row-goals"><span
					class="product-description-data-row-label">locations</span><span>
			</div>
		</div>


		<div class="clear"></div>

		<div class="sg-11 bottom-box">
			<div class="bottom-box-content">
				<h3>What to expect</h3>
				<!--<?= $row->to_expect ?>-->
			</div>
		</div>
		<div class="sg-11 bottom-box">
			<div class="bottom-box-content">
				<h3>We provide</h3>
				<!--<?= $row->we_provide ?>-->
			</div>
		</div>
		<div class="sg-11 bottom-box">
			<div class="bottom-box-content">
				<h3>You bring</h3>
				<!--<?= $row->they_bring ?>-->
			</div>
		</div>
	<? endforeach // $records as $row?>
		<!-- !line -->
		<div class="clear"></div>
		<div class="sg-35 line"></div>
		<div class="sg-35 sg-no-margin-bottom">
			<h3 class="title">Related Products</h3>
		</div>
		<? foreach ($gears_related as $related) : ?>
			<? $picture = base_url() . GEARS_IMAGE_DIR . strtoupper($related->code) . '/' . $related->picture; ?>
			<div class="sg-8 collection-product focus-box"><a
					href="<?= site_url() . "tt_v1/gear/" . $related->gear_id ?>"><img src="<?= $picture ?>"
			                                                                          class="preload"
			                                                                          alt="<?= $related->name ?>"/></a>
				<div class="line"></div>
				<div class="collection-product-description"><? $related->slogan ?><a
						href="<?= site_url() . "tt_v1/gear/" . $related->gear_id ?>"><?= $related->name ?></a>
					<div class="collection-product-description-price"><span>$</span><?= $related->price ?></div>
				</div>
			</div>
		<? endforeach ?>

		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<? $this->load->view('tt_v1/blocks/footer'); ?>
		<!--</div>
		</div>
		-->
</body>
</html>