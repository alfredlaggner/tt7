<?= $head ?>
<body>
<style>
	h3 {
		position: relative;
	}

	h3 a {
		position: absolute;
		top: -150px;
	}

	h1 {
		position: relative;
	}

	h1 a {
		position: absolute;
		top: -150px;
	}
</style>

<?= $header ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1><a id="go-top"></a>Treks and Tracks Guides</h1>
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-7">
			<? $i = 1; ?>
			<? if (isset($records)) : foreach ($records as $row) : ?>
				<div id="blog-post-content<?= $i++ ?>">

					<h3><a id="<?= strtolower($row->first_name) ?>"></a>
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
					<? if ($row->picture) : ?>
						<img class="img-responsive img-rounded"
						     src="<?= base_url() . PAGES_IMAGE_DIR ?><?= $row->picture ?>"
						     alt="Guide Picture">
					<? endif ?>

					<p>
						<?= $row->bio ?>
						<? if ($row->is_amga) : ?>
							<img class="img-fuid" src="<?= base_url() . PAGES_IMAGE_DIR ?>amga_spi.jpg"
							     alt="AMGA certified guides"
							     width="133" height="170" align="right"/>
						<? endif ?>
					</p>


					<p>&nbsp;</p>
					<hr>
					<? $i++ ?>

				</div>
			<? endforeach;
			endif ?>
		</div>
		<div class="col-md-5">
			<!-- !sidebar -->
			<? $data['is_about_view'] = TRUE ?> <!--used to exlude member pictures on sidebar-->
			<? $this->load->view('tt_v3/blocks/pages_sidebar', $data); ?>
			<!-- !line -->
		</div>
	</div>
</div>
</body>
<?= $footer ?>
</html>