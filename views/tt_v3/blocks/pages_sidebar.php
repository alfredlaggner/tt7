<h3>About Treks and Tracks</h3>
<ul>
	<li><a href="<?= site_url() . "menu_pages_v3/about_us" ?>">About Treks and Tracks</a></li>
	<li><a href="<?= site_url() . "menu_pages_v3/guides" ?>">Our Guides</a></li>
	<li><a href="<?= site_url() . "menu_pages_v3/environment" ?>">Environmental Stewardship</a></li>
	<li><a href="<?= site_url() . "menu_pages_v3/whytt" ?>">Why Choose Treks and Tracks</a></li>
	<li><a href="<?= site_url() . "menu_pages_v3/terms" ?>">Terms and Conditions</a></li>
</ul>
<!--              <h3 class="sub-title">Latest from Twitter</h3>
  <cite>What's happening right now at Treks and Tracks.</cite> <a href="#" id="rss-link">rss feed</a>
-->
<? if (isset($is_about_view)) : ?>
	<div class="line"></div>
	<h3>Jakob <br/>
		<span> Co-founder and Guide</span></h3>
	<p><a href="<?= site_url() . "menu_pages_v3/guides" ?>#jakob"><img class="sidebar_img_small"
	                                                                src="<?= base_url() . PAGES_IMAGE_DIR ?>J pic.jpg"
	                                                                width="100" height="120" alt="Jakob Laggner"></a>
	<p>Jakob spent 11 years in the outdoor industry working as a ski guide and climbing guide in California and Alaska.
		<a href="<?= site_url() . "menu_pages_v3/guides" ?>#jakob">Read More »</a></p>
	<div class="line"></div>
	<h3>Paul <br/>
		<span>Co-founder and Guide</span></h3>
	<p><a href="<?= site_url() . "menu_pages_v3/guides" ?>#paul"><img class="sidebar_img_small"
	                                                               src="<?= base_url() . PAGES_IMAGE_DIR ?>p pic.jpg"
	                                                               width="100" height="140" alt="Paul Mangasarian"></a>
	</p>
	<p>Paul has been climbing, surfing and skiing since he was old enough to walk. His technical climbing abilities and
		fortitude for teaching make him an outstanding instructor. <a
			href="<?= site_url() . "menu_pages_v3/guides" ?>#paul">Read More »</a></p>
	<div class="line"></div>
	<h3>Daniel <br/>
		<span> Co-founder and Guide</span></h3>
	<p><a href="<?= site_url() . "menu_pages_v3/guides" ?>#daniel"><img class="sidebar_img_small"
	                                                                 src="<?= base_url() . PAGES_IMAGE_DIR ?>d pic.jpg"
	                                                                 width="100" height="140" alt="Daniel Laggner"></a>
	<p>Daniel has worked as a rock climbing instructor and climbing coach for 11 years. He is certified as a Canadian
		Level I Avalanche Analyst and Wilderness First Responder. <a
			href="<?= site_url() . "menu_pages_v3/guides" ?>#daniel">Read More »</a></p>
	<div class="line"></div>
<? endif ?>			
			

