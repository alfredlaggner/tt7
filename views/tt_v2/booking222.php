<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
<head>
	<!-- Page Title -->
	<title>Travelo | Responsive HTML5 Travel Template</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template"/>
	<meta name="description" content="Travelo | Responsive HTML5 Travel Template">
	<meta name="author" content="SoapTheme">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Theme Styles -->
	<link rel="stylesheet" href="../../../travelo/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../travelo/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../../travelo/css/animate.min.css">

	<!-- Current Page Styles -->
	<link rel="stylesheet" type="text/css" href="../../../travelo/components/revolution_slider/css/settings.css"
	      media="screen"/>
	<link rel="stylesheet" type="text/css" href="../../../travelo/components/revolution_slider/css/style.css"
	      media="screen"/>
	<link rel="stylesheet" type="text/css" href="../../../travelo/components/jquery.bxslider/jquery.bxslider.css"
	      media="screen"/>
	<link rel="stylesheet" type="text/css" href="../../../travelo/components/flexslider/flexslider.css" media="screen"/>

	<!-- Main Style -->
	<link id="main-style" rel="stylesheet" href="../../../travelo/css/style.css">

	<!-- Custom Styles -->
	<link rel="stylesheet" href="../../../travelo/css/custom.css">

	<!-- Updated Styles -->
	<link rel="stylesheet" href="../../../travelo/css/updates.css">

	<!-- Responsive Styles -->
	<link rel="stylesheet" href="../../../travelo/css/responsive.css">

	<!-- CSS for IE -->
	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
	<![endif]-->
