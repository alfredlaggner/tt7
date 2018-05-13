<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tt_v3 extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->library('javascript');
		$this->cache_minutes = 0;
		$this->_ajax();
		$this->debug = false;
	}

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		// Xajax Form Validator library
		$this->load->library('xajax/xajax_validator');

		$this->xajax->configure("requestURI", base_url() . 'index.php/tt_v3/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('form_contact', &$this, 'form_contact'));
		$this->xajax->register(XAJAX_FUNCTION, array('verify_promo_code', &$this, 'verify_promo_code'));
		$this->xajax->register(XAJAX_FUNCTION, array('getProducts', &$this, 'getProducts'));
		$this->xajax->register(XAJAX_FUNCTION, array('getGears', &$this, 'getGears'));
		$this->xajax->processRequest();
	}

	function test()
	{
		$this->load->view('tt_v3/test');

	}

	function region_update()
	{
		$region_id = $this->input->post('region_id');

		if ($this->input->post('return') == "Go!") {
			$this->session->set_userdata('region_id', $region_id);

			if (!isset($_COOKIE['region_set'])) {
				$cookie = array(
					'name' => 'region_set',
					'value' => 'yes',
					'expire' => 60 * 60 * 24 * 365
				);
				set_cookie($cookie);
			}
			$this->index();
		} else {
			$this->index();
		};
	}

	function index($style = 0)
	{

		$data = array();
		$data['head'] = $this->_head("Home - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, true);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$region_id = $this->session->userdata('region_id');
		$data['region_id'] = $region_id;
		$data['region_name'] = $this->tt_model_v2->get_region_name($region_id);;
		$data['records'] = $this->tt_model_v2->get_all_classes(0, TRUE);
		$data['home_sliders'] = $this->home_slider_model->get_records(TRUE);

		$data['all_classes'] = $this->tt_model_v2->get_all_classes($style, FALSE);
		$data['styles'] = $this->style_model->get_records();
		$data['activity_groups'] = $this->style_model->get_front_page_styles();
//print_r2($data['styles']);
		$data['all_gears'] = $this->gear_model->get_records();
		$data['gear_groups'] = $this->gear_group_model->get_records();

//	$data['region'] = $this->tt_model_v2->get_region_name($region_id);
		$data['regions'] = $this->tt_model_v2->get_Regions();

		if (!$this->input->cookie('region_set')) {
			$data['region_set'] = " onLoad=\"actuateLink(document.getElementById('top-bar-checkout'))\"> ";
		} else {
			$data['region_set'] = "";
		}

		$this->load->view('tt_v3/main3', $data);

	}

	function _head($title = "", $data = array())
	{
		$data['title'] = $title;
		return ($this->load->view('tt_v3/blocks/head3', $data, TRUE));
	}

	function region_selected()
	{
		$region_id = $this->input->post('region');
		$newdata = array('region_id' => $this->input->post('region'));
		$this->session->set_userdata($newdata);
		$this->index();
	}

	function region()
	{
		$data['records'] = $this->tt_model_v2->get_Regions();
		$this->view_regions($data);
	}

	function classes()
	{
		$this->tt_model_v2->get_all_classes(0, 0); // to initialize the variables
		$config = $this->init_pagination();
		$this->pagination->initialize($config);
		$data['row_numbers'] = $config['total_rows'];
		$data['records'] = $this->tt_model_v2->get_all_classes($config['per_page'], 0);
		$data['region'] = $this->tt_model_v2->get_region_name($this->session->userdata('region_id'));
		$this->view_classes($data);
	}

	function view_classes($data)
	{
		$this->_head("Classes - Treks and Tracks");
		$this->load->view('tt_v2/collection', $data);
	}

	/**
	 * @param $activity_id
	 * @param int $err_num
	 */
	function activity_detail($activity_id, $err_num = 0)
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['equipments'] = $this->equipment_model->get_equipment($activity_id);
		$data['events'] = $this->activity_booking_model->get_booking
		(0, $activity_id);
		$data['locations'] = $this->event_model->get_by_location($activity_id);
//		echo $activity_id;print_r2($data['locations']); die();
		$data['service_levels_list'] = $this->service_level_model->get_records_list();
		$data['styles_list'] = $this->style_model->get_records_list();
		$data['physical_levels_list'] = $this->physical_level_model->get_records_list();
		//print_r2(  $data['physical_levels_list']);
		$data['activities_related'] = $this->tt_model_v2->get_related_activities($activity_id);
//print_r($data['activities_related']); die();
		$data['records'] = $this->tt_model_v2->get_class($activity_id);

		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);

		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);

		$head_data['meta_title'] = $this->activity_model->get_activity_name($activity_id);
		$head_data['meta_description'] = $this->activity_model->get_activity_description_short($activity_id);

		$this->load->view('tt_v3/activity_detail', $data);
	}

	function product_booking1($activity_id, $err_num = 0)
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['events'] = $this->activity_booking_model->get_booking(0, $activity_id);
//print_r2( $data['events']);die();
		if ($data['events']) $data['event_title'] = $data['events'][0]['activity_name'];
		$data['locations'] = $this->event_model->get_by_location_v1($activity_id);
