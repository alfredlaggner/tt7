<!DOCTYPE html>
<html>
<head lang="ru">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Template</title>
	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link
		href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
		crossorigin="anonymous"
	>
	<link
		href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic'
		rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
	<style>
		.monospaced {
			font-family: 'Ubuntu Mono', monospaced;
		}

		.add-to-cart .btn-qty {
			width: 52px;
			height: 46px;
		}
	</style>
	<link rel="stylesheet" href="/bootstrap4/css/black-yellow.css">
	<?php $this->xajax->printJavascript(); ?>
	<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->
	<script defer='defer' id='cjax_lib' type='text/javascript' src='cjax/core/js/cjax-5.0-Stable.min.js'></script>
</head>
<body>
<header class="site-header-container" id="section-1">
	<div class="site-header">
		<div class="site-header-collapsed">
			<div class="site-header-collapsed-in">
				<div class="container">
					<div class="site-logo">Trecksandtraks</div>
					<div class="site-header-right">
						<nav class="site-menu" id="page-nav">
							<ul>
								<li><a href="#section-1"><span>Main</span></a></li>
								<li><a href="#section-2"><span>Our Activities</span></a></li>
								<li><a href="#section-3"><span>About Us</span></a></li>
								<li><a href="#section-4"><span>Contact</span></a></li>
							</ul>
						</nav>
						<a href="#" class="btn btn-sm btn-fill">Redemption Code</a></div>
				</div>
			</div>
		</div>
		<div class="site-header-clone">
			<div class="container">
				<div class="site-logo">Trecksandtraks</div>
				<button type="button" class="burger"><span></span> <span></span> <span></span></button>
			</div>
		</div>
	</div>
</header>
<section class="section-promo">
	<div class="container">
		<div class="section-promo-txt">
			<h1>Come with us!</h1>
			<li>Backpacking Tours</li>
			<li>Rock Climbing</li>
			<li>Survival Classes</li>
			<li>Summer Classes for Children</li>
			<div class="btns-group"><a href="#" class="btn btn-inverse">Find out more</a></div>
		</div>
		<div class="section-promo-pic"><img src="/bootstrap4/content/316591_10150293849480666_148987571_n.jpg" alt="">
		</div>
	</div>
</section>
<section class="section" id="section-2">
	<div class="container">
		<header class="title-section">
			<h3>Choose what's best for you!</h3>
			<div class="sub">This is what we do</div>
		</header>
		<div class="btns-group">
			<? if ($styles) : ;
				foreach ($styles as $style) : ;
					?>
					<a class="btn " onClick="xajax_getProducts(<?= $style->style_id ?>);return false;" href="#">
						<?= $style->name ?>
					</a>
				<? endforeach; endif ?>
			<a href="#" class="btn " onClick="xajax_getProducts(0);return false;">All </a></div>
		<div class="row">
			<div id="product_display">
				<? $i = 0 ?>
				<? if ($all_classes) : foreach ($all_classes as $row) : ?>
					<? $picture = base_url() . CLASSES_IMAGE_DIR . strtoupper($row->code) . '/' . strtoupper($row->code) . '1.jpg'; ?>
					<div class="col-lg-4 col-md-6">
						<article class="card-item" style="background-image: url(' <?= $picture ?>');"><img
								class="card-item-pic" src="<?= $picture ?>" alt="">
							<div class="card-item-hover"><a
									href="<?= site_url() . 'tt_v2/product/' . $row->activity_id ?>"
									class="btn btn-inverse-colored">
									<?= $row->rate_price_price ?>
								</a></div>
							<header class="card-item-caption">
								<h4>
									<?= $row->name ?>
								</h4>
							</header>
						</article>
					</div>
					<? $i++ ?>
				<? endforeach ?>
				<? else : ?>
					<p style="margin-left:15px; font-weight:bold;"> No class in this group found! Please choose from
						another group. </p>
				<? endif ?>
			</div>
		</div>
	</div>
