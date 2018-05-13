<body>

<!-- !top-bar -->
<?= $region_name ?>
<!-- !wrapper -->
<div id="wrapper">
	<div id="container">

		<!-- !header -->
		<? $this->load->view('tt_v1/blocks/header'); ?>

		<!-- !line -->
		<div class="sg-35 line"></div>

		<!-- !PAGE-CONTENT -->

		<article id="blog-post" class="sg-23">

			<h1>Treks and Tracks Guides</h1>
			<div class="line"></div>
			<? $i = 1; ?>
			<? if (isset($records)) : foreach ($records as $row) : ?>
			<div id="blog-post-content<?= $i++ ?>">
				<? if ($row->picture) : ?>
					<img class="guides_large" src="<?= base_url() . PAGES_IMAGE_DIR ?><?= $row->picture ?>"
					     alt="Guide Picure" align="left">
				<? endif ?>
				<h3><a name="<?= $row->first_name ?>"></a>
					<?= $row->first_name ?>
					<?= $row->last_name ?>
					<br/>
						<span>
						<?= $row->subtitle ?>
						</span></h3>
				<? if ($row->slogan) : ?>
					<p><em>&quot;
							<?= $row->slogan ?>
							&quot;</em></p>
				<? endif ?>
				<p>&nbsp;</p>
				<p>
					<?= $row->bio ?>
					<? if ($row->is_amga) : ?>
						<img src="<?= base_url() . PAGES_IMAGE_DIR ?>amga_spi.jpg" alt="AMGA certified guides"
						     width="133" height="170" align="right"/>
					<? endif ?>
				</p>
				<div class="line"></div>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>.</p>
				<? $i++ ?>
				<? endforeach;
				endif ?>


				<div class="line"></div>
		</article>

		<!-- !sidebar -->
		<? $this->load->view('tt_v1/blocks/pages_sidebar'); ?>
		<!-- !line -->

		<? $this->load->view('tt_v1/blocks/footer_boxes'); ?>

		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<div class="sg-35 line"></div>
		<? $this->load->view('tt_v1/blocks/footer'); ?>
	</div>
</div>
</body>
</html>