//print_r2($data['locations']);
//die();
		//       $data['records'] = $this->tt_model_v2->get_class($activity_id);
//print_r2($data['records']);
//debug_print( $data['records']);
		$data['event_data'] = $this->tt_model_v2->format_booking1($data['locations'], $data['events']);
//print_r2($data['event_data']); die();

		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region_name'] = ""; //$this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);

		$year = date('Y');
		$month = date('m');


		$data['calendar'] = $this->calendar_model_front->generate($year, $month);
		$this->load->view('tt_v3/booking1', $data);
//		$this->load->view('tt_v3/activity_detail_old');
	}

	function class_booking($event_id, $err_num = 0)
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);

		$data['nr_of_students'] = $this->input->post('participants');
//echo 'nr_of studends=' . $this->input->post('participants');
		$data['promo_code'] = strtoupper($this->input->post('promo_code'));
		$data['event_id'] = $event_id;
//echo 'event_id=' . $event_id;
		$data['location_id'] = $this->input->post('location_id');
		$data['events'] = $this->activity_booking_model->get_booking($event_id, 0, 0);
//	print_r($data['events']);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		//   $data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);

//	echo "update1=".$this->input->post('update1');

		if ($this->input->post('update') != "CONTINUE EXP")
			$data['events'][0]['exp_discount_price'] = 0;

//die();
		$data['error'] = $err_num;
		$head_data['meta_title'] = "Enter Student Information";
