<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tt_v1 extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->library('javascript');
		$this->cache_minutes = 0;
		$this->_ajax();

	}

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		// Xajax Form Validator library
		$this->load->library('xajax/xajax_validator');

		$this->xajax->configure("requestURI", base_url() . 'index.php/tt_v1/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('form_contact', &$this, 'form_contact'));
		$this->xajax->register(XAJAX_FUNCTION, array('verify_promo_code', &$this, 'verify_promo_code'));
		$this->xajax->register(XAJAX_FUNCTION, array('getProducts', &$this, 'getProducts'));
		$this->xajax->register(XAJAX_FUNCTION, array('getGears', &$this, 'getGears'));
		$this->xajax->register(XAJAX_FUNCTION, array('disp_pregnant', &$this, 'disp_pregnant'));
		$this->xajax->processRequest();
	}


	function disp_pregnant($form_data, $i)
	{
		//	echo $range;
		if ($form_data['sex' . $i] == "M") {
			$status = "";
		} else {
			$data['i'] = $i;
			$status = $this->load->view("xajax/disp_pregnant", $data, TRUE);
		}


		$objResponse = new xajaxResponse();
		$objResponse->Assign("disp_pregnant" . $i, "innerHTML", $status);

		return $objResponse;
	}

	function getProducts($style = 0)
	{
		$data['all_classes'] = $this->tt_model_v1->get_all_classes($style, FALSE);


		$objResponse = new xajaxResponse();
		$objResponse->Assign("product_display", "innerHTML", $this->load->view("xajax/product_result", $data, TRUE));
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
		$region = $this->tt_model_v1->get_region_name($region_id);

		$objResponse = new xajaxResponse();
		$objResponse->Assign("disp_region", "innerHTML", $region);
		return $objResponse;

	}

	// All Pages

	function index($style = 0)
	{
//	     require_once(FCPATH.'ajaxfw.php');
//     $ajax = ajax();
////		$ajax = ajax();
//$region_id = "2";  
//$this->session->set_userdata('region_id',$region_id);
//echo "selected region= " . $this->session->userdata('region_id');	

		$data = array();

		$data['records'] = $this->tt_model_v1->get_all_classes(0, TRUE);
		$data['home_sliders'] = $this->home_slider_model->get_records(TRUE);

		$data['all_classes'] = $this->tt_model_v1->get_all_classes($style, FALSE);
		$data['styles'] = $this->style_model->get_records();

		$data['all_gears'] = $this->gear_model->get_records();
		$data['gear_groups'] = $this->gear_group_model->get_records();

		$region_id = $this->session->userdata('region_id');
		//	$data['region'] = $this->tt_model_v1->get_region_name($region_id);
		$data['regions'] = 0;//$this->tt_model_v1->get_Regions();
		$data['region_id'] = $region_id;
		$data['region_name'] = $this->tt_model_v1->get_region_name($region_id);;

		if (!$this->input->cookie('region_set')) {
			$data['region_set'] = " onLoad=\"actuateLink(document.getElementById('top-bar-checkout'))\"> ";
		} else {
			$data['region_set'] = "";
		}

		$this->_head("Home - Treks and Tracks");
		$this->load->view('tt_v1/index', $data);

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

	function tt_paginate_featured()
	{
		$config = $this->init_pagination_featured();
		$this->pagination->initialize($config);
		$data['row_numbers'] = $config['total_rows'];
		$this->session->set_userdata('p_offset', $this->uri->segment(3));  // save it for later
		$data['region'] = $this->tt_model_v1->get_region_name($this->session->userdata('region_id'));
		$data['records'] = $this->tt_model_v1->get_paginated_classes_featured($config['per_page'], $this->uri->segment(3));
		$this->view_classes($data);
	}

	function init_pagination_featured()
	{
		$config['base_url'] = site_url() . '/tt/tt_paginate_featured/';
		$config['per_page'] = 99;
		$config['num_links'] = 2;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['total_rows'] = $this->tt_model_v1->get_rows_featured(); // only number of rows
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		return $config;
	}

	function _head($title = "", $data = array())
	{
		$data['title'] = $title;

		$this->load->view('tt_v1/blocks/head', $data);
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

		$data['records'] = $this->tt_model_v1->get_Regions();
		$this->view_regions($data);
	}

// classes
	function init_pagination()
	{
		$config['base_url'] = site_url() . '/tt_v1/tt_paginate/';
		$config['per_page'] = 99;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['total_rows'] = $this->tt_model_v1->get_rows(); // only number of rows
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		return $config;
	}

	function classes()
	{
		$this->tt_model_v1->get_all_classes(0, 0); // to initialize the variables
		$config = $this->init_pagination();
		$this->pagination->initialize($config);
		$data['row_numbers'] = $config['total_rows'];
		$data['records'] = $this->tt_model_v1->get_all_classes($config['per_page'], 0);
		$data['region'] = $this->tt_model_v1->get_region_name($this->session->userdata('region_id'));
		$this->view_classes($data);
	}

	function tt_paginate()
	{
		$config = $this->init_pagination();
		$this->pagination->initialize($config);
		$data['row_numbers'] = $config['total_rows'];
		$this->session->set_userdata('p_offset', $this->uri->segment(3));  // save it for later
		$data['region'] = $this->tt_model_v1->get_region_name($this->session->userdata('region_id'));
		$data['records'] = $this->tt_model_v1->get_paginated_classes($config['per_page'], $this->uri->segment(3));
		$this->view_classes($data);
	}

	function view_classes($data)
	{
		$this->_head("Classes - Treks and Tracks");
		$this->load->view('tt_v1/collection', $data);
	}

	function product($activity_id, $err_num = 0)
	{
		$data['equipments'] = $this->equipment_model->get_equipment($activity_id);
		$data['events'] = $this->activity_booking_model->get_booking
		(0, $activity_id);
		$data['locations'] = $this->event_model->get_by_location($activity_id);
		$data['activities_related'] = $this->tt_model_v1->get_related_activities($activity_id);
		$data['records'] = $this->tt_model_v1->get_class($activity_id);

		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);

		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);

		$head_data['meta_title'] = $this->activity_model->get_activity_name($activity_id);
		$head_data['meta_description'] = $this->activity_model->get_activity_description_short($activity_id);

		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/product', $data);
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

		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/gear', $data);
	}


	function product_booking1($activity_id, $err_num = 0)
	{
		$data['events'] = $this->activity_booking_model->get_booking(0, $activity_id);
//print_r($data['events']); 
		$data['locations'] = $this->event_model->get_by_location_v1($activity_id);
//print_r($data['locations']); 
		$data['records'] = $this->tt_model_v1->get_class($activity_id);
//print_r($data['records']);     
		$data['pictures'] = $this->activity_pictures_model->get_records($activity_id);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);
		$head_data['meta_title'] = "Booking - Treks and Tracks";
		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/booking1', $data);
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
//	print_r2($data['events']);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);