</section>
<section class="section-fill">
	<div class="container">
		<div class="tbl txt-btn-block">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h3>Suggest new features for next updates</h3>
					<p>If you’re thinking about an amazing (or simply useful) feature/page we havent added yet, tell us!
						We welcome any feedback with open arms.</p>
				</div>
				<div class="tbl-cell tbl-cell-action"><a href="#" class="btn btn-inverse-colored">Give us feedback</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section" id="section-7">
	<div class="container">
		<header class="title-section">
			<h3>Our pricing</h3>
			<div class="sub">Deserunt nesciunt sed molestiade quos, dolor eaque facilis tempora consequuntu</div>
		</header>
		<div class="row">
			<div class="col-md-6"><img src="../../../images/BRCCRSP/brccrsp-main.jpg" alt="activity phptp"
			                           class="img-responsive"/></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<h1>Kodak 'Brownie' Flash B Camera</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><span class="label label-primary">Vintage</span> <span class="monospaced">No. 1960140180</span>
					</div>
				</div>
				<!-- end row -->
				<div class="row">
					<div class="col-md-12">
						<p class="description"> Classic film camera. Uses 620 roll film.
							Has a 2&frac14; x 3&frac14; inch image size. </p>
					</div>
				</div>
				<!-- end row -->
				<div class="row">
					<div class="col-md-3"><span class="sr-only">Four out of Five Stars</span> <span
							class="glyphicon glyphicon-star" aria-hidden="true"></span> <span
							class="glyphicon glyphicon-star" aria-hidden="true"></span> <span
							class="glyphicon glyphicon-star" aria-hidden="true"></span> <span
							class="glyphicon glyphicon-star" aria-hidden="true"></span> <span
							class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> <span
							class="label label-success">61</span></div>
					<div class="col-md-3"><span class="monospaced">Write a Review</span></div>
				</div>
				<!-- end row -->
				<div class="row">
					<div class="col-md-12 bottom-rule">
						<h2 class="product-price">$129.00</h2>
					</div>
				</div>
				<!-- end row -->

				<div class="row add-to-cart">
					<div class="col-md-5 product-qty"><span class="btn btn-default btn-lg btn-qty"> <span
								class="glyphicon glyphicon-plus" aria-hidden="true"></span> </span>
						<input class="btn btn-default btn-lg btn-qty" value="1"/>
						<span class="btn btn-default btn-lg btn-qty"> <span class="glyphicon glyphicon-minus"
						                                                    aria-hidden="true"></span> </span></div>
					<div class="col-md-4">
						<button class="btn btn-lg btn-brand btn-full-width"> Add to Cart</button>
					</div>
				</div>
				<!-- end row -->

				<div class="row">
					<div class="col-md-4 text-center"><span class="monospaced">In Stock</span></div>
					<div class="col-md-4 col-md-offset-1 text-center"><a class="monospaced" href="#">Add to Shopping
							List</a></div>
				</div>
				<!-- end row -->
				<div class="row">
					<div class="col-md-12 bottom-rule top-10"></div>
				</div>
				<!-- end row -->

				<div class="row">
					<div class="col-md-12 top-10">
						<p>To order by telephone, <a href="tel:18005551212">please call 1-800-555-1212</a></p>
					</div>
				</div>
				<!-- end row -->

			</div>
			<div class="col-md-12">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#description"
					                                          aria-controls="description"
					                                          role="tab"
					                                          data-toggle="tab"
						>Description</a></li>
					<li role="presentation"><a href="#features"
					                           aria-controls="features"
					                           role="tab"
					                           data-toggle="tab"
						>Features</a></li>
					<li role="presentation"><a href="#notes"
					                           aria-controls="notes"
					                           role="tab"
					                           data-toggle="tab"
						>Notes</a></li>
					<li role="presentation"><a href="#reviews"
					                           aria-controls="reviews"
					                           role="tab"
					                           data-toggle="tab"
						>Reviews</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="description"> description</div>
					<div role="tabpanel" class="tab-pane top-10" id="features"> features</div>
					<div role="tabpanel" class="tab-pane" id="notes"> notes</div>
					<div role="tabpanel" class="tab-pane" id="reviews"> reviews</div>
				</div>
			</div>
		</div>
</section>
<section class="section" id="section-3">
	<div class="container">
		<header class="title-section">
			<h3>Extra-Pages</h3>
			<div class="sub">Add new pages to your project by using these additional layouts.</div>
		</header>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/10.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>Sign Up Page</h4>
					</header>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/11.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>Login Page</h4>
					</header>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/12.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>Blog List</h4>
					</header>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/4.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>Blog Single</h4>
					</header>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/13.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>Terms/Condition Page</h4>
					</header>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="card-item card-item-colored"><img class="card-item-pic" src="content/14.jpg" alt="">
					<div class="card-item-hover"><a href="#" class="btn btn-inverse-colored">View Demo</a></div>
					<header class="card-item-caption">
						<h4>FAQ Page</h4>
					</header>
				</article>
			</div>
		</div>
	</div>