//		$this->load->view('tt_v2/blocks/head',$head_data);
		$this->load->view('tt_v3/booking2', $data);

	}

	function relay_response()
	{
		// Flag if this is an ARB transaction. Set to false by default.
		$redirect_url = site_url() . "tt_v3/class_detail/9"; // Where the user will end up.
		$arb = false;
		$valid = false;
		$hash_value = ''; // This needs to be configured in the Merchant Interface

		// Store the posted values in an associative array
		$fields = array();

		foreach ($_POST as $name => $value) {
			// Create our associative array
			$fields[$name] = $value;

			// If we see a special field flag this as an ARB transaction
//		if ($name == 'x_subscription_id')
//			{
//			$arb = true;
//			}
//		}

			// Check Validation
			//$hash = md5($hash_value.$fields['x_trans_id'].$fields['x_amount']);
			//if($hash == $fields['x_MD5_Hash'])
			//{
			//$valid = true;
			//}

			// If it is an ARB transaction, do something with it
//		$arb = true;
//		if ($arb == true && $valid)
//		{
//			if($fields['x_response_code'] == 1)
//				{
//					echo "success";
//				
//				}
//				else
//				{
//					// Denied
//					echo "failure";
//				
//				}
//		}
		}

//print_r($fields); die();

		$data = array(
			'ledger_id' => $this->input->post('x_ledger_id'),
			'customer_id' => $this->input->post('x_cust_id'),
			'response_code' => $this->input->post('x_response_code'),
			'response_reason_code' => $this->input->post('x_response_reason_code'),
			'avs_code' => $this->input->post('x_avs_code'),
			'auth_code' => $this->input->post('x_auth_code'),
			'trans_id' => $this->input->post('x_trans_id'),
			'method' => $this->input->post('x_method'),
			'card_type' => $this->input->post('x_card_type'),
			'invoice_num' => $this->input->post('x_invoice_num'),
			'MD5_Hash' => $this->input->post('x_MD5_Hash'),
			'cvv2_resp_code' => $this->input->post('x_cvv2_resp_code'),
			'cavv_response' => $this->input->post('x_cavv_response'),
			'amount' => $this->input->post('x_amount'),
			'account_number' => $this->input->post('x_account_number'),
			'event_id' => $this->input->post('x_event_id'),
			'activity_id' => $this->input->post('x_activity_id'),
			'location_id' => $this->input->post('x_location_id')
		);

		$payment_id = $this->ledger_model->add_payment($data);
		$event_group_id = $this->input->post('x_ledger_id');  // I use event_goup_id as invoive number
		$ledger_id = $this->input->post('x_ledger_id');
		$event_id = $this->input->post('x_event_id');
		$activity_id = $this->input->post('x_activity_id');
		$location_id = $this->input->post('x_location_id');
		$response_reason_code = $this->input->post('x_response_reason_code');

		if ($fields['x_response_code'] == 1) {
			$this->ledger_model->book_ledger($payment_id, $event_group_id, $event_id, $location_id); // mark as payed
			$redirect_url = site_url() . "tt_v3/cc_success/" . $event_group_id; // Where the user will end up.
		} else {
		//	if (!$event_group_id) $event_group_id = 0;  //placeholder
			$redirect_url = site_url() . "tt_v3/show_summary/" . $event_group_id . "/"  . $response_reason_code; //
		}
		echo $this->getRelayResponseSnippet($redirect_url);

	}


	function getRelayResponseSnippet($redirect_url)
	{
		return "<html><head><script language=\"javascript\">
                <!--
                window.location=\"{$redirect_url}\";
                //-->
                </script>
                </head><body><noscript><meta http-equiv=\"refresh\" content=\"1;url={$redirect_url}\"></noscript></body></html>";
	}

	function create_booking_with_discount($ledger_id, $event_group_id)
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);

		// $data['region_id'] = $this->session->userdata('region_id');
		// $data['region'] = $this->tt_model_v3->get_region_name($data['region_id']);
		// $data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$this->send_emails($event_group_id);
		$activity_id = $this->ledger_model->book_ledger_full_discount($ledger_id, $event_group_id);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE);
		//       echo $activity_id; die();
		$data['attachments'] = $this->attachment_model->get_activity_attachments($activity_id);
//print_r2($data['attachments']); die();
		$head_data['meta_title'] = "Discount Success";
		//   $this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v3/discount_success', $data);
	}

//		echo $this->email->print_debugger(); die();

	function send_emails($event_group_id)
	{


//        $config['protocol'] = 'sendmail';
//        $config['mailtype'] = 'html';
//        $config['charset'] = 'iso-8859-1';

//		echo "ledger activity id: " . $event_group_id;

		$query = $this->ledger_model->get_summary($event_group_id, TRUE);
//		print_r2($query);
//		echo "ledger activity id: ";
		foreach ($query as $q) {
		} //echo $q->activity_id;

		$templates = $this->template_model->get_confirmation_email($q->activity_id);
//		echo '<br>template activity id: ';
//		print_r2($templates);
//		foreach ($templates as $q) echo $q->activity_id;
//
//		print_r2($templates);
//
//		die();

		$error_confirmation_email_not_found = "confirmation email sent";
//		if ($this->config->item('is_confirmation_email')) {
			if ($templates) {
				foreach ($templates as $template) {
					$subject = $template->subject;
					$body = $template->body;
					$id = $template->template_id;
				}
				foreach ($query as $row) {
					//die('got here' . $row->confirm_email_sent . '-' . $row->ledger_id);
					if (!$row->confirm_email_sent) {
						//echo 'got here' . $row->confirm_email_sent . '-' . $row->ledger_id;

						//				echo 'email sent to: ' . $row->email . '<br>';
						$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
						$this->email->to($row->email);
						$this->email->cc('info@treksandtracks.com');
//						$this->email->bcc('alfred@reefsidehealth.com');

						$this->email->message($this->template_model->substitute_text($body, $row->customer_customer_id, $row->event_id));
						$this->email->subject($this->template_model->substitute_text($subject, $row->customer_customer_id, $row->event_id));

						$this->template_to_attachment_model->put_attachments($id);


						if ($this->email->send()) {
							//$this->email->print_debugger(array('headers'));
							echo 'Confirmation e-mail has been sent! <br>';
							$data = array('is_confirm_email_sent' => 1);
							$this->db->where('ledger_id', $row->ledger_id);    //
							$this->db->update('ledger', $data);
						}
					} else {
						//	echo 'got here too' . $row->confirm_email_sent . '-' . $row->ledger_id;

//					$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
//					$this->email->to('alfred.laggner@gmail.com');
//
//					$this->email->subject($error_confirmation_email_not_found);
//					$this->email->message($error_confirmation_email_not_found);
//
//					$this->email->send();
					}

				}
			} else   // no template found
			{
				echo 'No confirmation email for this activity';
				//		log_message('email', 'No confirmation email for this activity');

			}
//		} else {
//			echo 'Confirmation email will be sent shortly.';
//		}
	}

	function cc_success($event_group_id)
