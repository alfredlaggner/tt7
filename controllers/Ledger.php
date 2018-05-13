<?php

class Ledger extends Common_Auth_Controller
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

		$this->xajax->configure("requestURI", base_url() . 'index.php/ledger/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('getActivities', &$this, 'getActivities'));
		$this->xajax->processRequest();
	}

	function getActivities($activity_id, $location_id)
	{

		$data['events'] = $this->activity_booking_model->get_booking(0, $activity_id, $location_id);

		$objResponse = new xajaxResponse();
		if ($data['events'])
			$objResponse->Assign("activity_display", "innerHTML", $this->load->view("xajax/activity_result", $data, TRUE));
		else
			$objResponse->Assign("activity_display", "innerHTML", $this->load->view("xajax/activity_result_nothing_found", $data, TRUE));

		return $objResponse;
	}


	function old_index()
	{
//		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {redirect('auth', 'refresh');} 

		$data['title'] = 'Ledger';
		$data['title_action'] = 'Manage Ledger';
		$data['top_note'] = 'Enter bookings, reservations etc';
		$data['bottom_note'] = '';
		$this->ledger_model->change_reserved_state();
		$data['records'] = $this->ledger_model->get_records();
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('ledger/ledger_over_view', $data);
	}


	function event_create_view()
	{
		$event = $this->uri->uri_to_assoc(3);
		$from_calendar = $event['from_calendar'];
		$event_id = $event['event_id'];

		if (!$data['records'] = $this->ledger_model->get_activity_records($event_id)) {
			$cdata = array(
				'name' => urldecode($event['name']),
				'date' => $event['date'],
				'time' => $event['time'],
				'duration' => $event['duration'],
				'instructor' => urldecode($event['instructor']),
				'attending' => $event['attending'],
				'activity_id' => $event['activity_id'],
				'event_id' => $event['event_id'],
				'price' => $event['price'],
				'discount' => $event['discount'],
				'tax' => $event['tax'],
				'promo_code' => '',
				'booking_date' => date(DATE_RFC822));

			$this->ledger_model->add_record($cdata);

			$ledger_id = $this->db->insert_id();
//			$data['records'] = $this->ledger_model->get_activity_records($event_id);		
			$this->attendants($ledger_id, $event['event_id']);
		} else {
			$this->event_view($event_id);
		}
	}

	function attendants($ledger_id, $event_id)
	{
		$data['title'] = 'Ledger';
		$data['title_action'] = 'Edit Attendants';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['nr_filled_out'] = $this->ledger_to_customer_model->get_nr_filled_out($ledger_id);
//		$data['attendants'] = $this->ledger_to_customer_model->get_attendants($ledger_id);
//		$data['nr_attendants'] = $nr_attendants;
		$data['ledger_id'] = $ledger_id;
		$data['event_id'] = $event_id;
		$data['states'] = $this->customer_model->states();
		$data['records'] = $this->ledger_model->get_record($ledger_id);
		$this->load->view('customer/attendants_view', $data);
	}

	function attendants_create($event_id)
	{
		$data['title'] = 'Ledger';
		$data['title_action'] = 'Edit Attendants';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
//		$data['nr_filled_out'] = $this->ledger_to_customer_model->get_nr_filled_out($ledger_id);
		$data['event_id'] = $event_id;
		$data['states'] = $this->customer_model->states();
		$this->load->view('customer/attendants_view', $data);
	}

	function event_view($event_id)
	{
		$data['title'] = 'Event Booking';
		$data['title_action'] = '';
		$data['events'] = $this->activity_booking_model->get_records($event_id);
		$data['records'] = $this->ledger_model->get_activity_records($event_id);
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$this->load->view('ledger/ledger_event_view', $data);
	}

	function create()
	{
		$data = array(
//			'name' => $this->input->post('name'),
//			'date' => $this->input->post('date'),
//			'time' => $this->input->post('time'),
//			'duration' => $this->input->post('duration'),
//			'instructor' => $this->input->post('instructor'),
			'activity_id' => $this->input->post('activity_id'),
			'event_id' => $this->input->post('event_id'),
			'price' => $this->input->post('price'),
			'discount' => $this->input->post('discount'),
			'tax' => $this->input->post('tax'),
//			'attending' => $this->input->post('attending'),
			'promo_code' => $this->input->post('promo_code'),
			'booking_date' => $this->input->post('booking_date'),
		);
		$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
		if (!$is_calendar) {

			if ($this->input->post('cancel') != 'Cancel') {
				if ($this->input->post('reserve') == 'Reserve' or $this->input->post('reserve_later') == 'Reserve')
					$data['status'] = LEDGER_RESERVED;
				else
					$data['status'] = LEDGER_BOOKED;

				if ($this->ledger_model->add_record($data)) {
					$ledger_id = $this->db->insert_id();
					$data = array('available' => $this->input->post('available') - $this->input->post('attending'));
					$this->event_model->update_available($this->input->post('event_id'), $data);
					if ($this->input->post('reserve') == 'Reserve' or $this->input->post('book') == 'Book') {
						$this->attendants($ledger_id, $this->input->post('attending'));
					} else $this->event_view($event_id);
				} else $this->event_view($event_id);
			} else $this->event_view($event_id);
		} else {
			// remember it is from calendar
			$cal_flag = array('from_calendar' => '1');
			$this->session->set_userdata($cal_flag);
			// turn calendar mode off
			$cal_flag = array('from_calendar' => '0');

			if ($this->input->post('cancel') != 'Cancel') {
				$this->session->set_userdata($cal_flag);
				if ($this->input->post('reserve') == 'Reserve' or $this->input->post('reserve_later') == 'Reserve')
					$data['status'] = LEDGER_RESERVED;
				else
					$data['status'] = LEDGER_BOOKED;

				if ($this->ledger_model->add_record($data)) {
					$ledger_id = $this->db->insert_id();
					$data = array('available' => $this->input->post('available') - $this->input->post('attending'));
					$this->event_model->update_available($this->input->post('event_id'), $data);
					if ($this->input->post('reserve') == 'Reserve' or $this->input->post('book') == 'Book') {
						$this->attendants($ledger_id, $this->input->post('attending'));
					} else
						redirect('calendar/display', 'refresh');
				} else
					redirect('calendar/display', 'refresh');
			} else
				redirect('calendar/display', 'refresh');
		}
	}

	function update($ledger_id, $attending_old)
	{
		$data = array(
			'attending' => $this->input->post('attending'),
			'promo_code' => $this->input->post('promo_code'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->ledger_model->delete_record();
			$this->event_view($event_id);
		} else {
			if ($this->input->post('cancel') != 'Cancel') {
				if ($this->input->post('reserve') == 'Reserve' or $this->input->post('reserve_later') == 'Reserve')
					$data['status'] = LEDGER_RESERVED;
				else
					$data['status'] = LEDGER_BOOKED;

				if ($this->ledger_model->update_record($ledger_id, $data)) {

//echo $this->input->post('available') .' + ';						
//echo $attending_old .' - ';						
//echo $this->input->post('attending') .' = ';						
//echo $this->input->post('available') + ($attending_old - $this->input->post('attending') );	

					$data = array('available' => $this->input->post('available') + ($attending_old - $this->input->post('attending')));
					$this->event_model->update_available($this->input->post('event_id'), $data);
					if ($this->input->post('reserve') == 'Reserve' or $this->input->post('book') == 'Book')
						$this->attendants($this->db->insert_id(), $this->input->post('attending'));
					else $this->event_view($event_id);
				} else $this->event_view($event_id);
			} else $this->event_view($event_id);
		}
	}

	function delete()
	{
		$this->ledger_model->delete_record();
		$this->event_view($event_id);
	}


	function attendant_create($ledger_id, $event_id)
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'sex' => strtoupper($this->input->post('sex')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'email' => $this->input->post('email'),
			'country' => $this->input->post('country'),
			'physical_condition_id' => $this->input->post('physical_condition_id'),
			'health_self_description' => $this->input->post('health_self_description'),
			'experience_self_description' => $this->input->post('experience_self_description'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index($event_id);
		} elseif ($this->input->post('add') == "Add") {
			$customer_id = $this->customer_model->add_record($data);
			$this->ledger_model->add_attendant_record($ledger_id, $customer_id, $this->input->post('main_customer'));

			echo "event id = " . $event_id;

			$this->event_view($event_id);
		} else {
			$this->event_view($event_id);
		};
	}

	function attendant_update($customer_id, $ledger_id, $nr_attendants)
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'sex' => strtoupper($this->input->post('sex')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'email' => $this->input->post('email'),
			'physical_condition_id' => $this->input->post('physical_condition_id'),
			'health_self_description' => $this->input->post('health_self_description'),
			'experience_self_description' => $this->input->post('experience_self_description'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->event_view($event_id);
		} elseif ($this->input->post('update') == "Update") {
			$this->customer_model->update_record($data);
			$this->attendants($ledger_id, $nr_attendants);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->customer_model->update_record($data);
			$this->event_view($event_id);
		} else {
			$this->event_view($event_id);
		};
	}

	function reschedule($ledger_id, $activity_id, $event_id, $location_id, $called_from = 1)
	{

		$data['title'] = 'Ledger';
		$data['title_action'] = 'Rescheduling';
		$data['records'] = $this->ledger_model->get_overview_by_date(0, $ledger_id);

		$data['events'] = $this->activity_booking_model->get_booking(0, $activity_id, $location_id);
//echo "<br>events<br>"; 				
//print_r($data['events']);
		$data['locations'] = $this->event_model->get_by_location($activity_id);
		$data['called_from'] = $called_from;
//		$data['event'] = $this->event_model->get_record($event_id);		

//		$data['activity'] = $this->activity_model->get_record($activity_id);		
//echo "<br>activity<br>"; 				
//print_r($data['activity']);

		//	$data['customer'] = $this->customer_model->get_record($customer_id);
//echo "<br>customer<br>"; 				
//print_r($data['customer']);
//die();
		$this->load->view('ledger/reschedule_view', $data);

	}

	function reschedule_booking($called_from)
	{
		$data = array(
			'ledger_id_reschedule' => $this->input->post('ledger_id'),
			'booking_date' => date("Y-m-d H:i:s"),
			'activity_id' => $this->input->post('activity_id'),
			'event_id' => $this->input->post('event_id'),
			'location_id' => $this->input->post('location_id'),
			'customer_id' => $this->input->post('customer_id'),
			'event_group_id' => $this->input->post('event_group_id'),
			'payment_id' => $this->input->post('payment_id'),
			'main_customer' => $this->input->post('main_customer'),
			'attending' => $this->input->post('attending'),
			'status' => $this->input->post('status'),
			'sales_code' => $this->input->post('sales_code'),
			'discount' => $this->input->post('discount'),
			'discount_amount_type' => $this->input->post('discount_amount_type'),
			'cms_type' => $this->input->post('cms_type'),
			'cms_amount' => $this->input->post('cms_amount'),
			'promo_code' => $this->input->post('promo_code'),
			'tax' => $this->input->post('tax'),
			'paid_code' => $this->input->post('paid_code'),
			'price' => $this->input->post('price'),
			'amount_paid' => $this->input->post('amount_paid'),
			'cc_amount' => $this->input->post('cc_amount'),
		);
		$this->ledger_model->add_record($data);

		$new_ledger_id = $this->db->insert_id();
		$old_ledger_id = $this->input->post('ledger_id');
		$new_event_id = $this->input->post('event_id');

//echo "<br>"."old ledger_id= ".$old_ledger_id;	
//echo "<br>"."new ledger_id= ".$new_ledger_id;	
//echo "<br>"."new event_id= ".$new_event_id;	
//old ledger
		$this->db->where('ledger_id', $old_ledger_id);
		$query = $this->db->get('ledger');                    //write back the value
		$row = $query->row();
		$old_event_id = $row->event_id;
//echo "<br>"."old event_id= ".$old_event_id;	
		$data = array('status' => LEDGER_DELETED);
		$this->db->where('ledger_id', $old_ledger_id);
		$this->db->update('ledger', $data);
		$query->free_result();

// old event
		$this->db->where('event_id', $old_event_id);
		$query = $this->db->get('event');                    //write back the value
		$row = $query->row();
//echo "<br>".$old_event_id . " before: ". $row->attending;				
		$data = array('attending' => $row->attending - 1 < 1 ? 0 : $row->attending - 1);
//print_r($data);			
		$this->db->where('event_id', $old_event_id);
		$this->db->update('event', $data);
		$query->free_result();

//			$this->db->where('event_id',$old_event_id );
//			$query = $this->db->get('event');					//write back the value
//			$row = $query->row();		
//echo "<br>".$old_event_id . " after: ". $row->attending;				


// new event
		$query->free_result();
//echo "<br>new event id=".$new_event_id;				
		$this->db->where('event_id', $new_event_id);
		$query = $this->db->get('event');
		$row1 = $query->row();
//echo "<br>".$new_event_id . " before: ". $row->attending;				
		$data = array('attending' => $row1->attending + 1);
		$this->db->where('event_id', $new_event_id);
		$this->db->update('event', $data);
		$query->free_result();


//			$this->db->where('event_id',$new_event_id );
//			$query = $this->db->get('event');					//write back the value
//			$row = $query->row();		
//echo "<br>".$new_event_id . " after: ". $row->attending;				
		redirect($this->session->userdata('back_url'), 'refresh');;

	}

}
