<body>
<? $i = 0 ?>
<? if ($records) : foreach ($records as $row) : ?>
	<script type="text/javascript">
		$(function () {
			$("#capslide_img_cont<?= $i ?>").capslide({
				caption_color: 'black',
				caption_bgcolor: 'white',
				overlay_bgcolor: '#CE9B9B',
				border: '1px solid #CE9B9B',
				showcaption: true
			});
		});
	</script>
	<? $i++ ?>
<? endforeach; endif ?>

<!-- !top-bar -->
<div id="top-bar">
	<div id="top-bar-content"><span id="top-bar-content-user"> logged in as <a href="javascript:void(0)">Adam</a> (<a
				href="javascript:void(0)">logout</a>) </span> <a href="../../../akaishi/html/cart.html"
	                                                             id="top-bar-checkout">checkout</a> <span
			id="top-bar-content-items">you have 4 products in your cart</span></div>
</div>

<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<? $this->load->view('tt_v1/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<!-- !collections top -->
		<div id="collection-top" class="sg-35">
			<div class="collection-top-filter">
				<select data-placeholder="type" style="width: 120px">
					<option value=""></option>
					<option id="collection-top-filter-url:collection.html?filter=1" value="shirts">Shirts</option>
					<option id="collection-top-filter-url:collection.html?filter=2" value="posters">Posters</option>
					<option id="collection-top-filter-url:collection.html?filter=3" value="prints">Prints</option>
				</select>
			</div>
			<div class="collection-top-filter">
				<select data-placeholder="brand" style="width: 120px">
					<option value=""></option>
					<option id="collection-top-filter-url:collection.html?filter=4" value="">Nike</option>
					<option id="collection-top-filter-url:collection.html?filter=5" value="">Adidas</option>
					<option id="collection-top-filter-url:collection.html?filter=6" value="">Apple</option>
				</select>
			</div>
			<div class="collection-top-filter">
				<select data-placeholder="tag" style="width: 120px">
					<option value=""></option>
					<option id="collection-top-filter-url:collection.html?filter=7" value="white">white</option>
					<option id="collection-top-filter-url:collection.html?filter=8" value="yellow">yellow</option>
					<option id="collection-top-filter-url:collection.html?filter=9" value="lorem">lorem</option>
					<option id="collection-top-filter-url:collection.html?filter=10" value="ipsum">ipsum</option>
				</select>
			</div>
			<ul id="collection-top-menu">
				<li class="sel"><a href="#">lorem</a></li>
				<li><a href="#">ipsum</a></li>
			</ul>
		</div>
		<div class="sg-35">
			<div class="line"></div>
			<h2 id="collection-title">Our Collections</h2>
			<div class="line"></div>
		</div>

		<!-- !collections products -->

		<!--				 <? if ($records) : foreach ($records as $row) : ?>
 			<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $row->picture;
			?>
            <div class="sg-8 collection-product focus-box">
                <a class="collection-product-thumb" href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>"><img  src="<?= $picture ?> "  alt="product title" /></a>
                <div class="line"></div>
                <div class="collection-product-description">
                    <a href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>"><?= $row->name ?></a>
                    <div class="collection-product-description-price">
                        <span>$</span>
                        <?= $row->rate_price_price ?>
                    </div>
                </div>
                <div class="line"></div>
            </div>
<? endforeach; endif ?>
-->
		<div class="clear"></div>
		<? $i = 0 ?>
		<? if ($records) : foreach ($records as $row) : ?>
			<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . $row->picture; ?>
			<div id="capslide_img_cont<?= $i ?>" class="sg-8 collection-product  ic_container "><a
					class="collection-product-thumb"
					href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>"><img src="<?= $picture ?> "
			                                                                             height="223" width="223"
			                                                                             alt="product title"/>
					<div class="overlay" style="display:none;"></div>
				</a>
				<!--						<div class="line"></div>
						<div class="collection-product-description"> <a href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>">
								<?= $row->name ?>
								</a>
								<div class="collection-product-description-price"> <span>$</span>
										<?= $row->rate_price_price ?>
								</div>
						</div>
						<div class="line"></div>
-->
				<div class="ic_caption">
					<p class="ic_category"></p>
					<h3>
						<?= $row->name ?>
					</h3>
					<p class="ic_text"> Price: $
						<?= $row->rate_price_price ?>
					</p>
				</div>
			</div>
			<? $i++ ?>
		<? endforeach; endif ?>
		<div class="line"></div>
	</div>
	<div class="clear"></div>
	<div id="pagination" class="sg-35">
		<?= $this->pagination->create_links(); ?>
	</div>

	<!-- !PAGE-CONTENT-END -->

	<!-- !line -->
	<? $this->load->view('tt_v1/blocks/footer'); ?>
</div>
</div>
</body>
</html>