// for credit card read payment summary
// for discount read ledger summary	(no payment record
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);

//		$data['payment_id'] = $payment_id;
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);

		$this->send_emails($event_group_id);

		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // mark as payed
		$activity_id = $this->ledger_model->get_activity_id($event_group_id);
		// echo $activity_id; die();

		$data['attachments'] = $this->attachment_model->get_activity_attachments($activity_id);
//print_r2($data['attachments']);
		$head_data['meta_title'] = "Payment Success";
		//   $this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v3/cc_success', $data);

	}

	function xsend_emails($event_group_id)
	{
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';

		/*    $config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'alfred.laggner@gmail.com',
				'smtp_pass' => 'Ilm2dogs12$$$',
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
			);*/
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");


		$query = $this->ledger_model->get_summary($event_group_id, TRUE);
//print_r($query); die();

		foreach ($query as $row) {
			if ($row->confirm_email_sent == 0) {
				$this->email->initialize($config);
				$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
				$this->email->to($row->email);
//				$this->email->to('alfred.laggner@gmail.com'); 
				$this->email->cc('info@treksandtracks.com');
				$this->email->bcc('alfred.laggner@gmail.com');

				$this->email->subject('Treks and Tracks booking confirmation');
				$this->email->message($this->ledger_model->get_email_message_text($event_group_id));

				if ($this->email->send()) {
					$data = array('is_confirm_email_sent' => 1);
					$this->db->where('ledger_id', $row->ledger_id);    //
					$this->db->update('ledger', $data);
				}
//				echo $this->email->print_debugger();
			} else {
				$this->email->initialize($config);
				$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
				$this->email->to('alfred.laggner@gmail.com');

				$this->email->subject('Attempted sent again');
				$this->email->message($event_group_id);

				$this->email->send();
			}
		}

	}

	function create_booking()
	{

		$nr_of_students = $this->input->post('nr_of_students');

		$event_group_id = 0;
		$ledger_id = 0;

		if ($this->debug) echo $nr_of_students;

		$nr_of_students = isset($nr_of_students) ? $nr_of_students : 1;
		for ($i = 1; $i <= $nr_of_students; $i++) {
			$data = array(
				'first_name' => $this->input->post('first_name' . $i),
				'last_name' => $this->input->post('last_name' . $i),
				'date_of_birth' => $this->input->post('date_of_birth' . $i),
				'email' => $this->input->post('email' . $i),
				'cell' => $this->input->post('cell' . $i),
				'emergency_contact' => $this->input->post('emergency_contact' . $i),
				'emergency_phone' => $this->input->post('emergency_phone' . $i),
				'created_on' => $this->input->post('booking_date' . $i),
				'sex' => strtoupper($this->input->post('sex') . $i),
				'address1' => $this->input->post('address1' . $i),
				'address2' => $this->input->post('address2' . $i),
				'city' => $this->input->post('city' . $i),
				'zip' => $this->input->post('zip' . $i),
				'state' => $this->input->post('state' . $i),
				'country' => $this->input->post('country' . $i),
				'date_of_birth' => date("Y/m/d"),
				'created_on' => time(),
			);
			$customer_id = $this->customer_model->add_record($data);

			if ($this->input->post('$is_questionaire')) $this->update_questionaire($customer_id, 'insert', $i);
//echo "discount price:" . $this->input->post('exp_discount_price');			
			if ($i == 1) {
				$event_group_id = 0;
				if ($this->input->post('exp_discount_price'))
					$price = $this->input->post('exp_discount_price');
				else
					$price = $this->input->post('price');
			}                        // initialize it the first time
			else
				$price = $this->input->post('price');


			$data = array(
				'activity_id' => $this->input->post('activity_id'),
				'event_id' => $this->input->post('event_id'),
				'price' => $price,
				'exp_discount_price' => $this->input->post('exp_discount_price'),
				'discount' => $this->input->post('discount'),
				'tax' => $this->input->post('tax'),
				'attending' => $this->input->post('nr_of_students'),
				'promo_code' => $this->input->post('promo_code'),
				'booking_date' => $this->input->post('booking_date'),
				'event_group_id' => $event_group_id,
				'location_id' => $this->input->post('location_id'),
			);


			$this->ledger_model->add_record($data);
			$ledger_id = $this->db->insert_id();

//store in an event group				
			if ($i == 1) {
				$main_customer = '1';
				$event_group_id = $ledger_id;                        // create a group to hold them together
				$data = array('event_group_id' => $event_group_id); //and store it
				$this->ledger_model->update_record($ledger_id, $data);
			} else {
				$main_customer = '0';
			}

// discount calculation with promo_code
			$promo_code = $this->input->post('promo_code');

			//echo  $promo_code;


			if ($promo_code) {
				$activity_id = $this->input->post('activity_id');
				$event_date = $this->input->post('date');
				$rate_price = $this->input->post('price');
				$exp_discount_price = $this->input->post('exp_discount_price');
				$discount = $this->input->post('discount');
				$get_discount = array( // setup array to calculate with
					'rate_price' => $rate_price,
					'discount' => $discount);
// if 	exp_discount_price
//print_r2($get_discount);
				$discount_return = $this->activity_booking_model->get_promo_discount($get_discount, $activity_id, $event_date, $promo_code);

				//              print_r2($discount_return);

				$data = array('promo_code' => $promo_code,
					'discount' => $discount_return['discount'],
					'discount_amount_type' => $discount_return['discount_amount_type'],
				); //and store it
//print_r($data);
				$this->ledger_model->update_record($ledger_id, $data);
				$promo_amount_type = $this->discount_model->get_promo_amount_type($promo_code);
//				if ($promo_amount_type == DISCOUNT_FIXED_AMOUNT )
//					$this->ledger_model->calc_fixed_discount($event_group_id);
			}
			$this->ledger_model->add_attendant_record($ledger_id, $customer_id, $main_customer);
		}

		$this->show_summary($event_group_id);
	}

	public function update_questionaire($customer_id, $mode = 'update', $i = '')
	{
		$data = array(
			'customer_id' => $customer_id,
			'is_questionaire' => isset($_POST['is_questionaire' . $i]) ? 1 : 0,
			'current_fitness' => $this->input->post('current_fitness' . $i),
			'experience' => $this->input->post('experience' . $i),
			'is_fear_of_heights' => isset($_POST['is_fear_of_heights' . $i]) ? 1 : 0,
			'have_backpack' => isset($_POST['have_backpack' . $i]) ? 1 : 0,
			'have_tent' => isset($_POST['have_tent' . $i]) ? 1 : 0,
			'have_sleeping_bag' => isset($_POST['have_sleeping_bag' . $i]) ? 1 : 0,
			'have_sleeping_pad' => isset($_POST['have_sleeping_pad' . $i]) ? 1 : 0,
			'dietary_restrictions' => $this->input->post('dietary_restrictions' . $i),
			'breakfast_other' => isset($_POST['breakfast_other' . $i]) ? 1 : 0,
			'breakfast_other_text' => $this->input->post('breakfast_other_text' . $i),
			'breakfast_coffee' => isset($_POST['breakfast_coffee' . $i]) ? 1 : 0,
			'breakfast_black_tea' => isset($_POST['breakfast_black_tea' . $i]) ? 1 : 0,
			'breakfast_green_tea' => isset($_POST['breakfast_green_tea' . $i]) ? 1 : 0,
			'breakfast_herb_tea' => isset($_POST['breakfast_herb_tea' . $i]) ? 1 : 0,
			'breakfast_hot_chocolate' => isset($_POST['breakfast_hot_chocolate' . $i]) ? 1 : 0,
			'is_allow_photo_graphs' => isset($_POST['is_allow_photo_graphs' . $i]) ? 1 : 0,

			'date_signed' => $this->input->post('date_signed'),
			'signature' => $this->input->post('signature'),

			'sex' => $this->input->post('sex' . $i),
			'dob' => $this->input->post('dob' . $i),
			'weight' => $this->input->post('weight' . $i),
			'height' => $this->input->post('height' . $i),
			'is_asthma' => isset($_POST['is_asthma' . $i]) ? 1 : 0,
			'is_bleeding' => isset($_POST['is_bleeding' . $i]) ? 1 : 0,
			'is_inhaler' => isset($_POST['is_inhaler' . $i]) ? 1 : 0,
			'is_asthma' => isset($_POST['is_asthma' . $i]) ? 1 : 0,
			'is_diabetes' => isset($_POST['is_diabetes' . $i]) ? 1 : 0,
			'is_seizures' => isset($_POST['is_seizures' . $i]) ? 1 : 0,
			'is_cardio_disease' => isset($_POST['is_cardio_disease' . $i]) ? 1 : 0,
			'is_hypertension' => isset($_POST['is_hypertension' . $i]) ? 1 : 0,
			'is_knee_ankle_shoulder' => isset($_POST['is_knee_ankle_shoulder' . $i]) ? 1 : 0,
			'is_dizziness' => isset($_POST['is_dizziness' . $i]) ? 1 : 0,
			'is_see_medical_specialist' => isset($_POST['is_see_medical_specialist' . $i]) ? 1 : 0,
			'is_any_other_condition' => isset($_POST['is_any_other_condition' . $i]) ? 1 : 0,
			'is_pregnant' => isset($_POST['is_pregnant' . $i]) ? 1 : 0,
			'is_allergic_medications' => isset($_POST['is_allergic_medications' . $i]) ? 1 : 0,
			'is_allergic_insect_stings' => isset($_POST['is_allergic_insect_stings' . $i]) ? 1 : 0,
			'is_allergic_food' => isset($_POST['is_allergic_food' . $i]) ? 1 : 0,
			'is_allergic_other' => isset($_POST['is_allergic_other' . $i]) ? 1 : 0,
			'is_medications' => isset($_POST['is_medications' . $i]) ? 1 : 0,
			'is_questionaire_viewed_by_admin' => isset($_POST['is_questionaire_viewed_by_admin' . $i]) ? 1 : 0,

			'allergy_explainations' => $this->input->post('allergy_explainations' . $i),
			'medication_explainations' => $this->input->post('medication_explainations' . $i),
			'response_explainations' => $this->input->post('response_explainations' . $i),
		);

		if ($mode == 'update') {

			$this->customer_model->update_health_record($this->input->post('customer_questionaire_id'), $data);
			if ($this->input->post('return') == "Return")
				redirect('customer_contact/customers_by_event/' . $this->input->post('event_id') . '/' . $this->input->post('location_id') . '/' . $this->input->post('counter'), 'refresh');
		} else {
			$this->customer_model->add_health_record($data);
			return;
		}
	}

	function show_summary($event_group_id, $err_num = 0)
	{
		$data['head'] = $this->_head("Activity - Treks and Tracks");
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // fetches only the data of main customer

		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);
		$head_data['meta_title'] = "Booking Summary";
