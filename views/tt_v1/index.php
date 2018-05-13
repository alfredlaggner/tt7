<style>
	.modalDialog:target {
		opacity: 1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 33px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0, 0, 0, 0.8);
		z-index: 99999;
		opacity: 0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover {
		background: #00d9ff;
	}
</style>

<script type="text/javascript">
	function MM_openBrWindow(theURL, winName, features) { //v2.0
		window.open(theURL, winName, features);
	}

	function actuateLink(link) {
		var allowDefaultAction = true;

		if (link.click) {
			link.click();
			return;
		}
		else if (document.createEvent) {
			var e = document.createEvent('MouseEvents');
			e.initEvent(
				'click'     // event type
				, true      // can bubble?
				, true      // cancelable?
			);
			allowDefaultAction = link.dispatchEvent(e);
		}

		if (allowDefaultAction) {
			var f = document.createElement('form');
			f.action = link.href;
			document.body.appendChild(f);
			f.submit();
		}
	}
</script>


<!--<body <?= $region_set ?> -->
<!-- !top-bar

 -->

<div id="top-bar">
	<div id="top-bar-content">
            <span id="top-bar-content-user">

<!--                logged in as <a href="javascript:void(0)"></a> (<a href="javascript:void(0)">logout</a>)
                Not logged in <a href="javascript:void(0)"></a>  (<a href="javascript:void(0)"> login </a>)
-->            </span>
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

				<div id="xhome-slider-photo-price">
					<? $i = 0 ?>
					<? if ($home_sliders) : foreach ($home_sliders as $row) : ?>
						<? if ($i == 0) : ?>
							<!--                        <div id="home-slider-photo-price-<?= $i ?>" class="home-slider-photo-price">
                            <span></span><?= $row->slogan ?>
                        </div>
-->
						<? else : ?>
							<!--                        <div id="home-slider-photo-price-<?= $i ?>" class="home-slider-photo-price home-slider-photo-price-unsel">
                            <span></span><?= $row->slogan ?>
                        </div>
-->                    <? endif ?>
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
			<div class="scroll-pane">
				<div id="home-intro-content">
					<h3>Treks and Tracks</h3>
					<p>"Our Treks and Tracks guides were fabulous! They were incredibly knowledgeable and skilled, super
						nice and friendly, and very helpful in instructing me about rock climbing. I had a great
						experience and would definitely go back. Also, they provided all of the gear, including shoes,
						which was great."<br>October 26, 2011
					</p>
				</div>
			</div>

			<a id="home-intro-cta"
			   onClick="MM_openBrWindow('<?= site_url() . "menu_pages/" ?>testimonials','testimonials','toolbar=yes,menubar=yes,resizable=yes,width=600,height=600')">Read
				more<span></span></a>
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
			<a name="classes"></a>
			<h3 class="title">Our Activities <? if ($region_name) echo "in " . $region_name ?></h3>

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
				<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
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
						<div class="collection-product-description-price">
							<span><?= $row->rate_price_price == '0.00' ? '' : '$' ?></span>
							<?= $row->rate_price_price == '0.00' ? '  Please Call ' : $row->rate_price_price ?>
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
		<div class="go_top"><p><a href="#top">go top</a></p></div>

		<!-- Gear -->

		<!--             <div class="sg-35">
                <div class="line"></div>
                 <a name="gear"></a>        
            	<h3 class="title">Gear</h3>
               
				<div class="product_categories">
				
				<a onClick="xajax_getGears(0);return false;"  >All </a> &bull;
				<? if ($gear_groups) : foreach ($gear_groups as $gear_group) : ?>
				<a onClick="xajax_getGears(<?= $gear_group->gear_group_id ?>);return false;"><?= $gear_group->name ?>  </a> &bull;
				<? endforeach; endif ?>
				</div>
                <div class="line"></div>
				
            </div>
            
			<div id="gear_display">
				<? $i = 0 ?>
				<? if ($all_gears) : foreach ($all_gears as $gear) : ?>
				<? $picture = base_url() . GEARS_IMAGE_DIR . strtoupper($gear->code) . '/' . strtoupper($gear->code) . '1.jpg'; ?>
				<div id="capslide_img_cont<?= $i ?>" class="sg-8 collection-product  ic_container "> <a  class="collection-product-thumb" href="<?= site_url() . "tt_v1/gear/" . $gear->gear_id ?>"><img  src="<?= $picture ?> " height="223" width="223" alt="product title" />
						<div class="overlay" style="display:none;"></div>
						</a>
						<div class="line"></div>
						<div class="collection-product-description"> <a href="<?= site_url() . "tt_v1/gear/" . $gear->gear_id ?>">
								<?= $gear->name ?>
								</a>
								<div class="collection-product-description-price"> <span>$</span>
										<?= '10.99' ?>
								</div>
						</div>
						<div class="line"></div>
                        </div>
				<? $i++ ?>
				<? endforeach ?>
<? else : ?>
<p style="margin-left:15px; font-weight:bold;"> No gear in this group found! Please choose from another group. </p>
				<? endif ?>
  </div>          
            <div class="clear"></div>
<div class="go_top"><p><a href="#top">go top</a></p></div>
-->

		<!-- End Gear -->

		<!-- !line -->
		<? $this->load->view('tt_v1/blocks/footer_boxes'); ?>
		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<? $this->load->view('tt_v1/blocks/footer'); ?>
	</div>
</div>

</body>
</html>