<? $i = 0 ?>
<? if ($all_classes) : foreach ($all_classes as $row) : ?>
	<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
	<div class="col-sms-6 col-sm-6 col-md-3">
		<article class="box">
			<!--<figure class="animated" data-animation-type="fadeInDown" data-animation-duration="1">--> <a
				href="<?= site_url() . 'tt2/product/' . $row->activity_id . '/photos_tab' ?>" title=""
				class="hover-effect"><img src=<?= $picture ?> alt="" width="270" height="160"/></a> </figure>
			<div class="details">
				<h4 class="box-title"><a href="<?= site_url() . 'tt2/product/' . $row->activity_id ?>"><?= $row->name ?>
						<small>Paris</small>
					</a></h4>
				<div><span class="price">$<?= $row->rate_price_price ?></span></div>
			</div>
			<hr>
			<div class="text-center">
				<div class="times"><i class="soap-icon-clock yellow-color"></i> <span>01 Nov 2014 - 08 Nov 2014</span>
				</div>
			</div>
			<a href="<?= site_url() . 'tt2/product_booking1/' . $row->activity_id ?>"
			   class="button btn-small full-width">BOOK NOW</a>
		</article>
	</div>
	<? $i++ ?>
<? endforeach ?>
<? else : ?>
	<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose from another group. </p>
<? endif ?>