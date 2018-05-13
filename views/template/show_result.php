<html>
<head>
	<title>Xajax 0.5 test</title>
	<?php
	if (isset($this->xajax)) :    // not all my pages use ajax
		echo $this->xajax->getJavascript(); ?>
	<?php endif; ?>
	<?php $this->load->view('xajax/xajax'); ?>
	<!--<script src="<?php echo base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>
--></head>
<body>
<div id="loading"></div>
<div id="container">
	<h1>
		<form action="#" method="post" onSubmit="return false;">
			<input type="button" value="test" onClick="xajax_test_function(2);">
		</form>
	</h1>
	<div id="ajax_div"></div>
</div>
</body>
</html>
<!--end-->