</section>
<section class="section section-fill" id="section-4">
	<div class="container">
		<header class="title-section">
			<h3>Unlimited Landing Page Possibilities</h3>
			<div class="sub">Getleads is a flexible, well crafted template thet offers a range of unique concepts and
				modern pre-design blocks. Pretty fast and smarty responsive.
			</div>
		</header>
		<div class="btns-group"><a href="#" class="btn btn-inverse">Try page builder</a> <a href="#"
		                                                                                    class="btn btn-fill">Buy
				<span class="hidden-sm-down">getleads</span> on themeforest</a></div>
	</div>
</section>
<section class="section" id="section-5">
	<div class="container">
		<header class="title-section">
			<h3>Modern tools</h3>
		</header>
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<article class="icon-txt-item"><i class="font-icon font-icon-rocket"></i>
					<h4>Boost performance</h4>
					<p>GRID displays your content in an eye-catching way and enables customizable internal
						distribution.</p>
				</article>
			</div>
			<div class="col-lg-3 col-sm-6">
				<article class="icon-txt-item"><i class="font-icon font-icon-equalizer"></i>
					<h4>Higly customizable</h4>
					<p>Key features flexible layouts and themes to customize your content's unique look.</p>
				</article>
			</div>
			<div class="clearfix hidden-lg-up"></div>
			<div class="col-lg-3 col-sm-6">
				<article class="icon-txt-item"><i class="font-icon font-icon-pencil"></i>
					<h4>Simplified workflow</h4>
					<p>Key is the first-ever truly team-friendly media CMS. Collaborating on content is efficient.</p>
				</article>
			</div>
			<div class="col-lg-3 col-sm-6">
				<article class="icon-txt-item"><i class="font-icon font-icon-devices"></i>
					<h4>Cross platform</h4>
					<p>Credibly innovate granular internal or "organic" sources whereas high standards in
						web-readiness.</p>
				</article>
			</div>
		</div>
	</div>
</section>
<section class="section section-fill" id="section-6">
	<div class="container">
		<header class="title-section">
			<h3>Our video</h3>
			<div class="sub">Partnership or temporary organization perfectly designed</div>
		</header>
		<div class="video-container"><img class="poster" src="content/video.jpg" alt="">
			<iframe src="https://www.youtube.com/embed/JSnB06um5r4" frameborder="0" allowfullscreen></iframe>
			<div class="video-preview"><i class="font-icon font-icon-play"></i></div>
		</div>
		<div class="social-icons"><a href="#"><i class="font-icon font-icon-fb"></i></a> <a href="#"><i
					class="font-icon font-icon-vk"></i></a> <a href="#"><i class="font-icon font-icon-gp"></i></a></div>
	</div>
</section>
<footer class="site-footer">
	<section class="footer-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<header class="footer-title">About us</header>
					<p>Beta business plan growth hacking fruit ecosystem hypotheses investor ramen. MVP equity research
						& development early adopters burn rate backing funding.</p>
				</div>
				<div class="col-lg-3">
					<header class="footer-title">Company</header>
					<div class="row">
						<div class="col-xs-6">
							<ul class="footer-list">
								<li><a href="#">Main</a></li>
								<li><a href="#">Features</a></li>
								<li><a href="#">Video</a></li>
							</ul>
						</div>
						<div class="col-xs-6">
							<ul class="footer-list">
								<li><a href="#">Pricing</a></li>
								<li><a href="#">Team</a></li>
								<li><a href="#">Clients</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<header class="footer-title">Subscribe to newsletter</header>
					<form class="form-subscribe">
						<input type="text" placeholder="E-mail address"/>
						<button type="button">Subscribe</button>
					</form>
					<p>We promise that we will never share your e-mail address</p>
				</div>
			</div>
		</div>
	</section>
	<section class="footer-bottom">
		<div class="container">
			<div class="copy">&copy; 2016 ThemesAnytime, all rights reserved</div>
			<div class="social"><a href="#" title="facebook"><i class="font-icon font-icon-fb"></i></a> <a href="#"
			                                                                                               title="vkontakte"><i
						class="font-icon font-icon-vk"></i></a> <a href="#" title="odnoklassniki"><i
						class="font-icon font-icon-ok"></i></a> <a href="#" title="twitter"><i
						class="font-icon font-icon-tw"></i></a> <a href="#" title="google plus"><i
						class="font-icon font-icon-gp"></i></a> <a href="#" title="linkedin"><i
						class="font-icon font-icon-in"></i></a> <a href="#" title="instagram"><i
						class="font-icon font-icon-inst"></i></a></div>
		</div>
	</section>
</footer>
<script
	src="https://code.jquery.com/jquery-2.2.2.min.js"
	integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="
	crossorigin="anonymous"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="/bootstrap4/js/main.js"></script>
</body>
</html>
