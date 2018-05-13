<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tt_v2 extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->library('javascript');
		$this->cache_minutes = 0;
		$this->_ajax();
	}

	function index($style = 0)
	{

		$data = array();
		$data['head'] = $this->_head("Home - Treks and Tracks");
		$data['footer'] = $this->load->view('tt_v2/blocks/footer-2', $data, TRUE);
		$region_id = $this->session->userdata('region_id');
		$data['region_id'] = $region_id;
		$data['region_name'] = $this->tt_model_v2->get_region_name($region_id);;
		$data['header'] = $this->load->view('tt_v2/blocks/header-2', $data, true);
		$data['records'] = $this->tt_model_v2->get_all_classes(0, TRUE);
		$data['home_sliders'] = $this->home_slider_model->get_records(TRUE);

		$data['all_classes'] = $this->tt_model_v2->get_all_classes($style, FALSE);
		$data['styles'] = $this->style_model->get_records();

		$data['all_gears'] = $this->gear_model->get_records();
		$data['gear_groups'] = $this->gear_group_model->get_records();

//	$data['region'] = $this->tt_model_v2->get_region_name($region_id); 
		$data['regions'] = $this->tt_model_v2->get_Regions();

		if (!$this->input->cookie('region_set')) {
			$data['region_set'] = " onLoad=\"actuateLink(document.getElementById('top-bar-checkout'))\"> ";
		} else {
			$data['region_set'] = "";
		}

		$this->load->view('tt_v2/index-21', $data);

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

	function _head($title = "", $data = array())
	{
		$data['title'] = $title;
		return ($this->load->view('tt_v2/blocks/head-2', $data, TRUE));
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

	function product($activity_id, $err_num = 0)
	{
		$data['head'] = $this->_head("Home - Treks and Tracks");
		$data['footer'] = $this->load->view('tt_v2/blocks/footer-2', $data, TRUE);
		$data['equipments'] = $this->equipment_model->get_equipment($activity_id);
		$data['events'] = $this->activity_booking_model->get_booking
		(0, $activity_id);
		$data['locations'] = $this->event_model->get_by_location($activity_id);
		$data['activities_related'] = $this->tt_model_v2->get_related_activities($activity_id);
//print_r($data['activities_related']); die();		
		$data['records'] = $this->tt_model_v2->get_class($activity_id);

		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);

		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$data['header'] = $this->load->view('tt_v2/blocks/header-2', $data, TRUE);

		$head_data['meta_title'] = $this->activity_model->get_activity_name($activity_id);
		$head_data['meta_description'] = $this->activity_model->get_activity_description_short($activity_id);

//		$this->load->view('tt_v2/blocks/head',$head_data); 
		$this->load->view('tt_v2/product-detail-2', $data);
	}


	function product_booking1($activity_id, $err_num = 0)
	{
//	$data['head'] = $this->_head("Home - Treks and Tracks");
		$data = array();
		$data['footer'] = $this->load->view('tt_v2/blocks/footer-2', $data, TRUE);
		$data['events'] = $this->activity_booking_model->get_booking(0, $activity_id);
//debug_print( $data['events']); 
//print_r2( $data['events']);
		$data['locations'] = $this->event_model->get_by_location_v1($activity_id);
//print_r2($data['locations']); 
//debug_print( $data['locations']);   
//die();
		$data['records'] = $this->tt_model_v2->get_class($activity_id);
//print_r($data['records']); 
//debug_print( $data['records']);die();   
		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$data['header'] = $this->load->view('tt_v2/blocks/header-2', $data, TRUE);
		$head_data['meta_title'] = "Booking - Treks and Tracks";
//		$this->load->view('tt_v2/blocks/head',$head_data); 

		$year = date('Y');
		$month = date('m');


		$data['calendar'] = $this->calendar_model_front->generate($year, $month);

		$this->load->view('tt_v2/booking-test-4', $data);
	}

	function class_booking($event_id, $err_num = 0)
	{
		$data['nr_of_students'] = $this->input->post('participants');
//echo 'nr_of studends=' . $this->input->post('participants');			
		$data['promo_code'] = $this->input->post('promo_code');
		$data['event_id'] = $event_id;
//echo 'event_id=' . $event_id;			
		$data['location_id'] = $this->input->post('location_id');
		$data['events'] = $this->activity_booking_model->get_booking($event_id, 0, 0);
//	print_r($data['events']);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$data['header'] = $this->load->view('tt_v2/blocks/header-2', $data, TRUE);

//	echo "update1=".$this->input->post('update1');

		if ($this->input->post('update') != "CONTINUE EXP")
			$data['events'][0]['exp_discount_price'] = 0;

//die();
		$data['error'] = $err_num;
		$head_data['meta_title'] = "Enter Student Information";
//		$this->load->view('tt_v2/blocks/head',$head_data); 
		$this->load->view('tt_v2/booking22', $data);

	}


	function show_summary($event_group_id, $ledger_id, $err_num = 0)
	{
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // fetches only the data of main customer

		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);
		$head_data['meta_title'] = "Booking Summary";
		$this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v2/summary', $data);

	}


	function relay_response()
	{
		// Flag if this is an ARB transaction. Set to false by default.
		$redirect_url = site_url() . "tt_v2/class_detail/9"; // Where the user will end up.
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
		$event_group_id = $this->input->post('x_invoice_num');  // I use event_goup_id as invoive number
		$ledger_id = $this->input->post('x_ledger_id');
		$event_id = $this->input->post('x_event_id');
		$activity_id = $this->input->post('x_activity_id');
		$location_id = $this->input->post('x_location_id');
		$response_reason_code = $this->input->post('x_response_reason_code');

		if ($fields['x_response_code'] == 1) {
			$this->ledger_model->book_ledger($payment_id, $event_group_id, $event_id, $location_id); // mark as payed
			$redirect_url = site_url() . "tt_v2/cc_success/" . $event_group_id; // Where the user will end up.
		} else {
			if (!$event_group_id) $event_group_id = 0;  //placeholder
//				if (! $this->input->post('x_first_name') && ! $this->input->post('x_last_name'))
//					$redirect_url = site_url()."tt_v2/product/". $activity_id  . "/" .$response_reason_code; // 
//				else
			$redirect_url = site_url() . "tt_v2/show_summary/" . $event_group_id . "/" . $ledger_id . "/" . $response_reason_code; //
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
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$this->send_emails($event_group_id);
		$this->ledger_model->book_ledger_full_discount($ledger_id, $event_group_id);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE);
//print_r($data['records']); die();
		$head_data['meta_title'] = "Discount Success";
		$this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v2/discount_success', $data);
	}

