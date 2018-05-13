<?php $this->load->view('modules/head') ?>
<?php $this->load->view('modules/header_left_sidebar') ?>

<?php $this->load->view('xajax/xajax'); ?>

<!--<script src="<?= base_url() . 'js_tt/'; ?>xajax_js/xajax_debug.js"></script>-->


<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/tablesorter-pager.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		/* Table Sorter */
		$("#xsort-table")
			.tablesorter({
				widgets: ['zebra'],
				headers: {
					// assign the secound column (we start counting zero) 
					0: {
						// disable it by setting the property sorter to false 
						sorter: false
					},
					// assign the secound column (we start counting zero) 
					12: {
						// disable it by setting the property sorter to false 
						sorter: false
					}
				}
			})

			.tablesorterPager({container: $("#xpager")});

		$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');


	});

	/* Check all table rows */

	var checkflag = "false";
	function check(field) {
		if (checkflag == "false") {
			for (i = 0; i < field.length; i++) {
				field[i].checked = true;
			}
			checkflag = "true";
			return "check_all";
		}
		else {
			for (i = 0; i < field.length; i++) {
				field[i].checked = false;
			}
			checkflag = "false";
			return "check_none";
		}
	}


</script>
<script>
	//        $( function(){       
	//           $("#send_mails").click( showDialog );
	//            $myWindow = jQuery('#do_mails');
	//                //instantiate the dialog
	//                $myWindow.dialog({
	//						show: 'explode',
	//                        modal: true,
	//						height: 300,
	//                        width: 600,
	////                        position: 'center',
	//                        autoOpen:false
	//                        });
	//                }
	//
	//        );
	//    //function to show dialog   
	//    var showDialog = function() {
	//        //if the contents have been hidden with css, you need this
	//        $myWindow.show(); 
	//        //open the dialog
	//        $myWindow.dialog("open");
	//        }
	//
	//    //function to close dialog, probably called by a button in the dialog
	////    var closeDialog = function() {
	////        $myWindow<?  //echo $i; ?>.dialog("close");
	////    }
</script>

<div id="sub-nav">
	<div class="page-title">
		<h1><?php echo $title ?></h1>
		<span></span></div>
	<?php $this->load->view('modules/top_buttons') ?>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2><?php echo $title_action ?></h2>
				<span>&nbsp;</span>
				<? if (isset($events)) : ?>
					<div class="content-box">
						<? foreach ($events AS $event) : ?>

							<? $class_happened = $event->date >= date('Y-m-d') ?>

							<h3><?= date('l jS F Y', strtotime($event->date)) . ' - ' . $event->activity_name . ' (' . $event->activity_code . ') ' ?> </h3>
							Location: <b> <?= $event->location_name ?></b>
							Code: <b>  <?= $event->code ?></b>
							Time: <b> <?= $event->time ?></b>
							<? $instructors = $this->event_to_employee_model->get_employee_string($event->event_id); ?>
							Instructors: <b> <?= $instructors ?></b>
							Signed Up:  <b id="attending">  <?= $attending ?></b>
							<? if (!$class_happened) : ?>
								Show:  <b id="attended">  <?= $event->attended ?></b>

							<? endif ?>
							<? if ($event->is_deleted) : ?>
								<span style=" color: red; font-size: 120%"> This event is invisible!</span>
							<? endif ?>


						<? endforeach ?>
					</div>
				<? endif ?>
				<p><?= $error_message ?></p>
			</div>
			<div class="hastable">

				<!--			<form name="myform" class="pager-form" method="post" action="">
				-->
				<?
				$attributes = array(
					'id' => 'class_participants',
					'class' => "pager-form",
				);
				echo form_open("customer_contact/class_actions/" . $event->event_id . "/" . $event->location_id . "/" . $event->attending, $attributes)
				?>

				<table id="sort-table">
					<thead>
					<tr>
						<th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)"
						           class="submit"/></th>
						<th>Booked</th>
						<th>Name</th>
						<th>City</th>
						<th>eMail</th>
						<th>Phone</th>
						<!--							<th>Trip Leader</th>
													<th>Group Nr</th>
						-->
						<th>Discount</th>
						<th>Discount Code</th>
						<th>Amount Paid</th>
						<th>Status</th>
						<th>Q-Accept</th>
						<th>Q-Check</th>
						<th style="width:180px">Options</th>
					</tr>
					</thead>
					<tbody>


					<?php $i = 0;
					if (isset($records)) : foreach ($records as $row) : ?>
					<? $email = !$row->email ? 'no_email' : $row->email; ?>
					<?
					$status = "";
					if ($row->ledger_status == LEDGER_DELETED)
						$status = "Removed";
					elseif ($row->ledger_status == LEDGER_NO_SHOW)
						$status = "No Show";
					elseif ($row->ledger_status == LEDGER_SHOW)
						$status = "Show";
					else
						$status = "";
					?>
					<tr>
						<?php
						$checked = FALSE;

						$data = array(
							'name' => 'send_mail' . $i,
							'id' => 'list',
							'value' => $checked,
							'checked' => $checked,
							'class' => 'checkbox',
						);
						?>

						<td class="center"><?php echo form_checkbox($data) ?></td>

						<td><?php echo $row->booking_date ?></td>
						<td><?php echo trim($row->first_name) . ' ' . $row->last_name; ?></td>
						<td><?php echo $row->city ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $row->cell; ?></td>
						<!--							<td><?php if ($row->main_customer) echo 'Yes'; else echo 'No'; ?></td>
							<td><?php echo $row->event_group_id ?></td>
