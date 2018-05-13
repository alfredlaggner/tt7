<html>
<head>
	<title>Xajax 0.5 test</title>
	<?php
	if (isset($this->xajax)) :    // not all my pages use ajax
		echo $this->xajax->getJavascript(); ?>
	<?php endif; ?>
	<script src="<?php echo base_url() . 'assets/'; ?>xajax_js/xajax_debug.js"></script>
</head>
<body>
<h1>
	<form name="test" id="test">
		<input type="button" value="test" onClick="xajax_test_function(2);">
	</form>
</h1>
<div id="ajax_div"></div>
</body>
</html>