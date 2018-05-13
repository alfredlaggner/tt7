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
			<h1>Why choose Treks and Tracks</h1>
			<div class="line"></div>

			<div id="blog-post-content"><img src="<?= base_url() . PAGES_IMAGE_DIR ?>pic82.jpg" width="500" height="310"
			                                 alt="Patience sailboat">
				<p>Treks and Tracks is comitted to sharing our passion for the natural world with clients through
					adventure travel, our mountain school and expedition travel. </p>
				<p>Principles we run our company by:</p>
				<h4><a name="commitmenttoplanet" id="commitmenttoplanet"></a>Commitment to the Planet</h4>
				<p>Treks and Tracks is committed to putting the environment first. As proud members of 1% For The Planet
					we donate 1% of our gross revenue to organizations that help preserve the environment we play in
					every day.</p>
				<h4>&nbsp;</h4>
				<h4><a name="bestclientcare" id="bestclientcare"></a>Best Client Care</h4>
				<p> Treks and Tracks has taken every step to provide an unforgettable experience for our clients. Our
					preperations for any given event begin far before the start of the trip. Months and sometimes even
					years are spent planning and refining our adventures ensuring that our clients can enjoy every step
					of their adventure.<br/>
				</p>
				<br/>
				<br/>
				<h4><a name="greatguides" id="greatguides"></a>Great Guides</h4>
				<p>We believe that our guides are the foundation of our company and your experience. <a
						href="guides.html">Our guides</a> are highly qualified to lead our adventures. Each is certified
					in Wilderness First Aid and comes to Treks and Tracks with years of experience in the field. Beyond
					their professional qualifications you may find yourself being captivated by their knowledge of
					natural history and at put at ease by their great personalities. <br/>
				</p>
				<br/>
				<h4><a name="pricing" id="pricing"></a>Transparent Pricing</h4>
				</p>
				<p>We have arranged our pricing to be as transparent as possible. For the most part you can count on
					your transportation expenses at location to be covered.  All meals in the field are provided so you
					don’t have to worry about planning out complex menus. All you need is an appetite, and that we can
					guarantee you we will not be lacking with our active schedules. If special events or activities are
					available you will know about them beforehand so that you can plan for these occasions. <br/>
					We provide tents, first aid kits and water filtration systems. You will be provided with a gear list
					of the necessary equipment you will need to bring. If there are any items you need assistance on
					purchasing or renting our staff is more than happy to make recommendations and suggestions for you. 
				</p>
				<br/>
				<h4><a name="travelingsafely" id="travelingsafely"></a>Traveling Safely and Ethically</h4>
				</p>
				<p>Your safety and comfort are extremely important to us. That is why we maintain the highest quality of
					service possible, from carefully designing itineraries, to keeping the most thorough sanitary
					standards while preparing and cooking meals. Our guides uphold the highest standards of backcountry
					safety protocols and are trained for backcountry emergencies.  <br/>
					We are quite aware of the impact we have in venturing into the backcountry with a group of clients.
					 It is therefore extremely important that our groups adhere to the &quot;Leave No Trace&quot; travel
					and camping techniques. We make an effort to be role models for those around us and hope that our
					travels contribute to awareness and change needed for reducing the impact in our environment.</p>
				<br/>
				<h4><a name="fabulouscuisine" id="fabulouscuisine"></a>Fabulous Cuisine</h4>
				<p>All of our meals are prepared with the awareness to maintain a healthy and nutritious diet so that we
					may maintain high energy levels for our active schedules. Our guides and cooks are renowned for
					their culinary masterpieces and are happy to accommodate dietary restrictions and/or allergies.
					Beyond choosing the best ingredients we ensure safe and sanitary food preparation as this is
					paramount to a safe backcountry experience.</p>
				<p>&nbsp;</p>
				<p>
					<!--<a href="environmental-stewardship.shtml"><img src="<?= base_url() . PAGES_IMAGE_DIR ?>logo_vert_standard_color.jpg" alt="one percent for the planet" width="182" height="267" align="left" /></a>--><img
						src="<?= base_url() . PAGES_IMAGE_DIR ?>amga_spi.jpg" alt="AMGA certified guides" width="200"
						height="256" align="right"/></p>
				<p>.</p>
			</div>


		</article>

		<!-- !sidebar -->
		<? $this->load->view('tt_v1/blocks/pages_sidebar'); ?>
		<!-- !line -->
		<div class="sg-35 line"></div>

		<? $this->load->view('tt_v1/blocks/footer_boxes'); ?>


		<!-- !PAGE-CONTENT-END -->

		<!-- !line -->
		<div class="sg-35 line"></div>
		<? $this->load->view('tt_v1/blocks/footer'); ?>
	</div>
</div>

</body>
</html>