</head>
<body>
<div id="page-wrapper">
	<?= $header ?>
	<div class="page-title-container">
		<div class="container">
			<div class="page-title pull-left">
				<h2 class="entry-title">Cruise Booking</h2>
			</div>
			<ul class="breadcrumbs pull-right">
				<li><a href="#">home</a></li>
				<li class="active">Cruise Booking</li>
			</ul>
		</div>
	</div>
	<section id="content" class="gray-area">
		<div class="container">
			<div class="row">
				<div id="main" class="col-sm-8 col-md-9">
					<div class="booking-section travelo-box">
						<? for ($i = 1; $i <= $nr_of_students; $i++) : ?>
							<script>
								jQuery(function ($) {
									$("#cell<?= $i ?>").mask("(999) 999-9999");
									$("#emergency_phone<?= $i ?>").mask("(999) 999-9999");
								});
							</script>
							<div class="clr"></div>
						<? if ($i == 1) : ?>
						<h2><span>STUDENT </span>
							<? if ($nr_of_students > 1) : ?>
							Primary Contact</h2>
						<? else : ?>
							</h2>
						<? endif ?>
						<? else : ?>
							<h2><span>STUDENT </span>
								<? if ($error) echo "Something went wrong : " . $error; ?>
								<?= $i ?>
							</h2>
						<? endif ?>
						<? if ($i == 1) : ?>
						<? $attributes = array('id' => 'ledger', 'name' => 'ledger', 'class' => "cruise-booking-form");

						echo form_open('tt_v2/create_booking', $attributes); ?>
						<? if (isset($events)) : foreach ($events as $event) : ?>
						<input type="hidden" name="event_id" value="<?= $event_id ?>">
							<?= form_hidden('nr_of_students', $nr_of_students); ?>
						<input type="hidden" name="promo_code" class="text" value="<?= $promo_code ?>">
						<input type="hidden" name="location_id" value="<?= $location_id ?>">
						<input type="hidden" name="activity_id" id="activity_id" value='<?= $event['activity_id'] ?>'/>
						<input type="hidden" name="booking_date" id="booking_date" value='<?= date("Y-m-d g:i:s") ?>'/>
						<input type="hidden" name="name" id="name" class="text" readonly="readonly" value=''/>
						<input type="hidden" name="date" id="date" class="text" readonly
						       value='<? echo $event['event_date'] ?>'/>
						<input type="hidden" name="time" id="time" class="text" readonly
						       value='<?= $event['event_time'] ?>'/>
						<input type="hidden" name="duration" id="duration" class="text" readonly
						       value='<? echo $event['duration'] ?>'/>
						<input type="hidden" name="instructor" id="instructor" class="text" readonly value='
							<? $event['instructor'] = $this->event_to_employee_model->get_employee_string($event['event_event_id']);
						echo $event['instructor'] ?>'/>
						<input type="hidden" name="price" id="price" class="text" readonly
						       value='<? echo $event['rate_price'] ?>'/>
						<input type="hidden" name="exp_discount_price" id="exp_discount_price" class="text" readonly
						       value='<? echo $event['exp_discount_price'] ?>'/>
						<input type="hidden" name="discount" id="discount" class="text" readonly
						       value='<?= $event['discount'] ?>'/>
						<input type="hidden" name="tax" id="tax" class="text" readonly value='<?= $event['tax'] ?>'/>
						<input type="hidden" name="available" id="available" class="text" readonly
						       value='<?= $event['available']; ?>'/>
						<input type="hidden" name="attending" id="attending" class="text" readonly
						       value='<?= $event['attending']; ?>'/>
						<? endforeach ?>
						<? else : ?>
							<?= "no events delivered!" ?>
						<? endif ?>
						<? endif ?>
							<div class="person-information">
								<h2>Your Personal Information</h2>
								<div class="row">
									<div class="form-group col-sm-6 col-md-5">
										<? if ($i == 1) : ?>
											<label>first name<span> *</span></label>
											<input type="text" class="input-text full-width validate[required]"
											       name="first_name<?= $i ?>" id="first_name<?= $i ?>" value=""
											       placeholder="First Name"/>
										<? else : ?>
											<label>first name</label>
											<input type="text" class="input-text full-width" name="first_name<?= $i ?>"
											       id="first_name<?= $i ?>" value="" placeholder="First Name"/>
										<? endif ?>
									</div>
									<div class="form-group col-sm-6 col-md-5">
										<? if ($i == 1) : ?>
											<label>last name<span> *</span></label>
											<input type="text" class="input-text full-width validate[required]"
											       name="last_name<?= $i ?>" id="last_name<?= $i ?>" value=""
											       placeholder="Last Name"/>
										<? else : ?>
											<label>last name</label>
											<input type="text" class="input-text full-width" name="last_name<?= $i ?>"
											       id="last_name<?= $i ?>" value="" placeholder="Last Name"/>
										<? endif ?>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6 col-md-5">
										<? if ($i == 1) : ?>
											<label>email address<span> *</span></label>
											<input type="text"
											       class="input-text full-width validate[required,custom[email]]"
											       name="email<?= $i ?>" id="email<?= $i ?>" value=""
											       placeholder="Last Name"/>
										<? else : ?>
											<label>email address</label>
											<input type="text" class="input-text full-width" name="email<?= $i ?>"
											       id="email<?= $i ?>" value="" placeholder="Last Name"/>
										<? endif ?>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6 col-md-5">
										<label>Country of Citizenship</label>
										<div class="selector">
											<select class="full-width">
												<option>United Kingdom</option>
												<option>United States</option>
											</select>
										</div>
									</div>
									<div class="form-group col-sm-6 col-md-5">
										<div class="row">
											<div class="col-xs-6">
												<label>Date of Birth</label>
												<div class="datepicker-wrap">
													<input type="text" class="input-text full-width"
													       placeholder="mm/dd/yy" data-min-date="01/01/1900">
												</div>
											</div>
											<div class="col-xs-6">
												<label>Gender</label>
												<div>
													<label class="radio radio-inline radio-square">
														<input type="radio" name="gender" checked="checked">
														Male </label>
													<label class="radio radio-inline radio-square">
														<input type="radio" name="gender">
														Female </label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6 col-md-5">
										<label>Country code</label>
										<div class="selector">
											<select class="full-width">
												<option>United Kingdom (+44)</option>
												<option>United States (+1)</option>
											</select>
										</div>
									</div>
									<div class="form-group col-sm-6 col-md-5">
										<label>Phone number</label>
										<input type="text" class="input-text full-width" value="" placeholder=""/>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6 col-md-5">
										<label>Home Address</label>
										<input type="text" class="input-text full-width" value="" placeholder=""/>
									</div>
									<div class="form-group col-sm-6 col-md-5">
										<div class="row">
											<div class="col-xs-6">
												<label>State</label>
												<div class="selector full-width">
													<select>
														<option value="uk">UK</option>
													</select>
												</div>
											</div>
											<div class="col-xs-6">
												<label>Zipcode</label>
												<input type="text" class="input-text full-width">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox">
											I want to receive <span class="skin-color">Travelo</span> promotional offers
											in the future </label>
									</div>
								</div>
							</div>
							<hr/>
						<? endfor ?>
						<div class="card-information">
							<h2>Your Card Information</h2>
							<div class="row">
								<div class="form-group col-sm-6 col-md-5">
									<label>Credit Card Type</label>
									<div class="selector">
										<select class="full-width">
											<option>select a card</option>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-6 col-md-5">
									<label>Card holder name</label>
									<input type="text" class="input-text full-width" value="" placeholder=""/>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6 col-md-5">
									<label>Card number</label>
									<input type="text" class="input-text full-width" value="" placeholder=""/>
								</div>
								<div class="form-group col-sm-6 col-md-5">
									<label>Card identification number</label>
									<input type="text" class="input-text full-width" value="" placeholder=""/>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6 col-md-5">
									<label>Expiration Date</label>
									<div class="constant-column-2">
										<div class="selector">
											<select class="full-width">
												<option>month</option>
											</select>
										</div>
										<div class="selector">
											<select class="full-width">
												<option>year</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group col-sm-3 col-md-2">
									<label>billing zip code</label>
									<input type="text" class="input-text full-width" value="" placeholder=""/>
								</div>
							</div>
						</div>
						<hr/>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox">
									By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
								</label>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6 col-md-5">
								<button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
							</div>
						</div>
						</form>
					</div>
				</div>
				<div class="sidebar col-sm-4 col-md-3">
					<div class="booking-details travelo-box">
						<h4>Booking Details</h4>
						<article class="image-box cruise listing-style1">
							<figure class="clearfix"><a title="" href="../../../travelo/cruise-detailed.html"
							                            class="hover-effect middle-block"><img class="middle-item"
							                                                                   alt=""
							                                                                   src="http://placehold.it/75x75"></a>
								<div class="travel-title">
									<h5 class="box-title">Carnival
										<small>baja mexico</small>
									</h5>
									<a href="../../../travelo/cruise-detailed.html" class="button">EDIT</a></div>
							</figure>
							<div class="details">
								<div class="feedback">
									<div data-placement="bottom" data-toggle="tooltip" title="4 stars"
									     class="five-stars-container"><span style="width: 80%;"
									                                        class="five-stars"></span></div>
									<span class="review">270 reviews</span></div>
								<div class="constant-column-3 timing clearfix">
									<div class="check-in">
										<label>Departs</label>
										<span>FEB 10, 2014<br/>
										10 am</span></div>
									<div class="duration text-center"><i class="soap-icon-clock"></i>
										<span>4 Nights</span></div>
									<div class="check-out">
										<label>Returns</label>
										<span>feb 15, 2014<br/>
										2 PM</span></div>
								</div>
								<div class="guest">
									<small class="uppercase">1 grand suite for <span class="skin-color">2 Persons</span>
									</small>
								</div>
							</div>
						</article>
						<h4>Other Details</h4>
						<dl class="other-details">
							<dt class="feature">room Type:</dt>
							<dd class="value">Grand Suite</dd>
							<dt class="feature">food &amp; dining:</dt>
							<dd class="value">$121</dd>
							<dt class="feature">Cruise price:</dt>
							<dd class="value">$529</dd>
							<dt class="feature">taxes and fees:</dt>
							<dd class="value">$173</dd>
							<dt class="total-price">Total Price</dt>
							<dd class="total-price-value">$823</dd>
						</dl>
					</div>
					<div class="travelo-box contact-box">
						<h4>Need Travelo Help?</h4>
						<p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help
							you.</p>
						<address class="contact-details">
							<span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span> <br>
							<a class="contact-email" href="#">help@travelo.com</a>
						</address>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer id="footer">
		<div class="footer-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<h2>Discover</h2>
						<ul class="discover triangle hover row">
							<li class="col-xs-6"><a href="#">Safety</a></li>
							<li class="col-xs-6"><a href="#">About</a></li>
							<li class="col-xs-6"><a href="#">Travelo Picks</a></li>
							<li class="col-xs-6"><a href="#">Latest Jobs</a></li>
							<li class="active col-xs-6"><a href="#">Mobile</a></li>
							<li class="col-xs-6"><a href="#">Press Releases</a></li>
							<li class="col-xs-6"><a href="#">Why Host</a></li>
							<li class="col-xs-6"><a href="#">Blog Posts</a></li>
							<li class="col-xs-6"><a href="#">Social Connect</a></li>
							<li class="col-xs-6"><a href="#">Help Topics</a></li>
							<li class="col-xs-6"><a href="#">Site Map</a></li>
							<li class="col-xs-6"><a href="#">Policies</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3">
						<h2>Travel News</h2>
						<ul class="travel-news">
							<li>
								<div class="thumb"><a href="#"> <img src="http://placehold.it/63x63" alt="" width="63"
								                                     height="63"/> </a></div>
								<div class="description">
									<h5 class="s-title"><a href="#">Amazing Places</a></h5>
									<p>Purus ac congue arcu cursus ut vitae pulvinar massaidp.</p>
									<span class="date">25 Sep, 2013</span></div>
							</li>
							<li>
								<div class="thumb"><a href="#"> <img src="http://placehold.it/63x63" alt="" width="63"
								                                     height="63"/> </a></div>
								<div class="description">
									<h5 class="s-title"><a href="#">Travel Insurance</a></h5>
									<p>Purus ac congue arcu cursus ut vitae pulvinar massaidp.</p>
									<span class="date">24 Sep, 2013</span></div>
							</li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3">
						<h2>Mailing List</h2>
						<p>Sign up for our mailing list to get latest updates and offers.</p>
						<br/>
						<div class="icon-check">
							<input type="text" class="input-text full-width" placeholder="your email"/>
						</div>
						<br/>
						<span>We respect your privacy</span></div>
					<div class="col-sm-6 col-md-3">
						<h2>About Travelo</h2>
						<p>Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore
							elerisque.</p>
						<br/>
						<address class="contact-details">
							<span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span> <br/>
							<a href="#" class="contact-email">help@travelo.com</a>
						</address>
						<ul class="social-icons clearfix">
							<li class="twitter"><a title="twitter" href="#" data-toggle="tooltip"><i
										class="soap-icon-twitter"></i></a></li>
							<li class="googleplus"><a title="googleplus" href="#" data-toggle="tooltip"><i
										class="soap-icon-googleplus"></i></a></li>
							<li class="facebook"><a title="facebook" href="#" data-toggle="tooltip"><i
										class="soap-icon-facebook"></i></a></li>
							<li class="linkedin"><a title="linkedin" href="#" data-toggle="tooltip"><i
										class="soap-icon-linkedin"></i></a></li>
							<li class="vimeo"><a title="vimeo" href="#" data-toggle="tooltip"><i
										class="soap-icon-vimeo"></i></a></li>
							<li class="dribble"><a title="dribble" href="#" data-toggle="tooltip"><i
										class="soap-icon-dribble"></i></a></li>
							<li class="flickr"><a title="flickr" href="#" data-toggle="tooltip"><i
										class="soap-icon-flickr"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom gray-area">
			<div class="container">
				<div class="logo pull-left"><a href="../../../travelo/index.html" title="Travelo - home"> <img
							src="../../../travelo/images/logo.png" alt="Travelo HTML5 Template"/> </a></div>
				<div class="pull-right"><a id="back-to-top" href="#" class="animated" data-animation-type="bounce"><i
							class="soap-icon-longarrow-up circle"></i></a></div>
				<div class="copyright pull-right">
					<p>&copy; 2014 Travelo</p>
				</div>
			</div>
		</div>
	</footer>
