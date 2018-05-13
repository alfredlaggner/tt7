<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
<head>
	<!-- Page Title -->
	<title>Travelo | Responsive HTML5 Travel Template</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<? if (!isset($meta_keywords)): ?>
		<meta name="keywords"
		      Content="climbing classes, rock climbing, horsepacking trips, adventure travel, back country skiing"/>
	<? else : ?>
		<meta name="keywords" content="<?= $meta_keywords ?>">
	<? endif ?>
	<meta name="description" content="Travelo | Responsive HTML5 Travel Template">
	<meta name="author" content="Outdoor Adventure">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Theme Styles -->
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/animate.min.css">

	<!-- Current Page Styles -->
	<link rel="stylesheet" type="text/css"
	      href="<?= base_url() . COMPONENTS_DIR ?>components/revolution_slider/css/settings.css" media="screen"/>
	<link rel="stylesheet" type="text/css"
	      href="<?= base_url() . COMPONENTS_DIR ?>components/revolution_slider/css/style.css" media="screen"/>
	<link rel="stylesheet" type="text/css"
	      href="<?= base_url() . COMPONENTS_DIR ?>components/jquery.bxslider/jquery.bxslider.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . COMPONENTS_DIR ?>components/flexslider/flexslider.css"
	      media="screen"/>

	<!-- Main Style -->
	<link id="main-style" rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/style.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/custom.css">

	<!-- Updated Styles -->
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/updates.css">

	<!-- Updated Styles -->
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/updates.css">

	<!-- Responsive Styles -->
	<link rel="stylesheet" href="<?= base_url() . CSS_DIR ?>css/responsive.css">

	<!-- CSS for IE -->
	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<![endif]-->


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
	<![endif]-->

	<!-- Javascript Page Loader -->
	<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/pace.min.js"
	        data-pace-options="{ 'ajax': false }"></script>
	<script type="text/javascript" src="<?= base_url() . JS_DIR ?>js/page-loading.js"></script>
	<?php $this->xajax->printJavascript(); ?>

	<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->


	<script defer='defer' id='cjax_lib' type='text/javascript' src='cjax/core/js/cjax-5.0-Stable.min.js'></script>

</head>