-->
						<td><?php echo $row->discount_name; ?></td>
						<td><?php echo $row->promo_code; ?></td>
						<td><?php echo $row->price - $row->discount; ?></td>
						<td id='status<?= $i ?>'><?php echo $status ?></td>
						<? if ($row->customer_questionaire_id) : ?>
							<td> <? if ($row->is_questionaire) echo "yes"; else echo "no" ?></td>
							<td> <? if ($row->is_questionaire_viewed_by_admin) : ?><span
									style="color:red">&#10004;</span>  <? else  : ?> &nbsp; <? endif ?></td>
						<? else : ?>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						<? endif ?>
						<td>'

							<a class="btn_no_text btn ui-state-default ui-corner-all tooltip " title="View History"
							   href="<?php echo site_url() . 'customer_contact/customer_contact_overview/' ?><?php echo $row->customer_id; ?>//<?php echo str_replace('@', 'at', $email); ?>/<?= strpos($email, '@') == 0 ? 0 : strpos($email, '@') ?>">
								<span class="ui-icon ui-icon-folder-collapsed"></span> </a>

							<a class="btn_no_text btn ui-state-default ui-corner-all tooltip " title="Edit customer"
							   href="<?php echo site_url() . 'customer/customer_view/' ?><?php echo $row->customer_id; ?>">
								<span class="ui-icon ui-icon-bookmark"></span> </a>
							
							<? if ($row->is_questionaire)    : // only if questionaire was generated ?>
								<a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
								   title="View questionaire"
								   href="<?php echo site_url() . 'customer/customer_questionaire_view/' ?><?php echo $row->customer_id; ?>/<?php echo $event_id ?>/<?php echo $location_id ?>/<?php echo $i + 1 ?>">
									<span class="ui-icon ui-icon-script"></span> </a>
							<? endif ?>
							
							<? if (isset($event_id)) : ?>
								<? if ($class_happened) : ?>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip"
									   title="Remove from class"
									   onClick="xajax_delete_from_class(<?php echo $row->ledger_id ?>,<?php echo $i ?>);return false;"
									   href="#"> <span class="ui-icon ui-icon-trash"></span> </a>

								<? else : ?>
									<a class="btn_no_text btn ui-state-default ui-corner-all tooltip "
									   title="Set Show / No Show <br> (after class is done)"

									   onClick="xajax_show_noshow(<?php echo $row->ledger_id ?>,<?php echo $i ?>);return false;"

									   href="#"> <span class="ui-icon ui-icon-suitcase"></span> </a>

								<? endif ?>
							<? endif ?>


							<a class="btn_no_text btn ui-state-default ui-corner-all tooltip " title="Re-schedule"
							   href="<?php echo site_url() . 'ledger/reschedule/' . $row->ledger_id . '/' . $row->activity_id . '/' . $row->event_id . '/' . $row->location_id ?>">
								<span class="ui-icon ui-icon-calendar"></span> </a>


						</td>
						<input value="<?php echo $row->customer_id; ?>" name="customer_id<?php echo $i ?>"
						       id="customer_id<?php echo $i ?>" type="hidden"/>
						<input type="hidden" value="<?php echo $row->ledger_id; ?>" name="ledger_id<?php echo $i ?>"
						       id="ledger_id<?php echo $i ?>"/>
						<? $i++ ?>

						<?php endforeach;
						endif; ?>
					</tbody>
					<tr>
						<input type="submit" id="send_mails" name="send_mails" value="Send Mails"
						       class="ui-state-default float-right ui-corner-all ui-button"/>
					</tr>

					</tr>
				</table>
				</form>
				<div id="pager">
					<?php // $this->load->view('modules/pager') ?>
				</div>
				</form>
			</div>


			<div style=" padding: 0.4em; padding-left: 1.5em;  padding-right: 1.5em; display: none; " id="do_mails"
			     title="You chose    (Just press ESC to correct)">

				<ul>
					<li>
						<a href="<?= site_url() . "customer_contact/class_participants/" . $event->event_id . "/" . $event->attending ?>">choose</a>
					</li>
				</ul>
				<input type="submit" id="update" name="update" value="CONTINUE" class="submit"/>
			</div>


			<div class="clear"></div>
			<?php $this->load->view('modules/sidebar') ?>
		</div>
	</div>
	<?php $this->load->view('modules/footer') ?>
</div>
</body>
</html>
