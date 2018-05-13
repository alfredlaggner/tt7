<div class="body">
	<div class="body_resize">

		<div class="left">
			<h2><span>Treks and Tracks</span></h2>
			<p>
				We offer outdoor education courses through our Mountain School as well as horsepacking trips and sailing
				expeditions.
				It is our mission to bring likeminded people into the wild places of the world. We believe that
				expeditions that blend ancient means of travel and modern sports (sailing/surfing and horseback
				riding/climbing) inspire us to connect with the natural world.
			</p>
			<div class="bg"></div>
			<? if (!$region) : ?>
				<h2>Select a <span>region</span></h2>
			<? else : ?>
				<h2><span><?= $region ?> featured classes</span></h2>
			<? endif ?>
			<div class="pagination_outer"><?= $this->pagination->create_links(); ?></div>
			<? if ($records) : foreach ($records as $row) : ?>
				<? $image_name = 'images/classes/' . strtoupper($row->code) . '/main_' . 'thumb.jpg'; ?>
				<a title="Get the details" href="<?= site_url('tt/class_detail/' . $row->activity_id) ?>">
					<img src="<?= base_url() . $image_name ?>" alt="img" width="100" height="100" class="floated"/>
				</a>
				<h2><?= $row->name ?></h2> (<?= $row->code ?>)
				<p><b><?= $row->description_short ?></b>
					<a style="float:right" title="Get the details"
					   href="<?= site_url('tt/class_detail/' . $row->activity_id) ?>">Get the details</a></p>
				<div class="bg"></div>


			<? endforeach ?>
			<? else : ?>
				<p> No classes yet for this area. Please call back.</p>
			<? endif ?>
			<a style="float:right" href="<?= site_url('tt/classes') ?>"/><img align="right"
			                                                                  src="<?= base_url() ?>images/greeny/see_all_classes.gif"
			                                                                  width="118" height="26"
			                                                                  alt="See all classes"/></a>
			<?= $this->pagination->create_links(); ?> </div>
	</div>

	<div class="right">
		<h2><span>Sidebar</span> Menu</h2>
		<ul>
			<li><a href="#"> Home</a></li>
			<li><a href="#">TemplateInfo</a></li>
			<li><a href="#">Style Demo</a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">Archives</a></li>
			<li><a href="http://www.dreamtemplate.com" title="Website Templates">Web Templates</a></li>
		</ul>
		<h2><span>Search</span></h2>
		<div class="search">
			<form id="form1" name="form1" method="post" action="">
            <span>
            <input name="q" type="text" class="keywords" id="textfield" maxlength="50" value="Search..."/>
            </span>
				<input name="b" type="image" src="<?= base_url() ?>images/greeny/search.gif" class="button"/>
			</form>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<div class="FBG">
	<div class="FBG_resize">
		<div class="blok">
			<h3>Something for this summer ...<br/>
			</h3>
			<a href="rock-climbing-beginner.shtml">
				<iframe title="YouTube video player" width="298" height="224"
				        src="http://www.youtube.com/embed/PGL8l2V4h94" frameborder="0" allowfullscreen></iframe>
			</a>
			<p> Summer is approaching fast! Join us for our popular 3 day kids climbing program at Castle Rock State
				Park near Los Gatos CA! The program is packed with plenty of fun on and near the interesting rocks of
				the park. Our guides provide a safe and caring environment suitable for climbers of all skill
				levels.<br/>
				<!--			    <a href="kids-camp-3-days.shtml">Find Out More »</a><br />
												<a href="our-classes.shtml">Read more about our classes »</a> </p>
							  <p><a href="learn-to-rock-climb.shtml">Read more about Learn To Rock Climb»</a></p>
												<p><a href="bay-area-rock-climbing.shtml">Read more about Bay Area rock climbing »</a><br />
				-->                </p></div>
		<div class="blok">
			<h3>Mountain Horseback ride</h3>
			<iframe src="http://player.vimeo.com/video/23125041?title=0&amp;byline=0&amp;portrait=0" width="298"
			        height="224" frameborder="0"></iframe>
			<!--<p><a href="http://vimeo.com/23125041">Treks and Tracks backcountry horseback ride preview</a> from <a href="http://vimeo.com/user6294400">Paul Mangasarian</a> on <a href="http://vimeo.com">Vimeo</a>.</p>-->
			<p>Join us this year on a horse ride into the mountains. During our ride through the mountains we will learn
				age-old camping and packing techniques that allow our team of horses and humans to move swiftly and
				effeciently as one. Be part of a backcountry philosophy that takes a modern approach to methods
				developed and tested by nomads over thousands of years.<br/>
				<!--										<a href="horseandmountain.shtml">Read More »</a> </p>
				--></div>
		<div class="blok">
			<h3>Expedition under way!&nbsp; </h3>
			<iframe src="http://player.vimeo.com/video/25557287" width="298" height="224" frameborder="0"></iframe>
			<p>
				<!--<a href="http://vimeo.com/25557287">Surf Sail Southern Costa Rica</a> from <a href="http://vimeo.com/user6294400">Paul Mangasarian</a> on <a href="http://vimeo.com">Vimeo</a>-->
				<!--<div style="padding-top:10px; padding-bottom:32px;"><iframe class="youtube-player" type="text/html" width="298" height="192" src="http://www.youtube.com/embed/c6a1pZbrl64?hl=en_US" frameborder="0"></iframe></div>
-->
			<p><strong>Treks and Tracks sailing to Costa Rica expedition</strong></p>
			<p>Members of this years sailing expedition departed Santa Cruz, CA on February 2nd 2011 on a 4 month voyage
				to Costa Rica. <br/>
				<!--		<a href="expeditions.shtml">Find Out More »</a> </p>
				--></div>
		<div class="clr"></div>
	</div>
</div>
<? $this->load->view('tt/footer'); ?>
</div>
</body>
</html>
