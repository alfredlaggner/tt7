<?php # in my <head>
if (isset($this->xajax)) :    // not all my pages use ajax

	echo $this->xajax->printJavascript(); ?>

	// other stuff here

<?php endif; ?>

# in my
<body>

<a href="javascript:xajax_say_hello();">Say Hello</a><br/>

<div id="ajax_div">i say goodbye</div>
#before
<div id="ajax_div">Just saying hello from XAJAX.</div>
#after