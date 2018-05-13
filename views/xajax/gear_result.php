<!-- !collections products -->
<? $i = 0 ?>
<? if ($all_gears) : foreach ($all_gears as $gear) : ?>
	<? $picture = base_url() . GEARS_IMAGE_DIR . strtoupper($gear->code) . '/' . strtoupper($gear->code) . '1.jpg'; ?>

	<div id="capslide_img_cont<?= $i ?>" class="sg-8 collection-product  ic_container "><a
			class="collection-product-thumb" href="<?= site_url() . "tt2/gear/" . $gear->gear_id ?>"><img
				src="<?= $picture ?> " height="223" width="223" alt="product title"/>
			<div class="overlay" style="display:none;"></div>
		</a>
		<div class="line"></div>
		<div class="collection-product-description"><a href="<?= site_url() . "tt2/gear/" . $gear->gear_id ?>">
				<?= $gear->name ?>
			</a>
			<div class="collection-product-description-price"><span>$</span>
				<?= '10.99' ?>
			</div>
		</div>
		<div class="line"></div>
	</div>
	<? $i++ ?>
<? endforeach ?>
<? else : ?>
	<p style="margin-left:15px; font-weight:bold;"> No gear in this group found! Please choose another group. </p>
<? endif ?>

