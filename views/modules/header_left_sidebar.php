<!--<body id="sidebar-left">
-->
<div id="page_wrapper">
	<div id="page-header">
		<?php $user = $this->ion_auth->get_user(); ?>
		<div id="page-header-wrapper">
			<div id="top"><a href="dashboard" class="logo" title="TreksandTracks Admin">Treksandtrcks Admin</a>
				<div class="welcome"><span class="note">Welcome, <a href="#"
				                                                    title="Welcome, <?php echo $user->username; ?>"><?php echo $user->username; ?></a></span>
					<a class="btn ui-state-default ui-corner-all" href="#"> <span class="ui-icon ui-icon-wrench"></span>
						Settings </a> <a class="btn ui-state-default ui-corner-all" href="#"> <span
							class="ui-icon ui-icon-person"></span> My account </a> <a
						class="btn ui-state-default ui-corner-all" href="<?php echo site_url() . 'auth/logout' ?>">
						<span class="ui-icon ui-icon-power"></span> Logout </a></div>
			</div>
			<ul id="navigation">
				<li>
					<a href="#" class="sf-with-ul">Day to Day</a>
					<ul>
						<li>
							<a href="<?= site_url() . 'dashboard' ?>" class="sf-with-ul">Dashboard</a>
							<ul>
								<li><a href="<?= site_url() . 'dashboard' ?>#events_management">Events Management</a>
								</li>
								<li><a href="<?= site_url() . 'dashboard' ?>#ledger_statistics">Ledger Statistics</a>
								</li>
								<li><a href="<?= site_url() . 'dashboard' ?>#edit_discount_code">Edit Discount Code</a>
								</li>
							</ul>
						</li>
						<li><a href="<?php echo site_url() . 'calendar/display' ?>">Calendar</a></li>
						<li><a href="#" class="sf-with-ul">Discounts</a>
							<ul>
								<li><a href="<?= site_url() . 'discount/upload' ?>">Discount Codes Upload</a>
								</li>
								<li><a href="<?= site_url() . 'discount/index/1' ?>">View Imported Discounts</a></li>
								<li><a href="<?= site_url() . 'discount/group_discount_show/0/""' ?>">View Managed
										Discounts </a></li>
							</ul>
						</li>
						<li><a href="<?= site_url() . 'dashboard/backup_database' ?>" ">Backup Database</a></li>

					</ul>
				</li>
				<li>
					<a href="#" class="sf-with-ul">Activity Management</a>
					<ul>
						<li><a href="<?= site_url() . 'activity' ?>">Design and Manage Products</a></li>
						<li><a href="<?= site_url() . 'location' ?>">Locations</a></li>
						<li><a href="<?= site_url() . 'physical_level' ?>">Physical Level</a></li>
						<li><a href="<?= site_url() . 'style' ?>">Activity Groups</a></li>
						<li><a href="<?= site_url() . 'service_level' ?>">Service Levels</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="sf-with-ul">Email Management</a>
					<ul>
						<li><a href="<?= site_url() . 'template' ?>">Manage eMail Templates</a></li>
						<li><a href="<?= site_url() . 'attachment/upload_attachments' ?>">Upload Attachments</a></li>
						<li><a href="<?= site_url() . 'customer_contact/booked_customers_overview' ?>">Sent emails by Customer</a></li>
						<li><a href="<?= site_url() . 'mail_sent' ?>">Sent eMails by Date</a></li>
						<li><a href="<?= site_url() . 'service_level' ?>">Send Reminder Emails</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="sf-with-ul">Other</a>
					<ul>
						<li><a href="<?= site_url() . 'employee' ?>">Manage Employees</a></li>
						<li><a href="<?= site_url() . 'employee_function' ?>">Employee Functions</a></li>
						<li><a href="<?= site_url() . 'region' ?>">Manage Regions</a></li>
						<li><a href="<?= site_url() . 'discount_type' ?>">Discount Types</a></li>
						<li><a href="<?= site_url() . 'division' ?>">Divisions</a></li>
						<li><a href="<?= site_url() . 'customer_contact_type' ?>">Customer Contact Types</a></li>
						<?
						if (get_cookie('set_admin_status'))
							$set_admin_status = "Delete Administrator Status";
						else
							$set_admin_status = "Set Administrator Status";
						?>

						<li><a href="<?= site_url() . 'dashboard/set_admin_status' ?>"><?= $set_admin_status ?> </a></li>
					</ul>
				</li>

			</ul>

		</div>
	</div>
