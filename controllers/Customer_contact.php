<?php

class Customer_contact extends Common_Auth_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->_ajax();
	}

	function print_r2($val)
	{
		echo '<pre>';
		print_r($val);
		echo '</pre>';
	}

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		// Xajax Form Validator library
		$this->load->library('xajax/xajax_validator');

		$this->xajax->configure("requestURI", 'customer_contact/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('show_noshow', &$this, 'show_noshow'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete_from_class', &$this, 'delete_from_class'));
		$this->xajax->processRequest();
	}

	function show_noshow($ledger_id, $count)
	{
		$result = $this->ledger_model->mark_show_noshow($ledger_id);

		if (!$result) return FALSE;

		if ($result['status'] == LEDGER_NO_SHOW)
			$status = "No Show";
		elseif ($result['status'] == LEDGER_SHOW)
			$status = "Show";
		else
			$status = "";
		$attended = $result['attended'];

		$objResponse = new xajaxResponse();
		$objResponse->Assign("status" . $count, "innerHTML", $status);
		$objResponse->Assign("attended", "innerHTML", $attended);

		return $objResponse;
	}

	function delete_from_class($ledger_id, $count)
	{
		$result = $this->ledger_model->mark_deleted($ledger_id);

		if (!$result) return FALSE;

		if ($result['status'] == LEDGER_DELETED)
			$status = "Removed";
		elseif ($result['status'] == LEDGER_BOOKED)
			$status = LEDGER_BOOKED;
		else
			$status = " ";

		$attending = $result['attending'];

		$objResponse = new xajaxResponse();
		$objResponse->Assign("status" . $count, "innerHTML", $status);
		$objResponse->Assign("attending", "innerHTML", $attending);

		return $objResponse;
	}

	function booked_customers_overview()
	{

		$data = array();
		$data['title'] = 'Active Customers';
		$data['title_action'] = 'Manage active customers';
		$data['records'] = $this->customer_contact_model->get_active_customers();
//print_r($data['records']);
		$this->load->view('customer/booked_customers_over_view', $data);

	}


	function customers_by_event($event_id, $location_id, $counter = FALSE, $error_message = '')
	{

		$data['title'] = 'Manage Event';
		$data['title_action'] = 'Booked Customers';

		$data['location_name'] = $this->location_model->get_location_name($event_id);
		$data['events'] = $this->event_model->get_record($event_id);
		$data['attending'] = $this->ledger_model->attending($event_id);
		$data['event_id'] = $event_id;
		$data['location_id'] = $location_id;
		$data['counter'] = $counter;

		$data['error_message'] = $error_message;
		$data['records'] = $this->customer_contact_model->get_customers_by_event($event_id);
//echo print_r2($data['records']); die();

		$this->load->view('customer/booked_customers_by_event_view', $data);
	}

	function class_actions($event_id, $location_id, $class_size)
	{
//			$this->load->view('customer/choose_email', $data);

		if ($this->input->post('send_mails') == "Send Mails") {
			$this->class_participants($event_id, $class_size, $location_id);
			//			$this->customers_by_event($event_id, $location_id)	;
		} else {
		}
	}


	function class_participants($event_id, $class_size, $location_id = 0)
	{
//echo "event id =" .$event_id ;
// echo "class size=" .$class_size. "<br>";

		$customers_to_mail = array();
		$ledger_id = 0;
		for ($i = 0; $i < $class_size; $i++) {
			$checked = 'send_mail' . $i;
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
//				$customer_id = $this->input->get_post('customer_id'. $i);
				$ledger_id = $this->input->get_post('ledger_id' . $i);

//echo "customer_id =	" .	$customer_id . "<br>";
//echo "ledger_id =	" .	$ledger_id . "<br>";

				array_push($customers_to_mail, $ledger_id);
			};
		};