</div>

<!-- Javascript -->
<script type="text/javascript" src="../../../travelo/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../../travelo/js/jquery.noconflict.js"></script>
<script type="text/javascript" src="../../../travelo/js/modernizr.2.7.1.min.js"></script>
<script type="text/javascript" src="../../../travelo/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../../../travelo/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="../../../travelo/js/jquery-ui.1.10.4.min.js"></script>

<!-- Twitter Bootstrap -->
<script type="text/javascript" src="../../../travelo/js/bootstrap.js"></script>

<!-- load revolution slider scripts -->
<script type="text/javascript"
        src="../../../travelo/components/revolution_slider/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript"
        src="../../../travelo/components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- load BXSlider scripts -->
<script type="text/javascript" src="../../../travelo/components/jquery.bxslider/jquery.bxslider.min.js"></script>

<!-- load FlexSlider scripts -->
<script type="text/javascript" src="../../../travelo/components/flexslider/jquery.flexslider-min.js"></script>

<!-- Google Map Api -->
<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script type="text/javascript" src="../../../travelo/js/calendar.js"></script>

<!-- parallax -->
<script type="text/javascript" src="../../../travelo/js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="../../../travelo/js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="../../../travelo/js/theme-scripts.js"></script>
<script type="text/javascript" src="../../../travelo/js/scripts.js"></script>

<script type="text/javascript" src="<?= base_url() ?>akaishi/assets/js/jquery.1.7.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js_tt/jquery.validationEngine.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript">
	$(document).ready(function () {
		$("#ledger").validationEngine('attach',
			{promptPosition: "topRight", scroll: true});
	});
	jQuery(function ($) {
		$("#exp").mask("99/99");
		$("#ccv").mask("999");
	});
</script>
</script>
</
body >
< / html >;
;
