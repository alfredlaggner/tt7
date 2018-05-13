<!-- !collections products -->
<? $i = 0 ?>
<? if ($all_classes) : foreach ($all_classes as $row) : ?>
	<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>

	<div id="capslide_img_cont<?= $i ?>" class="sg-8 collection-product  ic_container "><a
			class="collection-product-thumb" href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>"><img
				src="<?= $picture ?> " height="223" width="223" alt="product title"/>
			<div class="overlay" style="display:none;"></div>
		</a>
		<div class="line"></div>
		<div class="collection-product-description"><a href="<?= site_url() . "tt_v1/product/" . $row->activity_id ?>">
				<?= $row->name ?>
			</a>
			<div class="collection-product-description-price"><span>$</span>
				<?= $row->rate_price_price ?>
			</div>
		</div>
		<div class="line"></div>
	</div>
	<? $i++ ?>
<? endforeach ?>
<? else : ?>
	<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose from another group. </p>
<? endif ?>

