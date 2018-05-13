<? $i = 0 ?>
<? if ($all_classes) : foreach ($all_classes as $row) : ?>
	<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
	<div class="col-lg-4 col-md-6">
		<a	href="<?= site_url() . 'tt_v3/activity_detail/' . $row->activity_id ?>">
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
		</article></a>
	</div>
	<? $i++ ?>

<? endforeach ?>
<? else : ?>
	<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose
		from
		another group. </p>
<? endif ?>
