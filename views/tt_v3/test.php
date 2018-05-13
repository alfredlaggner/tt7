<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
	      integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
</head>

<body>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1"
		                           href="#collapseOne">
				Collapsible Group #1
			</a></h4>
	</div>
	<div id="collapseOne" class="panel-body collapse">
		<div class="panel-inner">
			This is a simple accordion inner content...
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1"
		                           href="#collapseTwo">
				Collapsible Group #2 (With nested accordion inside)
			</a></h4>
	</div>
	<div id="collapseTwo" class="panel-body collapse">
		<div class="panel-inner">

			<!-- Here we insert another nested accordion -->

			<div class="panel-group" id="accordion2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion2"
						                           href="#collapseInnerOne">
								Collapsible Inner Group Item #1
							</a></h4>
					</div>
					<div id="collapseInnerOne" class="panel-body collapse">
						<div class="panel-inner">
							1Anim pariatur cliche...
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion2"
						                           href="#collapseInnerTwo">
								Collapsible Inner Group Item #2
							</a></h4>
					</div>
					<div id="collapseInnerTwo" class="panel-body collapse">
						<div class="panel-inner">
							2Anim pariatur cliche...
						</div>
					</div>
				</div>
			</div>

			<!-- Inner accordion ends here -->

		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
        integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
        crossorigin="anonymous"></script>
</body>
</html>
