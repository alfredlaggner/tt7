<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link href="<? echo base_url() ?>css/tt/style-greeny.css" rel="stylesheet" type="text/css"/>
	<!--<link href="<? echo base_url() ?>SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<script src="<? echo base_url() ?>SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<script src="<?= base_url() . 'SpryAssets/SpryEffects.js' ?>" ></script>
<script src="<?= base_url() . 'SpryAssets/SpryDOMUtils.js' ?>" ></script>
-->
	<!-- Cufon -->
	<!-- flash script -->
	<script type="text/javascript" src="<?= base_url() . 'js/jquery.js' ?>"></script>
	<!--<script type="text/javascript" src="<? //echo base_url().'js_tt/jquery-1.3.2.min.js'?>"></script>
<script type="text/javascript" src="<? //echo base_url().'js_tt/cufon-yui.js'?>"></script>
<script type="text/javascript" src="<?= base_url() . 'js_tt/myradpro.font.js' ?>"></script>-->

	<script type="text/javascript" src="<?= base_url() ?>js_tt/cufon-yui.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/droid_sans_400-droid_sans_700.font.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/cuf_run.js"></script>

	<!--<script type="text/javascript">
	Cufon.replace('h1')('h2')('h3')('h4');
	</script>
	-->
	<script type="text/javascript" src="<?= base_url() . 'js_tt/flash_detect.v1.7.js' ?>"></script>
	<script src="<?= base_url() . 'js_tt/jquery.scrollTo-1.4.2-min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'js_tt/jquery.localscroll-1.2.7-min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'js_tt/jscroll.js' ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.magnifier.js">
		/**********************************************
		 * jQuery Image Magnify- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
		 * This notice MUST stay intact for legal use
		 * Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
		 ********************************************/
	</script>
	<script>
		jQuery(function ($) {
			/**
			 * Most jQuery.localScroll's settings, actually belong to jQuery.ScrollTo, check it's demo for an example of each option.
			 * @see http://flesler.demos.com/jquery/scrollTo/
			 * You can use EVERY single setting of jQuery.ScrollTo, in the settings hash you send to jQuery.LocalScroll.
			 */
			//borrowed from jQuery easing plugin
			//http://gsgd.co.uk/sandbox/jquery.easing.php
			$.easing.elasout = function (x, t, b, c, d) {
				var s = 1.70158;
				var p = 0;
				var a = c;
				if (t == 0) return b;
				if ((t /= d) == 1) return b + c;
				if (!p) p = d * .3;
				if (a < Math.abs(c)) {
					a = c;
					var s = p / 4;
				}
				else var s = p / (2 * Math.PI) * Math.asin(c / a);
				return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
			};

			// The default axis is 'y', but in this demo, I want to scroll both
			// You can modify any default like this
			$.localScroll.defaults.axis = 'y';

			// Scroll initially if there's a hash (#something) in the url 
			$.localScroll.hash({
//		easing:'elasout',
				offset: {top: -20},
				duration: 1000
			});
			$.localScroll({
				onBefore: function (e, anchor, $target) {
//			 The 'this' is the settings object, can be modified
					1000
				},
				onAfter: function (anchor, settings) {
//			 The 'this' contains the scrolled element (#content)
					1000
				}
			});
		});

		Sys.Browser.WebKit = {};
		if (navigator.userAgent.indexOf('WebKit/') > -1) {
			Sys.Browser.agent = Sys.Browser.WebKit;
			Sys.Browser.version = parseFloat(navigator.userAgent.match(/WebKit\/(\d+(\.\d+)?)/)[1]);
			Sys.Browser.name = 'WebKit';
		}

	</script>
	<script type="text/javascript" language="JavaScript"><
		!--
			function sub_wmd_query() {
				document.wmd_query.submit();
			};
		;
		function do_region_selected() {
			document.contact_form.submit();
		}
	</script>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.quickZoom.1.0.js"></script>
	</script>
	<
	script;
	;
	tyle = "text/javascript" >
		$(document).ready(function () {
			$('.thumbnails li').quickZoom({
				zoom: 2.5,
				speedIn: 700,
				speedOut: 300,
				sqThumb: false,
				easeIn: 'easeInSine',
				easeOut: 'easeOutSine',
				titleInSpeed: 200,
				shadow: true,
			});
		});
	</script>
	<script type="text/javascript" src="<?= base_url() ?>highslide/highslide-with-gallery.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>highslide/highslide.config.js" charset="utf-8"></script>
	<script>hs.graphicsDir = '<?= base_url() ?>highslide/graphics/';
	</script>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>highslide/highslide.css"/>

	<script src="js/jquery.js" type="text/javascript"></script>
	</script>
	<
	!-- < script;
	;
	type = "text/javascript";
	;
	src = "<?= base_url() ?>tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>
	-->
	<script type="text/javascript">

		tinyMCE.init({

			// General options

			mode: "textareas",

			theme: "advanced",

			plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount",


			Theme options

			theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

			theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",

			theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

			theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",

			theme_advanced_toolbar_location: "top",

			theme_advanced_toolbar_align: "left",

			theme_advanced_statusbar_location: "bottom",

			theme_advanced_resizing: true,


			// Drop lists for link/image/media/template dialogs

			template_external_list_url: "lists/template_list.js",

			external_link_list_url: "lists/link_list.js",

			external_image_list_url: "lists/image_list.js",

			media_external_list_url: "lists/media_list.js",


			// Replace values for the template plugin

			template_replace_values: {

				username: "Some User",

				staffid: "991234"

			}

		});

	</script>
	<?php $this->xajax->printJavascript(); ?>
	<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>
