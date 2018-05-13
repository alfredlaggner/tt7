<head>

	<meta charset="UTF-8"/>
	<meta name='author' content="Mountain Themes - mountainthemes.com"/>

	<? if (!isset($meta_title)) {
		echo '<title>Treks and Tracks</title>';
	} else {
		echo '<title>' . $meta_title . '</title>';
	} ?>

	<? if (!isset($meta_description)): ?>
		<meta name="description"
		      content="We offer outdoor education courses like climbing classes through our Mountain School as well as horsepacking trips and sailing expeditions. We believe our expeditions that blend ancient means of travel and modern sports (sailing/surfing and horseback riding/climbing) inspire people to connect with the natural world.">
	<? else : ?>
		<meta name="description" content="<?= $meta_description ?>">
	<? endif ?>


	<? if (!isset($meta_keywords)): ?>
		<meta name="Keywords"
		      Content="climbing classes, rock climbing, horsepacking trips, adventure travel, back country skiing"/>
	<? else : ?>
		<meta name="description" content="<?= $meta_keywords ?>">
	<? endif ?>
	<!--<script  src="<?php echo base_url() . 'js/jquery-1.3.2.min.js' ?>"></script>
<script src="<?php echo base_url() . 'js/jquery.scrollTo-1.4.2-min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'js/jquery.localscroll-1.2.7-min.js' ?>" type="text/javascript"></script>
<script>
jQuery(function( $ )
{
	/**
	 * Most jQuery.localScroll's settings, actually belong to jQuery.ScrollTo, check it's demo for an example of each option.
	 * @see http://flesler.demos.com/jquery/scrollTo/
	 * You can use EVERY single setting of jQuery.ScrollTo, in the settings hash you send to jQuery.LocalScroll.
	 */
		//borrowed from jQuery easing plugin
	//http://gsgd.co.uk/sandbox/jquery.easing.php
	$.easing.elasout = function(x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	};

	// The default axis is 'y', but in this demo, I want to scroll both
	// You can modify any default like this
	$.localScroll.defaults.axis = 'y';
	
	// Scroll initially if there's a hash (#something) in the url 
	$.localScroll.hash({
//		easing:'elasout',
		offset:{ top:-20 },
		duration:1000
	});
	$.localScroll({
		onBefore:function( e, anchor, $target ){
//			 The 'this' is the settings object, can be modified
			duration:1000
		},
		onAfter:function( anchor, settings ){
//			 The 'this' contains the scrolled element (#content)
			duration:1000
		}
	});
});
</script>
-->

	<!-- !js -->
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>jquery.1.7.min.js"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>jquery.columnizer.min.js"
	        charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>jquery.isotope.min.js"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>app.js"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>jquery.plugins.js"></script>
	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>akaishi.js"></script>
	<!--    <script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>scrollpane/jquery.jscrollpane.js"></script>
    <script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>scrollpane/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>scrollpane/mwheelIntent.js"></script>
-->
	<script type="text/javascript" src="<?= base_url() ?>js_tt/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.tipTip.minified.js"></script>

	<script type="text/javascript" src="<?= base_url() . 'akaishi/assets/js/' ?>shadowbox.js"></script>
	<!--    <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/luglio7.json?callback=app.twitter.callback&amp;count=1&amp;exclude_replies=true"></script>
	-->
	<script type="text/javascript">
		app.vars.currencySymbol = '$';
		$(function () {
			$('#product-description-text').columnize({columns: 1});
		});
	</script>

	<!-- !css -->
	<!--    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif|Chivo" media="all" />
	-->
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/tt/themes/redmond/jquery.ui.all.css' ?>"
	      media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'css/tipTip.css' ?>" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'akaishi/assets/css/' ?>squaregrid.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'akaishi/assets/css/' ?>chosen.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'akaishi/assets/css/' ?>layout.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'akaishi/assets/css/' ?>shadowbox.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'akaishi/assets/css/' ?>jquery.jscrollpane.css"
	      media="all"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>style_admin.css" media="all"/>


	<?php $this->xajax->printJavascript(); ?>
	<!-- <script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script> -->


	<!-- <script defer='defer' id='cjax_lib' type='text/javascript' src='cjax/core/js/cjax-5.0-Stable.min.js'></script>-->

</head>