//	echo "update1=".$this->input->post('update1');

		if ($this->input->post('update') != "CONTINUE EXP")
			$data['events'][0]['exp_discount_price'] = 0;

		//die();
		$data['error'] = $err_num;
		$head_data['meta_title'] = "Enter Student Information";
		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/booking2', $data);

	}


	function show_summary($event_group_id, $ledger_id, $err_num = 0)
	{
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // fetches only the data of main customer

//print_r2($data['records']); die();

		$data['error'] = $err_num;
		$data['error_text'] = $this->ledger_model->response_reason_codes($err_num);
		$head_data['meta_title'] = "Booking Summary";
		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/summary', $data);

	}


	function relay_response()
	{
		// Flag if this is an ARB transaction. Set to false by default.
		$redirect_url = site_url() . "tt_v1/class_detail/9"; // Where the user will end up.
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
			$redirect_url = site_url() . "tt_v1/cc_success/" . $event_group_id; // Where the user will end up.
		} else {
			if (!$event_group_id) $event_group_id = 0;  //placeholder
//				if (! $this->input->post('x_first_name') && ! $this->input->post('x_last_name'))
//					$redirect_url = site_url()."tt_v1/product/". $activity_id  . "/" .$response_reason_code; // 
//				else
			$redirect_url = site_url() . "tt_v1/show_summary/" . $event_group_id . "/" . $ledger_id . "/" . $response_reason_code; //
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
		//$data['region_id'] = $this->session->userdata('region_id');
		$data['region_id'] = 1;
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);
		$this->send_emails($event_group_id);
		$this->ledger_model->book_ledger_full_discount($ledger_id, $event_group_id);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE);
//print_r($data['records']); die();
		$head_data['meta_title'] = "Discount Success";
		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/discount_success', $data);
	}

//		echo $this->email->print_debugger(); die();


	function cc_success($event_group_id)
// for credit card read payment summary	
// for discount read ledger summary	(no payment record
	{
//		$data['payment_id'] = $payment_id;
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model_v1->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v1/blocks/top_bar', $data, true);
		$this->send_emails($event_group_id);
		$data['records'] = $this->ledger_model->get_summary($event_group_id, TRUE); // mark as payed
//print_r($data['records']); die();
		$head_data['meta_title'] = "Payment Success";
		$this->load->view('tt_v1/blocks/head', $head_data);
		$this->load->view('tt_v1/cc_success', $data);

	}

