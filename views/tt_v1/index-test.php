<body>
<? $i = 0 ?>
<? if ($all_classes) : foreach ($all_classes as $row) : ?>
	<script type="text/javascript">
		$(function () {
			$("#capslide_img_cont<?= $i ?>").capslide({
				caption_color: 'black',
				caption_bgcolor: 'white',
				overlay_bgcolor: '#CE9B9B',
				border: '1px solid #CE9B9B',
				showcaption: false
			});
		});
	</script>
	<? $i++ ?>
<? endforeach; endif ?>

<!-- !top-bar -->
<div id="top-bar">
	<div id="top-bar-content">
            <span id="top-bar-content-user">
                logged in as <a href="javascript:void(0)">Adam</a> (<a href="javascript:void(0)">logout</a>)
            </span>
		<a href="cart.html" id="top-bar-checkout">checkout</a>
		<span id="top-bar-content-items">you have 4 products in your cart</span>
	</div>
</div>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<? $this->load->view('tt_v1/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<!-- !home-slider -->
		<section id="home-slider" class="sg-23">

			<div id="home-slider-photo">

				<? $i = 0 ?>
				<? if ($home_sliders) : foreach ($home_sliders as $row) :
					$picture = base_url() . CLASSES_IMAGE_DIR . "home_slider" . '/' . $row->picture ?>
					<? if ($i == 0) : ?>
					<img id="home-slider-photo-0" class="home-slider-photo preload" src="<?= $picture ?>" alt=""/>
				<? else : ?>
					<img id="home-slider-photo-<?= $i ?>" class="home-slider-photo preload home-slider-photo-unsel"
					     src="<?= $picture ?>" alt=""/>
				<? endif ?>
					<? $i++ ?>
				<? endforeach; endif ?>

				<div id="home-slider-photo-price">
					<? $i = 0 ?>
					<? if ($home_sliders) : foreach ($home_sliders as $row) : ?>
						<? if ($i == 0) : ?>
							<div id="home-slider-photo-price-<?= $i ?>" class="home-slider-photo-price">
								<span>only</span><?= $row->order ?>
							</div>

						<? else : ?>
							<div id="home-slider-photo-price-<?= $i ?>"
							     class="home-slider-photo-price home-slider-photo-price-unsel">
								<span>only</span><?= $row->order ?>
							</div>
						<? endif ?>
						<? $i++ ?>
					<? endforeach; endif ?>
				</div>

				<script type="text/javascript">
					<? $i = 0 ?>
					<? if ($home_sliders) : foreach ($home_sliders as $row) : ?>
					app.slider.vars.productUrl[<?= $i ?>] = '<?= site_url() . $row->link  ?>';
					<? $i++ ?>
					<? endforeach; endif ?>

				</script>

				<a id="home-slider-photo-info" href="javascript:void(0)">more info</a>

			</div>

			<div id="home-slider-description">
				<? $i = 0 ?>
				<? if ($home_sliders) : foreach ($home_sliders as $row) : ?>
					<? if ($i == 0) : ?>
						<div id="home-slider-description-<?= $i ?>" class="home-slider-description">
							<h2><?= $row->name ?></h2>
							<p><?= $row->description_short ?></p>
						</div>

					<? else : ?>
						<div id="home-slider-description-<?= $i ?>"
						     class="home-slider-description  home-slider-description-unsel">
							<h2><?= $row->name ?></h2>
							<p><?= $row->description_short ?></p>
						</div>
					<? endif ?>
					<? $i++ ?>
				<? endforeach; endif ?>
			</div>

			<div id="home-slider-bottom">
				<a href="javascript:void(0)" id="home-slider-bottom-right"></a>
				<a href="javascript:void(0)" id="home-slider-bottom-left"></a>
				<div id="home-slider-bottom-indexes"></div>
			</div>

		</section>

		<!-- !home intro -->
		<div id="home-intro" class="sg-11">
			<div id="home-intro-content">
				<h3>Treks and Tracks</h3>
				<p> We offer outdoor education courses through our Mountain School as well as horsepacking trips and
					sailing expeditions.<br>
					It is our mission to bring likeminded people into the wild places of the world. We believe that
					expeditions that blend ancient means of travel and modern sports (sailing/surfing and horseback
					riding/climbing) inspire us to connect with the natural world.
				</p>
			</div>

			<a href="#" id="home-intro-cta">Read more<span></span></a>
		</div>


		<? $featured = $this->config->item('display_featured_products'); ?>
		<? if ($featured) : ?>
			<!-- !line -->
			<div class="sg-35 line"></div>
			<!-- !featured -->
			<h3 class="sg-35 title">featured products</h3>
		<? endif ?>

		<? if ($records and $featured) : foreach ($records as $row) : ?>
		<!-- !data -->
		<script type="text/javascript">

			// add image & values


			var productId;

			// product 1

			<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $row->picture ?>
			productId = <?= $row->activity_id ?>;

			app.isotope.vars.homeFeaturedImages[productId] = ['<?= $picture ?>',

				'<?= base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) ?>2.jpg', '<?= base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) ?>3.jpg', '<?= base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) ?>4.jpg'];
			app.isotope.vars.homeFeaturedProducts[productId] = {
				name: "<?= $row->name ?><br>click for more info",
				price: "<?= $row->rate_price_price ?>",
				url: '<?= site_url() . "tt_v1/product/" . $row->activity_id ?>'
			};
			<? endforeach; endif ?>
		</script>

		<!-- !home-featured -->
		<section class="sg-35">

			<div id="home-featured">

				<? if ($records and $featured) : foreach ($records as $row) : ?>
					<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $row->picture ?>
					<div class="home-featured-item" id="home-featured-item-id:<?= $row->activity_id ?>"><img
							class="home-featured-item-thumb preload" src="<?= $picture ?>" alt=""/></div>
				<? endforeach; endif ?>
			</div>

		</section>
		<div class="sg-35">
			<div class="line"></div>
			<h3 class="sg-35">our classes</h3>
			<div class="product_categories">

				<a onClick="xajax_getProducts(0);return false;">All </a> &bull;
				<? if ($styles) : foreach ($styles as $style) : ?>
					<a onClick="xajax_getProducts(<?= $style->style_id ?>);return false;"><?= $style->name ?>  </a> &bull;
				<? endforeach; endif ?>
			</div>
			<div class="line"></div>

		</div>

		<!-- !collections products -->
		<div id="product_display">
			<? $i = 0 ?>
			<? if ($all_classes) : foreach ($all_classes as $row) : ?>
				<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $row->picture; ?>
				<div id="capslide_img_cont<?= $i ?>" class="sg-8 collection-product  ic_container "><a
						class="collection-product-thumb"
						href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>"><img src="<?= $picture ?> "
				                                                                             height="223" width="223"
				                                                                             alt="product title"/>
						<div class="overlay" style="display:none;"></div>
					</a>
					<div class="line"></div>
					<div class="collection-product-description"><a
							href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>">
							<?= $row->name ?>
						</a>
						<div class="collection-product-description-price"><span>$</span>
							<?= $row->rate_price_price ?>
						</div>
					</div>
					<div class="line"></div>
					<!--						<div class="ic_caption">
								<p class="ic_category"> </p>
								<h3>
										<?= $row->name ?>
								</h3>
								<p class="ic_text"> Price: $
										<?= $row->rate_price_price ?>
								</p>
						</div>
-->                </div>
				<? $i++ ?>
			<? endforeach ?>
			<? else : ?>
				<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose from another
					group. </p>
			<? endif ?>
		</div>
		<div class="clear"></div>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<div class="sg-11 bottom-box">
			<div id="bottom-box-latest-post" class="bottom-box-content">
				<h4>latest from the blog</h4>
				<p id="bottom-box-latest-post-date">11.24.2011</p>
				<h5><a href="article.html">Vestibulum ante ipsum primis in faucibus orci.</a></h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu
					sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in
					nulla enim. Phasellus </p>
			</div>
		</div>
		<div class="sg-11 bottom-box">
			<div id="bottom-box-twitter-socials" class="bottom-box-content">
				<h4>twitter</h4>
				<cite>Etiam at risus et justo dignissim congue.</cite>
				<div id="bottom-box-twitter-socials-icons">

					<a href="https://twitter.com/#!/designofseven" class="twitter-icon social-icon"></a>
					<a href="http://www.facebook.com/luglio7" class="facebook-icon social-icon"></a>
					<a href="http://www.vimeo.com" class="vimeo-icon social-icon"></a>

				</div>
			</div>
		</div>
		<div class="sg-11 bottom-box">
			<div id="bottom-box-newsletter" class="bottom-box-content">
				<h4>contact us</h4>
				<p>Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a
					porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus
					vestibulum faucibus eget in metus.</p>
			</div>
		</div>
		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<? $this->load->view('tt_v1/blocks/footer'); ?>
	</div>
</div>

</body>
</html>