//        $this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v3/summary', $data);

	}

	function gear($gear_id, $err_num = 0)
	{
		$data['error'] = $err_num;
		$data['error_text'] = "";
		$data['gears_related'] = $this->gear_related_model->get_related_gears($gear_id);
		$data['records'] = $this->gear_model->get_record($gear_id);

		$data['pictures'] = $this->gear_pictures_model->get_records($gear_id);
		$head_data['meta_title'] = $this->gear_model->get_gear_name($gear_id);
		$head_data['meta_description'] = $this->gear_model->get_gear_description_short($gear_id);

		$this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v2/gear', $data);
	}

	function getProducts($style = 0)
	{
		$data['all_classes'] = $this->tt_model_v2->get_all_classes($style, FALSE);


		$objResponse = new xajaxResponse();
		$objResponse->Assign("product_display", "innerHTML", $this->load->view("xajax/product_result2", $data, TRUE));
		return $objResponse;
	}

	function getGears($gear_group_id = 0)
	{

		$data['all_gears'] = $this->gear_model->get_records($gear_group_id);


		$objResponse = new xajaxResponse();
		$objResponse->Assign("gear_display", "innerHTML", $this->load->view("xajax/gear_result", $data, TRUE));
		return $objResponse;
	}

	function testp()
	{
		$promo_code = "100";

		$row = $this->discount_model->get_promo_code($promo_code, 25);
//print_r($row);

	}

	function verify_promo_code($form_data, $count, $event_id, $exp_discount_price)
	{
		$promo_code = strtoupper(trim($form_data['promo_code']));
		$disp_promo_code = "<span style='color: red'>" . $promo_code . "</span>";

		$objResponse = new xajaxResponse();
		$answer = "";
		if (!$promo_code) {
			$objResponse->assign("update" . $count, "disabled", false);
			$answer = "If you do NOT enter a discount code";
			$answer .= "<br> we will ask you to pay with credit card.";
			$objResponse->Assign("warning_message" . $count, "innerHTML", $answer);
			//   $objResponse->assign("update" . $count, "value", "CONTINUE WITHOUT DISCOUNT CODE");
			$objResponse->assign("update" . $count, "value", "CONTINUE WITHOUT CODE");
			return $objResponse;
		}

//		  $objResponse->assign("update".$count,"disabled",false);

		$discount_status = $this->discount_model->get_promo_code($promo_code, $event_id);

		if ($discount_status == "OK") {

			$answer = "Yay! Correct Code :-)";
			$objResponse->assign("update" . $count, "disabled", false);
			$objResponse->assign("update" . $count, "value", "CONTINUE");

		} elseif ($discount_status == "EXPI") {
			if (!$exp_discount_price) {
				$answer = "Ooops " . $disp_promo_code . " Expired :-(";
				$objResponse->assign("update" . $count, "disabled", true);
				$objResponse->assign("update" . $count, "value", "FIX DISCOUNT CODE");
			} else {
				$answer = "Yay!  " . $disp_promo_code . " Expired but you have another chance ;-)";
				$objResponse->assign("update" . $count, "disabled", false);
				$objResponse->assign("update" . $count, "value", "CONTINUE EXP");
				//$objResponse->assign("update1","value","CONTINUE EXP");
			}
		} elseif ($discount_status == "USED") {
			$answer = "Ooops " . $disp_promo_code . " Already  Used :-(";
			$objResponse->assign("update" . $count, "disabled", true);
			$objResponse->assign("update" . $count, "value", "FIX DISCOUNT CODE");
		} else {
			$answer = "Ooops " . $disp_promo_code . " Not found :-(";
			$objResponse->assign("update" . $count, "disabled", true);
			$objResponse->assign("update" . $count, "value", "FIX DISCOUNT CODE");
		}
		$objResponse->Assign("warning_message" . $count, "innerHTML", $answer);
		return $objResponse;
	}

	function form_contact($form_data)
	{
		$error_details = NULL;

		$region_id = trim($form_data['region']);

		$newdata = array('region_id' => $region_id);
		$this->session->set_userdata($newdata);
		$region = $this->tt_model_v2->get_region_name($region_id);

		$objResponse = new xajaxResponse();
		$objResponse->Assign("disp_region", "innerHTML", $region);
		return $objResponse;

	}


}
/* End of file tt.php */
/* Location: ./application/controllers/tt.php */