//print_r(	$customers_to_mail	);

		if (!$customers_to_mail) {
			$error_message = "Please select at least one customer to send email! ";
			$this->customers_by_event($event_id, $location_id, $error_message);

		} else {
			$maildata = array(
				'customers_to_mail' => $customers_to_mail,
				'event_id' => $event_id,
				'ledger_id' => $ledger_id
			);
			$this->session->set_userdata($maildata);

// echo 'selected customers 1:' . $_SESSION;	

			/* if ($this->session->has_userdata('customers_to_mail')) 
				 echo "exists";
			 else 
				 echo "not exist!" ;
			*/

			$customer_data = $this->customer_contact_model->get_selected_customers($customers_to_mail);

//print_r2($customer_data);			

			foreach ($customer_data as $row) {
				$activity_id = $row->activity_id;
				//		$location_id = $row->location_id;
				break;  //need just one, they are all the same activity_id;
			}
			if ($customer_data)
				$this->get_template($activity_id, $customer_data);
			else {
				$error_message = "";
				$this->customers_by_event($event_id, $location_id, $error_message);
			}
		}
	}

	function get_template($activity_id, $customer_data)
	{
//echo  'customer data 2 = ' . print_r2($customer_data);

		$this->session->set_userdata('is_choose', '1');
		$manage_templates = array('manage_template' => FALSE);
		$this->session->set_userdata($manage_templates);

//echo  'customer data 3 = ' . print_r2($customer_data);

		$data['title'] = 'Choose email';
		$data['title_action'] = 'Choose a template';
		$data['top_note'] = "Select a template for " . $this->activity_model->get_activity_name($activity_id);
//echo  'customer data 4 = ' . print_r2($customer_data);
		$data['is_from_manage_templates'] = $this->session->userdata('manage_template');
//echo  'customer data 5 = ' . print_r2($customer_data);

		//    $data['is_choose'] = 1;
		$data['activity_id'] = $activity_id;
//echo  'customer data 6 = ' . print_r2($customer_data);
		$data['emailed_customer'] = $customer_data;
//print_r2( $data ) ; 
		$is_choose = TRUE;
		$data['is_choose'] = $is_choose;
		$data['records'] = $this->template_model->get_records($activity_id,$is_choose);
		$this->load->view('templates/template_over_view', $data);

		return;
	}

	function manage_template($template_id, $activity_id)
	{

//echo 'selected customers :' . print_r2($this->session->userdata('customers_to_mail'));

		$customer_data = $this->customer_contact_model->get_selected_customers($this->session->userdata('customers_to_mail'));

//echo 'customer data-1: ' . print_r2($customer_data);

		if ($this->input->post('submit') == "Preview Mail") {
			$data = array(
				'subject' => $this->input->post('subject'),
				'body' => $this->input->post('body'),
			);
			$this->template_model->update_record($data, $template_id);  //save the changes
			$template = $this->template_model->get_record($template_id);
//				$customers_to_mail = $this->session->userdata('customers_to_mail');
//print_r($customers_to_mail);
//echo 'customer data-1: ' . print_r2($customer_data);
			if ($customer_data) {
				foreach ($customer_data as $customer) {
					foreach ($template as $row) {
						$subject = $this->template_model->substitute_text($row->subject, $customer->customer_id);
						$body = $this->template_model->substitute_text($row->body, $customer->customer_id);
					}

					break;
				}

				$data = array(
					'subject_substituted' => $subject,
					'body_substituted' => $body,
				);
				$this->template_model->update_record($data, $template_id);
				$this->template_show($template_id);
			}
		}

		if ($this->input->post('submit') == "Template View") {
			$this->template_edit($template_id);
		}

		if ($this->input->post('submit') == "Start Over") {
			$data = array(
				'subject' => $this->session->userdata('subject'),
				'body' => $this->session->userdata('body'),
			);
			$this->template_model->update_record($data, $template_id);
			$this->template_edit($template_id);
		}

		if ($this->input->post('submit') == "Abort") {
			$data = array(
				'subject' => $this->session->userdata('subject'),
				'body' => $this->session->userdata('body'),
			);
			$this->template_model->update_record($data, $template_id);
			$this->get_template($activity_id, $customer_data);
		}

		if ($this->input->post('submit') == "Save") {
			$data = array(
				'subject' => $this->input->post('subject'),
				'body' => $this->input->post('body'),
			);
			$this->template_model->update_record($data, $template_id);  //save the changes
			$this->get_template($activity_id, $customer_data);
		}

		if ($this->input->post('submit') == "Send Mails") {
			$this->send_mail($template_id, FALSE, $activity_id);
		}
	}

	function send_mail($template_id, $is_direct = FALSE, $activity_id)
	{
		$template = $this->template_model->get_record($template_id);
		$customer_data = $this->customer_contact_model->get_selected_customers($this->session->userdata('customers_to_mail'));

//echo '<pre>';
//print_r($customer_data);
//echo '</pre>';die();

		foreach ($customer_data as $customer) {
			foreach ($template as $row) {
				// print_r2($row);

//                echo 'email sent to: ' . $customer->email . '<br>';

				$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
				$this->email->to('alfred.laggner@gmail.com');

//					$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
//					$this->email->to('alfred.laggner@gmail.com'); 
//					$this->email->to($customer->email); 
				//			$this->email->cc('info@treksandtracks.com');

				$this->email->subject($this->template_model->substitute_text($row->subject, $customer->customer_id));
				$this->email->message($this->template_model->substitute_text($row->body, $customer->customer_id));

				$this->template_to_attachment_model->put_attachments($template_id);

				if ($this->email->send()) {
					//                  echo 'Your e-mail has been sent! <br>';

					$data = array();
					$data = array(
						'customer_id' => $customer->customer_id,
						'date_time' => date(TIME_FORMAT),
						'to' => $customer->email,
						'subject' => $this->template_model->substitute_text($row->subject, $customer->customer_id),
						'body' => $this->template_model->substitute_text($row->body, $customer->customer_id),
						'purpose' => $row->name,
						'is_incoming' => FALSE,
					);
					$this->mail_model->add_record($data);

				} else {
					echo $this->email->print_debugger(array('headers'));
				}
				$this->email->clear(true);
			}
		}
		if ($is_direct)
			$this->get_template($activity_id, $customer_data);
		else
			$this->template_edit($template_id);
	}


	function template_show($template_id)
	{
		$data['title'] = 'eMail Customers';
		$data['title_action'] = 'Preview eMail';
		$data['records'] = $this->template_model->get_record($template_id);
		$data['template_id'] = $template_id;
		$data['is_preview'] = TRUE;
		$data['attachments'] = $this->attachment_model->get_records();
		$data['attachment_count'] = $this->attachment_model->count_all();
		$data['template_attachments'] = $this->template_to_attachment_model->get_template_to_attachment_records($template_id);
//print_r($data['template_attachments']);		
		$this->load->view('templates/template_edit', $data);
	}

	function template_edit($template_id, $is_first_time = FALSE)
	{

		$data['title'] = 'eMail Customers';
		$data['title_action'] = 'Modify eMail';
		$data['records'] = $this->template_model->get_record($template_id);
//print_r($data['records']);		
		$data['template_id'] = $template_id;
		$data['is_preview'] = FALSE;
		if ($is_first_time)
			$this->template_model->save_original_message($data['records']);

		$data['place_holders_text'] = $this->template_model->get_place_holders_text();
		$data['attachments'] = $this->attachment_model->get_records();
		$data['attachment_count'] = $this->attachment_model->count_all();
		$data['template_attachments'] = $this->template_to_attachment_model->get_template_to_attachment_records($template_id);
		$this->load->view('templates/template_edit', $data);
	}


	function add_attachments_to_templates($template_id, $attachment_count)
	{
		if ($this->input->post('assign_attachments') == "Attach to emails") {
			$this->template_to_attachment_model->delete_template_records($template_id);
			$this->template_to_attachment_model->add_record($template_id, $attachment_count);
			$this->template_edit($template_id, false);
		} elseif ($this->input->post('assign_attachments_from_template_view') == "Attach to emails") {
			$this->template_to_attachment_model->delete_template_records($template_id);
			$this->template_to_attachment_model->add_record($template_id, $attachment_count);
			$this->template_view($template_id, false);
		} elseif ($this->input->post('add_attachment') == "Add new to list") {
			$this->attachment_create_view($template_id);
		} else {
			$this->template_edit($template_id, false);
		}
	}

	function template_update($template_id)
	{
		$data = array(
			'subject' => $this->input->post('subject'),
			'body' => $this->input->post('body'),
		);
		$this->template_model->update_record($data, $template_id);
		$this->template_edit($template_id, '');
	}

	function xxxsend_emails($event_id, $customer_data)
	{
//		$this->email->clear(TRUE);
		$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';
//		$config['charset'] = 'iso-8859-1';

		$activity = $this->event_model->get_record($event_id);
		foreach ($activity as $row) {
			$activity_name = $row->name;
			$location_name = $row->location_name;
			$event_date = $row->date;
			$event_time = $row->time;
		}
//		print_r($activity);	
		foreach ($customer_data as $row) {
			$this->email->initialize($config);
			$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
			$this->email->to('alfred.laggner@gmail.com');
//			$this->email->to($row->email); 
			$this->email->cc('treatment@pvacupuncture.com');

			$this->email->subject('Treks and Tracks thanks you for participating ');
			$this->email->message($this->ledger_model->get_thank_you_text($row->first_name, $activity_name, $location_name, $event_date, $event_time));

			$this->email->send();
		}

	}

	function delete($customer_id, $event_id, $location_id, $status = ' ')
	{
		//marks as deleted in ledger only
		$this->ledger_model->mark_deleted($customer_id, $status);
		$this->customers_by_event($event_id, $location_id);

	}

	function xshow_noshow($ledger_id, $event_id, $location_id, $status = ' ')
	{
		//marks as deleted in ledger only
		$result = $this->ledger_model->mark_show_noshow($ledger_id, $status);
		$this->customers_by_event($event_id, $location_id);

	}

	function hexToStr($hex)
	{
		$string = '';
		for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
			$string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
		}
		return $string;
	}

	function customer_contact_overview($customer_id = 0, $email = '', $strpos = 0)
	{
		$email = substr_replace($email, '@', $strpos, 2);
		if (!$customer_id) {
			echo 'no customer!';
			return FALSE;
		}

		$data = array();
		$data['title'] = 'Customer History';
		$data['title_action'] = 'Customer History';
		$data['top_note'] = '';
		$data['bottom_note'] = '';
		$data['customer_id'] = $customer_id;
		$data['records'] = $this->customer_contact_model->get_record($customer_id);
		$data['contacts'] = $this->customer_contact_model->get_contacts($customer_id);
//echo $customer_id;		
//print_r($data['records']);die();
		$data['customer_history'] = $this->customer_contact_model->get_customer_history($email);

		$data['name'] = $this->customer_contact_model->get_customer_name($customer_id);
		$data['email'] = $this->customer_contact_model->get_customer_emails($customer_id);
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('customer/customer_contact_over_view', $data);
	}

	function customer_contact_create($customer_id)
	{
		$data['title'] = 'Customer Contact';
		$data['title_action'] = 'Create Customer Contact';
		$data['customer_id'] = $customer_id;
		$data['customer_name'] = $this->customer_contact_model->get_customer_name($customer_id);
		$data['types'] = $this->customer_contact_type_model->get_records();
		$data['employees'] = $this->employee_model->get_records();
		$this->load->view('customer/customer_contact_create_view', $data);

	}

	function customer_contact_view($customer_contact_id, $customer_id)
	{
		$data['title'] = 'Customer Contact';
		$data['title_action'] = 'Edit Customer Contact';
		$data['customer_name'] = $this->customer_contact_model->get_customer_name($customer_id);
		$data['records'] = $this->customer_contact_model->get_record($customer_contact_id);
		$data['employees'] = $this->employee_model->get_records();
		$data['types'] = $this->customer_contact_type_model->get_records();
		$this->load->view('customer/customer_contact_view', $data);

	}

	function customer_mail_view($mail_id, $customer_id)
	{
		$data['title'] = 'Customer Mail';
		$data['title_action'] = 'View Customer Mail';
		$data['customer_name'] = $this->customer_contact_model->get_customer_name($customer_id);
		$data['records'] = $this->mail_model->get_record($mail_id);
		$data['employees'] = $this->employee_model->get_records();
		$this->load->view('customer/customer_mail_view', $data);

	}


	function create($customer_id)
	{
		$data = array(
			'customer_id' => $this->input->post('customer_id'),
			'entered_at' => $this->input->post('entered_at'),
			'type_id' => $this->input->post('type_id'),
			'note' => $this->input->post('note'),
			'next_contact' => $this->input->post('next_contact'),
			'employee_id' => $this->input->post('employee_id')
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->customer_contact_overview($customer_id);
		} elseif ($this->input->post('create') == "Create") {
			$this->customer_contact_model->add_record($data);
			$this->customer_contact_overview($customer_id);
		} else {
			$this->customer_contact_overview($customer_id);
		};

	}

	function update($customer_contact_id, $customer_id)
	{
		$data = array(
			'customer_id' => $this->input->post('customer_id'),
			'entered_at' => $this->input->post('entered_at'),
			'type_id' => $this->input->post('type_id'),
			'note' => $this->input->post('note'),
			'next_contact' => $this->input->post('next_contact'),
			'employee_id' => $this->input->post('employee_id')
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->customer_contact_overview($customer_id);
		} elseif ($this->input->post('update') == "Update") {
			$this->customer_contact_model->update_record($data);
			$this->customer_contact_view($customer_contact_id, $customer_id);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->customer_contact_model->update_record($data);
			$this->customer_contact_overview($customer_id);
		} else {
			$this->customer_contact_overview($customer_id);
		};
	}

