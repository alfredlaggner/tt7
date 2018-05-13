<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8"/>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<?php
	if (isset($this->xajax)) :    // not all my pages use ajax
		echo $this->xajax->getJavascript(); ?>
	<?php endif; ?>

	<base href="<?php echo base_url(); ?>"/>

	<title>Welcome to CodeIgniter</title>
	<link href="<?php echo base_url() . 'css/tt/welcome.css' ?>" rel="stylesheet" type="text/css"/>


	<script src="<?php echo base_url() . 'assets/'; ?>xajax_js/xajax_debug.js"></script>
	<?php $this->load->view('xajax/xajax'); ?>

</head>


<body>

<?php //$this->load->view('xajax/progress'); ?>
<div id="loading"></div>
<div id="container">

	<h1>
		<form name="test" id="test">
			<input type="button" value="test" onClick="xajax_test_function(2);">
		</form>
	</h1>
	<div id="ajax_div"></div>

</div>

<p class="footer">
	CodeIgniter Version: <?php echo CI_VERSION; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
	Page rendered in <strong>{elapsed_time}</strong> seconds.&nbsp;&nbsp;|&nbsp;&nbsp;
	Memory usage: <strong>{memory_usage}.</strong>
</p>

</div>

</body>

</html>