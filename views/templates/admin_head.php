<!DOCTYPE html>
<html lang="en">
<head>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<link rel="icon" type="image/ico" href="favicon.ico">

	<!-- common stylesheets-->
	<!-- bootstrap framework css -->
	<?= link_tag('bootstrap/css/bootstrap.min.css'); ?>
	<?= link_tag('bootstrap/css/bootstrap-responsive.min.css'); ?>
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
	<!-- iconSweet2 icon pack (16x16) -->
	<?= link_tag('img/icsw2_16/icsw2_16.css'); ?>
	<!-- splashy icon pack -->
	<?= link_tag('img/splashy/splashy.css'); ?>
	<!-- flag icons -->
	<?= link_tag('img/flags/flags.css'); ?>
	<!-- power tooltips -->
	<?= link_tag('js2/lib/powertip/jquery.powertip.css'); ?>
	<!-- google web fonts -->
	<?= link_tag('http://fonts.googleapis.com/css?family=Abel'); ?>
	<?= link_tag('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300'); ?>

	<!-- aditional stylesheets -->
	<!-- colorbox -->
	<?= link_tag('js2/lib/colorbox/colorbox.css'); ?>
	<!-- datatables -->
	<?= link_tag('js2/lib/datatables/css/datatables_beoro.css'); ?>
	<!-- datepicker -->
	<?= link_tag("js2/lib/bootstrap-datepicker/css/datepicker.css"); ?>
	<!-- timepicker -->
	<?= link_tag("js2/lib/bootstrap-timepicker/css/timepicker.css"); ?>
	<!-- timepicker -->
	<?= link_tag("js2/lib/bootstrap-datetimepicker/css/datetimepicker.css"); ?>


	<!-- main stylesheet -->
	<?= link_tag('css/beoro.css'); ?>

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="css/ie8.css"><![endif]-->
	<!--[if IE 9]>
	<link rel="stylesheet" href="css/ie9.css"><![endif]-->

	<!--[if lt IE 9]>
	<script src="js2/ie/html5shiv.min.js"></script>
	<script src="js2/ie/respond.min.js"></script>
	<script src="js2/lib/flot-charts/excanvas.min.js"></script>
	<![endif]-->
	<!-- Common JS -->
	<!-- jQuery framework -->
	<script src=<?= base_url("js2/jquery.min.js") ?>></script>
	<!-- bootstrap Framework plugins -->
	<script src=<?= base_url("bootstrap/js/bootstrap.min.js") ?>></script>
	<!-- top menu -->
	<script src=<?= base_url("js2/jquery.fademenu.js") ?>></script>
	<!-- top mobile menu -->
	<script src=<?= base_url("js2/selectnav.min.js") ?>></script>
	<!-- actual width/height of hidden DOM elements -->
	<script src=<?= base_url("js2/jquery.actual.min.js") ?>></script>
	<!-- jquery easing animations -->
	<script src=<?= base_url("js2/jquery.easing.1.3.min.js") ?>></script>
	<!-- power tooltips -->
	<script src=<?= base_url("js2/lib/powertip/jquery.powertip-1.1.0.min.js") ?>></script>
	<!-- date library -->
	<script src=<?= base_url("js2/moment.min.js") ?>></script>
	<!-- common functions -->
	<script src=<?= base_url("js2/beoro_common.js") ?>></script>

	<!-- datatables -->
	<script src=<?= base_url("js2/lib/datatables/js/jquery.dataTables.min.js") ?>></script>
	<script src=<?= base_url("js2/lib/datatables/js/jquery.dataTables.sorting.js") ?>></script>
	<!-- datatables bootstrap integration -->
	<script src=<?= base_url("js2/lib/datatables/js/jquery.dataTables.bootstrap.min.js") ?>></script>
	<!-- colorbox -->
	<script src=<?= base_url("js/lib/colorbox/jquery.colorbox.min.js") ?>></script>
	<!-- datepicker -->
	<script src=<?= base_url("js2/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js") ?>></script>
	<script src=<?= base_url("js2/lib/bootstrap-timepicker/js/bootstrap-timepicker.min.js") ?>></script>
	<script src=<?= base_url("js2/lib/bootstrap-timepicker/js/bootstrap-timepicker.min.js") ?>></script>
	<script src=<?= base_url("js2/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js") ?>></script>
	<!-- timepicker -->
	<script src=<?= base_url("js2/pages/beoro_tables.js") ?>></script>
	<!-- masked inputs -->
	<script src=<?= base_url("js2/lib/jquery-inputmask/jquery.inputmask.min.js") ?>></script>
	<script src=<?= base_url("js2/lib/jquery-inputmask/jquery.inputmask.extensions.js") ?>></script>
	<script src=<?= base_url("js2/lib/jquery-inputmask/jquery.inputmask.date.extensions.js") ?>></script>
	<!-- jQuery validation -->
	<script src=<?= base_url("js2/lib/jquery-validation/jquery.validate.min.js") ?>></script>

	<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
</head>

