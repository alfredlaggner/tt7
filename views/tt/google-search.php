<div class="slide_blog_resize">
	<div class="slide_blog_resize_b">
		<h2>Search for Anything on our Website</h2>
		<div class="clr"></div>
	</div>
</div>
<div class="body">
	<div class="body_resize">
		<div class="clr"></div>
		<div class="left">
			<div id="cse" style="width: 100%;">Loading</div>
			<script src="http://www.google.com/jsapi" type="text/javascript"></script>
			<script type="text/javascript">
				google.load('search', '1', {language: 'en', style: google.loader.themes.GREENSKY});
				google.setOnLoadCallback(function () {
					var customSearchControl = new google.search.CustomSearchControl('014393745374815552531:vm-vke-odfs');
					customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
					customSearchControl.draw('cse');
				}, true);
			</script>
		</div>
		<div class="right">
			<h2>More About Us</h2>
			<ul>
				<li><?php echo anchor('pv/team', "Management Team") ?></li>
				<li><?php echo anchor('pv/contact', "Contact Us") ?></li>
				<li>&nbsp;</li>
				<li><a href="#" onclick="history.go(-1);return false;">Back to previous page</a></li>
				<li>&nbsp;</li>
			</ul>
			<p>&nbsp;</p>
			<h2>&nbsp;</h2>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="clr"></div>
</div>
