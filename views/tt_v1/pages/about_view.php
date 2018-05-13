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
			<h1>About Treks and Tracks</h1>
			<div class="line"></div>


			<div id="blog-post-content">
				<p><img src="<?= base_url() . PAGES_IMAGE_DIR ?>25984_382756256819_668686819_4350625_4333678_n.jpg"
				        alt="" width="540" height="400" class="article-image"/>Treks and Tracks offers various courses
					and experiences in outdoor activities. Be it rock climbing, backpacking or a navigation course, we
					strive to offer the highest quality experience to our clientele.</p>
				<p>We hold our guides to the highest safety and guiding standards in the industry. All guides are
					trained in wilderness emergency procedures and professional guiding techniques. With over 30 years
					of combined outdoor adventure experience, each expedition and class has been carefully crafted to
					ensure an inspiring experience.</p>
				<div class="line"></div>
				<h1>Company Profile</h1>
				<p>Operating since 2010, the mission of Treks and Tracks is to provide professional, fun and rewarding
					outdoor adventure experiences for clients of all ages and abilities, while managing the risks
					inherent in these activities. In addition, we strive to instill a sense of awe for and stewardship
					towards the natural world.</p>

				<p>Here are some numbers we feel proud of – Since 2013 Treks and Tracks has:</p>

				<ul>
					<li>Instructed over 600 kids in our programs</li>
					<li>Instructed over 4,000 adults in our programs</li>
					<li>Operated on 2 continents and 5 countries</li>
					<li>Customized events and retreats for companies such as the North Face, Google and the Boy scouts
						of America
					</li>
					<li>Planned expeditions in the Colorado Rocky Mountains, the Sierra Nevada, Central America and
						Chile
					</li>
					<li>A perfect track record in safety</li>
				</ul>

				<p>We currently operate in six State and National Parks throughout the state of California. Our
					activities include rock climbing instruction of all levels, rappelling, overnight backpacking, map
					and compass navigation and tailored corporate team building events.</p>
				<p>&nbsp;</p>
				<!--                   <a href="<?= site_url() . "menu_pages/environment" ?>"><img src= "<?= base_url() . PAGES_IMAGE_DIR ?>logo_vert_standard_color.jpg" alt="one percent for the planet" width="182" height="267" align="left" /></a> -->
			</div>

			<div class="line"></div>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p><img src="<?= base_url() . PAGES_IMAGE_DIR ?>amga_spi.jpg" alt="AMGA certified guides" width="200"
			        height="256" align="left"/></p>
		</article>

		<!-- !sidebar -->
		<? $data['is_about_view'] = TRUE ?> <!--used to exlude member pictures on sidebar-->
		<? $this->load->view('tt_v1/blocks/pages_sidebar', $data); ?>
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