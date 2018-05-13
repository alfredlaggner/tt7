<style>
	.site-header {
		position: absolute;
		left: 0;
		top: 20px;
		width: 100%;
		color: #fff;
		line-height: 52px;
		z-index: 20;
	}

	.site-header-container {
		background: white /*#00a998 */;
	}

	.site-menu {
		font-family: 'Code Pro LC', sans-serif;
		font-weight: 500;
		color: black;
	}

	.site-menu a {
		text-decoration: none;
		color: black;
	}

	.btn {
		height: 56px;
		border: 3px solid #00a998;
		line-height: 50px;
		padding: 2px 25px 0;
		color: #00a998;
		font-size: 1.125rem;
		font-weight: 500
	}

	.btn:hover {
		background-color: #00a998;
		color: #fff
	}

	.btn.btn-fill {
		color: #000;
		background-color: #B5DA83;
		border-color: #B5DA83 /*#b1f03e */
	}

	.btn.btn-fill:hover {
		background-color: #96df11; /* #96df11; */
		border-color: #96df11; /*#96df11*/
	}

	.site-header.fixed .btn.btn-fill {
		background-color: white; /* #96df11; */
		border-color: #B5DA83; /*#96df11*/

		/*background-color: #00a998;*/
		/*border-color: #00a998;*/
		color: black;
	}

	.site-header.fixed .btn.btn-fill:hover {
		background-color: #96df11; /* #96df11; */
		border-color: #96df11; /*#96df11*/
		color: black;
	}

	.site-header.fixed .site-menu a {
		text-decoration: none;
		color: black /* #00a998 */;
	}

	.site-header.fixed .site-menu a:hover {
		text-decoration: none;
		color: #6BAE3C; /* #00a998 */;
	}

	.site-menu a:hover {
		text-decoration: none;
		color: #6BAE3C; /* #b1f03e*/
	}

	.site-menu a.current {
		color: #b1f03e
	}

	.card-item .card-item-caption h1, .card-item .card-item-caption h2, .card-item .card-item-caption h3, .card-item .card-item-caption h4, .card-item .card-item-caption h5, .card-item .card-item-caption h6 {
		position: absolute;
		left: 0;
		bottom: 0;
		width: 100%;
		margin: 0;
		font-weight: 500;
		font-size: 1.125rem;
		padding: 15px;
	}

</style>

<script src="/bootstrap4/js/main.js"></script>

<header class="site-header-container" id="section-1">
	<div class="site-header">
		<div class="site-header-collapsed">
			<div class="site-header-collapsed-in">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-xs-12">

							<a href="<?= base_url() ?>tt_v3"><img src="<?= base_url() ?>images/img-header-logo.png"
							                                      alt="Logo"></a>
						</div>
						<div class="col-md-5 col-xs-12">
							<div class="site-header-right" style="padding-top: 10px">
								<nav class="site-menu">
									<ul>
										<li><a href=<?= site_url() . "tt_v3" ?>><span>Home</span></a></li>
										<li>
											<a href=<?= site_url() . "tt_v3/index/#top" ?>><span>Classes</span></a>
										</li>
										<li><a href="<?= site_url() ?>menu_pages_v3/about_us"><span>About Us</span></a>
										</li>
									</ul>
								</nav>

							</div>
						</div>
						<div class="col-md-3 col-xs-12">
							<button type="button" class="btn btn-fill btn-sm btn-block" data-toggle="modal"
							        data-target="#myModal">
								Have a Voucher?
							</button>
							<button type="button" class="btn btn-fill btn-sm btn-block" data-toggle="modal"
							        data-target="#downloads">
								Download Forms
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-header-clone">
			<div class="container">
				<div class="site-logo">Treksandtracks</div>
				<button type="button" class="burger">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</div>
	</div>
</header>




<style>
	.bootstrap-demo {
		margin: 10px;
	}
</style>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Voucher Redemption Instructions</h4>
			</div>
			<div class="modal-body">

				<p>1. Select the 'Activity' which you have a voucher for</p>
				<p>2. Select 'Book Now' on the activity page</p>
				<p>3. Select location and date </p>
				<p>4. Select the number of participants from the drop down menu</p>
				<p>5. Enter your <b>voucher#</b> into the 'Promotion Code' field- wait for system to recognize the code.
				</p>
				<p>6. Click continue</p>
				<p>7. Enter participant information</p>
				<p>8. Click 'Continue'</p>
				<p>9. Confirm your booking</p>
				<p> Present voucher upon arrival.</p>
				<p> Enjoy!</p>

				<h3>Voucher Expiring Instructions</h3>

				<p><b>Buy yourself more time to take a class by extending your voucher expiration date!</b></p>

				<p>For only $25 we will extend your expiration date for 6 months!</p>
				<p>To do this, email your voucher code(s) to <a href="mailto:info@treksandtracks.com">info@treksandtracks.com</a>
					 and tell us that you need an extension.</p>
			</div>
			<!-- <div class="modal-footer">
				 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				 <button type="button" class="btn btn-primary">Save changes</button>
			 </div>-->
		</div>
	</div>
</div>
<div class="modal fade" id="downloads" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Downloads</h4>
			</div>
			<div class="modal-body">
				<ul class="footer-list">
					<li><a href="<?= base_url('attachment_files') ?>/liability waiver back packing.pdf" download>Backpacking
							liability form</a></li>
					<li><a href="<?= base_url('attachment_files/') ?>/Rock climbing liability form.pdf"
					       download>Rock climbing liability form</a></li>
					<li>
						<a href="<?= base_url('attachment_files') ?>/Backpacking General Gear list.docx"
						   download>Overnight backpacking gear list</a></li>
					<li><a href="<?= base_url('attachment_files') ?>/Half Dome gear list.docx"
					       download>Half Dome gear list</a></li>
					<li>
						<a href="<?= base_url('attachment_files') ?>/Wilderness Survival Class Gear list.docx"
						   download>Yosemite 3 day survival course gear list</a></li>
				</ul>

			</div>
			<!-- <div class="modal-footer">
				 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				 <button type="button" class="btn btn-primary">Save changes</button>
			 </div>-->
		</div>
	</div>
</div>