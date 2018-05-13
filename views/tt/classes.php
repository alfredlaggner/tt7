<div class="clr"></div>
<div class="main_title_resize">
	<div class="main_title_resize_b"><a id="top"></a>
	</div>
</div>
<div class="body">
	<div class="body_resize">
		<div class="clr"></div>
		<div class="left">
			<h2><span><?= $region . ' - ' ?></span>
				<? if ($row_numbers) : ?>
					choose from <?= $row_numbers ?> classes!
				<? endif ?>
			</h2>
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


				<div class="go_top"><a href="#top">Go back to top</a></div>
			<? endforeach ?>
			<? else : ?>
				<p> Nothing found </p>
			<? endif ?>
			<?= $this->pagination->create_links(); ?> </div>


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
			<h2><span>Sponsors</span></h2>
			<ul class="sponsors">
				<li class="sponsors"><a href="http://www.dreamtemplate.com"
				                        title="Website Templates">DreamTemplate</a><br/>
					Over 6,000+ Premium Web Templates
				</li>
				<li class="sponsors"><a href="http://www.templatesold.com"
				                        title="WordPress Themes">TemplateSOLD</a><br/>
					Premium WordPress &amp; Joomla Themes
				</li>
				<li class="sponsors"><a href="http://www.csshub.com" title="CSS Templates">CSSHub.com</a><br/>
					Professional CSS Web Templates
				</li>
				<li class="sponsors"><a href="http://www.megastockphotos.com"
				                        title="Stock Photos">MegaStockPhotos</a><br/>
					Amazing Unlimited Stock Photos
				</li>
				<li class="sponsors"><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a><br/>
					Website Builder Software &amp; Tools
				</li>
				<li class="sponsors"><a href="http://www.myvectorstore.com" title="Stock Icons">MyVectorStore</a><br/>
					Royalty Free Stock Icons
				</li>
			</ul>
			<p>&nbsp;</p>
			<h2><span>Search</span></h2>
			<div class="search">
				<form id="form1" name="form1" method="post" action="">
										<span>
										<input name="q" type="text" class="keywords" id="textfield" maxlength="50"
										       value="Search..."/>
										</span>
					<input name="b" type="image" src="<?= base_url() ?>images/greeny/search.gif" class="button"/>
				</form>
			</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<div class="clr"></div>
</div>