//		echo $this->email->print_debugger(); die();


	function cc_success($event_group_id)
// for credit card read payment summary	
// for discount read ledger summary	(no payment record
	{
//		$data['payment_id'] = $payment_id;
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v2->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v2/blocks/top_bar', $data, true);
		$this->send_emails($event_group_id);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // mark as payed
//print_r($data['records']); die();
		$head_data['meta_title'] = "Payment Success";
		$this->load->view('tt_v2/blocks/head', $head_data);
		$this->load->view('tt_v2/cc_success', $data);

	}


	function send_emails($event_group_id)
	{
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';

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
			);
			$customer_id = $this->customer_model->add_record($data);
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

				$discount_return = $this->activity_booking_model->get_promo_discount($get_discount, $activity_id, $event_date, $promo_code);


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

		$this->show_summary($event_group_id, $ledger_id);
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

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		// Xajax Form Validator library
		$this->load->library('xajax/xajax_validator');

		$this->xajax->configure("requestURI", base_url() . 'index.php/tt_v2/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('form_contact', &$this, 'form_contact'));
		$this->xajax->register(XAJAX_FUNCTION, array('verify_promo_code', &$this, 'verify_promo_code'));
		$this->xajax->register(XAJAX_FUNCTION, array('getProducts', &$this, 'getProducts'));
		$this->xajax->register(XAJAX_FUNCTION, array('getGears', &$this, 'getGears'));
		$this->xajax->processRequest();
	}

	function getProducts($style = 0)
	{
		$data['all_classes'] = $this->tt_model_v2->get_all_classes($style, FALSE);


		$objResponse = new xajaxResponse();
		$objResponse->Assign("product_display", "innerHTML", $this->load->view("xajax/product_result-2", $data, TRUE));
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
		$promo_code = trim($form_data['promo_code']);
		$disp_promo_code = "<span style='color: red'>" . $promo_code . "</span>";

		$objResponse = new xajaxResponse();
		$answer = "";
		if (!$promo_code) {
			$objResponse->assign("update" . $count, "disabled", false);
			$answer = "If you do NOT enter a discount code";
			$answer .= "<br> we will ask you to pay with credit card.";
			$objResponse->Assign("ajax_message" . $count, "innerHTML", $answer);
			$objResponse->assign("update" . $count, "value", "CONTINUE WITHOUT DISCOUNT CODE");
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
		$objResponse->Assign("ajax_message" . $count, "innerHTML", $answer);
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