//    public function sendemail()
//    {
//
//        $this->load->library('email');
//        $this->email->set_newline("\r\n");
//        $this->email->from('alfred.laggner@gmail.com', 'Name');
//        $this->email->to('treatment@acupuncture-ensenada.com');
//        $this->email->subject(' My mail through codeigniter from localhost ');
//        $this->email->message('Hello World…');
//        if (!$this->email->send()) {
//            show_error($this->email->print_debugger());
//        } else {
//            echo 'Your e-mail has been sent!';
//        }
//    }


	function send_emails_old($event_group_id)
	{


		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';

		$query = $this->ledger_model->get_summary($event_group_id, TRUE);
//print_r($query); die();

		foreach ($query as $row) {
			if ($row->confirm_email_sent == 0) {

				//			$this->email->initialize($config);
				$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
//				$this->email->to($row->email); 
				$this->email->to('treatment@acupuncture-ensenada.com');
//				$this->email->to('alfred.laggner@gmail.com'); 
//				$this->email->cc('info@treksandtracks.com'); 
//				$this->email->bcc('alfred.laggner@gmail.com'); 

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

	function send_emails($event_group_id)
	{


//        $config['protocol'] = 'sendmail';
//        $config['mailtype'] = 'html';
//        $config['charset'] = 'iso-8859-1';
//echo "ledger activity id: " . $event_group_id;		

		$query = $this->ledger_model->get_summary($event_group_id, TRUE);
//print_r2($query);	
//echo "ledger activity id: ";		
		foreach ($query as $q) {
		} //echo $q->activity_id;

		$templates = $this->template_model->get_confirmation_email($q->activity_id);
//echo '<br>template activity id: ';		
// print_r2($templates);
//foreach ($templates as $q) echo $q->activity_id;

//print_r2($templates);
//
// die();

		$error_confirmation_email_not_found = "confirmation email already sent";
		if ($templates) {
			foreach ($templates as $template) {
				$subject = $template->subject;
				$body = $template->body;
			}

			foreach ($query as $row) {
				//die('got here' . $row->confirm_email_sent . '-' . $row->ledger_id);
				if (!$row->confirm_email_sent) {
					//echo 'got here' . $row->confirm_email_sent . '-' . $row->ledger_id;

					//				echo 'email sent to: ' . $row->email . '<br>';
					$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
					//	real			$this->email->to($row->email); 
					$this->email->to('alfred.laggner@gmail.com');
					//				$this->email->bcc('daniel@treksandtracks.com'); 

					$this->email->message($this->template_model->substitute_text($body, $row->customer_customer_id, $row->event_id));
					$this->email->subject($this->template_model->substitute_text($subject, $row->customer_customer_id, $row->event_id));


					if ($this->email->send()) {
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
				'date_of_birth' => 0,
				'email' => $this->input->post('email' . $i),
				'cell' => $this->input->post('cell' . $i),
				'emergency_contact' => $this->input->post('emergency_contact' . $i),
				'emergency_phone' => $this->input->post('emergency_phone' . $i),
				'created_on' => $this->input->post('booking_date' . $i),
				//         'sex' => strtoupper($this->input->post('sex') . $i),
				'address1' => $this->input->post('address1' . $i),
				'address2' => '',
				'city' => $this->input->post('city' . $i),
				'zip' => $this->input->post('zip' . $i),
				'state' => $this->input->post('state' . $i),
				'country' => $this->input->post('country' . $i),
				'created_on' => date("Y-m-d g:i:s"),

			);
			$customer_id = $this->customer_model->add_record($data);

			$data = array(
				'customer_id' => $customer_id,
				'experience' => $this->input->post('experience' . $i),
				'is_fear_of_heights' => $this->input->post('is_fear_of_heights' . $i),
				'have_backpack' => $this->input->post('have_backpack' . $i),
				'have_tent' => $this->input->post('have_tent' . $i),
				'have_sleeping_bag' => $this->input->post('have_sleeping_bag' . $i),
				'have_sleeping_pad' => $this->input->post('have_sleeping_pad' . $i),
				'dietary_restrictions' => $this->input->post('dietary_restrictions' . $i),
				'breakfast_other' => $this->input->post('breakfast_other' . $i),
				'breakfast_other_text' => $this->input->post('breakfast_other_text' . $i),
				'breakfast_coffee' => $this->input->post('breakfast_coffee' . $i),
				'breakfast_black_tea' => $this->input->post('breakfast_black_tea' . $i),
				'breakfast_green_tea' => $this->input->post('breakfast_green_tea' . $i),
				'breakfast_herb_tea' => $this->input->post('breakfast_herb_tea' . $i),
				'breakfast_hot_chocolate' => $this->input->post('breakfast_hot_chocolate' . $i),
				'is_allow_photo_graphs' => $this->input->post('is_allow_photo_graphs' . $i),
				'date_signed' => $this->input->post('date_signed' . $i),
				'signature' => $this->input->post('signature' . $i),
				'is_questionaire' => isset($_POST['is_questionaire' . $i]) ? 1 : 0,
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
				'allergy_explainations' => $this->input->post('allergy_explainations' . $i),
				'medication_explainations' => $this->input->post('medication_explainations' . $i),
				'response_explainations' => $this->input->post('response_explainations' . $i),

			);
			$this->customer_model->add_health_record($data);


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

	public function update_questionaire($customer_id)
	{
		$data = array(
			'customer_id' => $customer_id,
			'is_questionaire' => $this->input->post('is_questionaire'),
			'experience' => $this->input->post('experience'),
			'is_fear_of_heights' => $this->input->post('is_fear_of_heights'),
			'have_backpack' => $this->input->post('have_backpack'),
			'have_tent' => $this->input->post('have_tent'),
			'have_sleeping_bag' => $this->input->post('have_sleeping_bag'),
			'have_sleeping_pad' => $this->input->post('have_sleeping_pad'),
			'dietary_restrictions' => $this->input->post('dietary_restrictions'),
			'breakfast_other' => $this->input->post('breakfast_other'),
			'breakfast_other_text' => $this->input->post('breakfast_other_text'),
			'breakfast_coffee' => $this->input->post('breakfast_coffee'),
			'breakfast_black_tea' => $this->input->post('breakfast_black_tea'),
			'breakfast_green_tea' => $this->input->post('breakfast_green_tea'),
			'breakfast_herb_tea' => $this->input->post('breakfast_herb_tea'),
			'breakfast_hot_chocolate' => $this->input->post('breakfast_hot_chocolate'),
			'is_allow_photo_graphs' => $this->input->post('is_allow_photo_graphs'),
			'date_signed' => $this->input->post('date_signed'),
			'signature' => $this->input->post('signature'),
			'is_questionaire' => $this->input->post('is_questionaire'),
			'sex' => $this->input->post('sex'),
			'dob' => $this->input->post('dob'),
			'weight' => $this->input->post('weight'),
			'height' => $this->input->post('height'),
			'is_asthma' => isset($_POST['is_asthma']) ? 1 : 0,
			'is_bleeding' => isset($_POST['is_bleeding']) ? 1 : 0,
			'is_inhaler' => isset($_POST['is_inhaler']) ? 1 : 0,
			'is_asthma' => isset($_POST['is_asthma']) ? 1 : 0,
			'is_diabetes' => isset($_POST['is_diabetes']) ? 1 : 0,
			'is_seizures' => isset($_POST['is_seizures']) ? 1 : 0,
			'is_cardio_disease' => isset($_POST['is_cardio_disease']) ? 1 : 0,
			'is_hypertension' => isset($_POST['is_hypertension']) ? 1 : 0,
			'is_knee_ankle_shoulder' => isset($_POST['is_knee_ankle_shoulder']) ? 1 : 0,
			'is_dizziness' => isset($_POST['is_dizziness']) ? 1 : 0,
			'is_see_medical_specialist' => isset($_POST['is_see_medical_specialist']) ? 1 : 0,
			'is_any_other_condition' => isset($_POST['is_any_other_condition']) ? 1 : 0,
			'is_pregnant' => isset($_POST['is_pregnant']) ? 1 : 0,
			'is_allergic_medications' => isset($_POST['is_allergic_medications']) ? 1 : 0,
			'is_allergic_insect_stings' => isset($_POST['is_allergic_insect_stings']) ? 1 : 0,
			'is_allergic_food' => isset($_POST['is_allergic_food']) ? 1 : 0,
			'is_allergic_other' => isset($_POST['is_allergic_other']) ? 1 : 0,
			'is_medications' => isset($_POST['is_medications']) ? 1 : 0,

			'allergy_explainations' => $this->input->post('allergy_explainations'),
			'medication_explainations' => $this->input->post('medication_explainations'),
			'response_explainations' => $this->input->post('response_explainations'),
		);
		$this->customer_model->update_health_record($customer_id, $data);
		$data = ['is_questionaire_checked' => isset($_POST['is_questionaire_checked']) ? 1 : 0,];
		$this->customer_model->update_checked_questionaire($customer_id, $this->input->post('event_id'), $data);
		if ($this->input->post('return') == "Return")
			redirect('customer_contact/customers_by_event/' . $this->input->post('event_id') . '/' . $this->input->post('location_id') . '/' . $this->input->post('counter'), 'refresh');
	}
}
/* End of file tt.php */
/* Location: ./application/controllers/tt.php */