// attachments
	function attachment_index()
	{
		$data = array();

		if ($query = $this->attachment_model->get_records()) {
			$this->template_edit();
//			$data['title'] = 'Attachments';
//			$data['title_action'] = 'Manage attachments';
//			$data['top_note'] = 'List of your attachments';
//			$data['breadcrumb'] = '';
//			$data['records'] = $query;
//			$this->parser->parse('attachment/attachment_over_view', $data);
		} else {

			$this->attachment_create_view();
		}
	}

	function attachment_view($attachment_id, $template_id)
	{
		$data['title'] = 'attachment';
		$data['title_action'] = 'Edit attachment';
		$data['breadcrumb'] = '';
		$data['template_id'] = $template_id;
		$data['records'] = $this->attachment_model->get_record();
		$this->load->view('attachment/attachment_view', $data);
	}

	function attachment_create_view($template_id)
	{
		$data['title'] = 'New attachment';
		$data['title_action'] = 'Create attachment';
		$data['breadcrumb'] = '';
		$data['template_id'] = $template_id;
		$this->load->view('attachment/attachment_create_view', $data);
	}

	function attachment_create()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('file_name', 'File Name', 'required');
		$this->form_validation->set_rules('file_name', 'File Name', 'callback_file_name_check');
		if ($this->form_validation->run() == FALSE) {
			$this->attachment_create_view($this->input->post('template_id'));
		} else {
			$data = array(
				'attachment_name' => $this->input->post('attachment_name'),
				'file_name' => $this->input->post('file_name'),
			);

			$this->attachment_model->add_record($data);
			$this->template_edit($this->input->post('template_id'));
		}
	}

	function attachment_update($attachment_id, $template_id)
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('file_name', 'File Name', 'required');
		$this->form_validation->set_rules('file_name', 'File Name', 'callback_file_name_check');
		if ($this->form_validation->run() == FALSE) {
			$this->attachment_view($this->input->post('template_id'));
		} else {
			$data = array(
				'attachment_name' => $this->input->post('attachment_name'),
				'file_name' => $this->input->post('file_name'),
			);

			if ($this->input->post('delete') == "Delete") {
				$this->attachment_model->delete_record($attachment_id);
			} else {
				$this->attachment_model->update_record($attachment_id, $data);
			}

			$this->template_edit($this->input->post('template_id'));
		}
	}

	public function file_name_check($fn)
	{
		$filename = "attachment_files/" . $fn;
		if (file_exists($filename)) {
			$this->form_validation->set_message('file_name_check', '%s does exist');
			return TRUE;
		} else {
			$this->form_validation->set_message('file_name_check', '%s ' . "'" . $fn . "'" . ' does not exist');
			return FALSE;
		}
	}

	function attachment_delete($attachment_id, $template_id)
	{
		$this->attachment_model->delete_record();
		$this->template_edit($template_id);
	}


}