-->

	<!-- /TinyMCE -->
	<link type="text/css" href="<?= base_url() ?>js_tt/css/south-street/jquery-ui-1.8.18.custom.css" rel="Stylesheet"/>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js_tt/js/jquery-ui-1.8.18.custom.min.js"></script>

</head>
<body>
<div class="main">
	<img src="<?= base_url() ?>images/banner-5-no-color-1350.jpg" alt="treks and tracks banner">
	<div class="header">
		<div class="header_resize">
			<div class="menu">
				<ul>
					<li><a href="<?= site_url('tt') ?>"><span>Home</span></a></li>
					<li><a href="<?= site_url('tt/classes') ?>"><span>Classes</span></a></li>
					<li><a href="<?= site_url('pages/guides') ?>"></span>Guides</a></li>
					<li><a href="contact.html"><span> Contact Us</span></a></li>
				</ul>
			</div>
			<div class="twitter"><img src="<?= base_url() ?>images/greeny/globe.gif" alt="img" width="41" height="40"
			                          style="padding:5px 5px 0 0;" class="floated"/>
				<? if (!$region) : ?>
					<p style="color:#FFF">Select a <span id="disp_region">region</span></p>
				<? else : ?>
					<p style="color:#FFF">Your selected region is <span id="disp_region"><?= $region ?></span></p>
				<? endif ?>
				<form id="contact_form" name="contact_form" method="post" action="<?= site_url() ?>tt/region_selected">
					<select type="text" name="region" id="region" class="text" value='<?= $region_id ?>'
					        onChange="do_region_selected()"/>
					<? if (isset($regions)) : foreach ($regions as $region) : ?>
						<? if ($region->region_id == $region_id) : ?>
							<option selected value="<?= $region->region_id ?>"><?= $region->region; ?></option>
						<? else : ?>
							<option value="<?= $region->region_id ?>"><?= $region->region ?></option>
						<? endif; ?>
					<? endforeach; ?>
					<? endif; ?>
					</select></form>
				<!--					<input id="submitButton" type="submit" name="submit" value="Select"/>
									onclick="xajax_form_contact(xajax.getFormValues('contact-form'));return false;" />-->

				<!--        <p><a href="#">TWITTER</a><br />
						  Receive updates as soon as they are posted.</p>
				-->      </div>
			<!--      <div class="logo"><h1><a href="index.html"><span>Best</span> and necessary<br /><small>Runs faster. Costs less. And never breaks</small></a></h1></div>
			-->
			<div class="clr"></div>
		</div>
	</div>
