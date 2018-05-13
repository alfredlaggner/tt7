<?php

class Template_model extends CI_Model
{

	function get_records($activity_id = 0)
	{
		if ($activity_id) $this->db->where('template.activity_id', $activity_id);

		$this->db->select('template.*,activity.*,activity.activity_id AS activity_id, template.name AS template_name, template.is_active AS template_active');
		$this->db->join('activity', 'template.activity_id = activity.activity_id');
		$this->db->order_by('activity.order', 'ASC');
		$query = $this->db->get('template');
//print_r($query->result());		
		return $query->result();
	}

	function count_all()
	{
		return $this->db->count_all('template');
	}

	function get_template_name($template_id)
	{
		$this->db->where('template_id', $template_id);
		$query = $this->db->get('template');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_record($template_id = 0)
	{

		if ($template_id)
			$this->db->where('template_id', $template_id);
		else
			$this->db->where('template_id', $this->uri->segment(3));

		$query = $this->db->get('template');
		return $query->result();
	}

	function get_confirmation_email()
	{
		$this->db->where('is_confirmation', TRUE);
		$this->db->where('is_active', TRUE);

		$query = $this->db->get('template');
		return $query->result();
	}

	function send_reminder_emails()
	{

		$this->db->select('event.date, ledger.*,ledger.activity_id as  ledger_activity_id,customer.*,ledger.*,template.*');
		$this->db->where('ledger.paid_code ', TRUE);
		$this->db->where('template.is_active ', TRUE);
		$this->db->where('template.is_automated ', TRUE);
		//	$this->db->where('ledger.is_automated_sent ', FALSE);
		$this->db->where("event.date > ", date("Y-m-d", strtotime("now")));
		$this->db->where("event.date <= ", date("Y-m-d", strtotime("+1 week")));
		$this->db->join('event', 'ledger.event_id = event.event_id', 'right');
		$this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
		$this->db->join('template', 'ledger.activity_id = template.activity_id', 'right');
		$query = $this->db->get('ledger');

		return $query->result();
	}

	function get_record_sample()
	{
		$this->db->where('template_id', $this->uri->segment(3));
		$query = $this->db->get('template');
		return $query->result();
	}

	function get_template($activity_id) // rework
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->limit(1);
		$query = $this->db->get('activity');
		foreach ($query->result() as $row) {
			$template_id = $row->template_id;
		}
		$this->db->where('template_id', $template_id);
		$query = $this->db->get('template');
		return $query->result();
	}


	function add_record($data)
	{
		$this->db->insert('template', $data);
		return;
	}

	function update_record($data, $template_id = 0)
	{

		if ($template_id)
			$this->db->where('template_id', $template_id);
		else
			$this->db->where('template_id', $this->uri->segment(3));

		$this->db->update('template', $data);
	}

	function delete_record()
	{
		$this->db->where('template_id', $this->uri->segment(3));
		$this->db->delete('template');
	}

	function save_original_message($mail_data)
	{

		foreach ($mail_data as $row) {
//print_r($mail_data);
			$save_mail = array(
				'body' => $row->body,
				'subject' => $row->subject
			);
			$this->session->set_userdata($save_mail);
		}
	}
//	function print_r3($val){
//        echo '<pre>';
//        print_r($val);
//        echo  '</pre>';
//}


	function substitute_text($text_in, $customer_id, $event_id = 0)
	{
		if (!$event_id)
			$event_id = $this->session->userdata('event_id');
//print_r2($event_id);

		$events = $this->event_model->get_record($event_id);
//$this->print_r3($events);		
//			$template_id = $this->uri->segment(3);
		foreach ($events as $event) {

			$activity_name = $event->activity_name;
			$location_name = $event->location_name;
			$directions = $event->location_directions;
//echo 'directions for ' .$location_name . ': ' .$event->location_directions;			
//print_r2($event->location_id);

			$event_date = $event->date;
			$event_time = $event->time;
			$event_duration = $event->duration;
		}
		$customer_data = $this->customer_contact_model->get_record($customer_id);
		foreach ($customer_data as $row) {
			$first_name = $row->first_name;
			$last_name = $row->last_name;
			$email = $row->email;
		}
		$ledger_data = $this->ledger_model->get_record_by_event_customer($event_id, $customer_id);
		foreach ($ledger_data as $ledger) {
			$price = $ledger->price;
			$invoice_nr = $ledger->event_group_id;
		}

		$vars = array(
			"{to_expect}" => $event->to_expect,
			"{we_provide}" => $event->we_provide,
			"{you_bring}" => $event->they_bring,
			"{map}" => $event->map_link,
			"{first_name}" => $first_name,
			"{last_name}" => $last_name,
			"{activity}" => $activity_name,
			"{location}" => $location_name,
			"{directions}" => $directions,
			"{event_date}" => date("F jS  Y ", strtotime($event_date)),
			"{event_time}" => date("g:i a", strtotime($event_time)),
			"{price}" => $ledger->price,
			"{invoice_number}" => $ledger->event_group_id,
			"{event_date_to}" => date("F jS  Y ", strtotime($event_date) + $event_duration * 3600)

		);
		/* additional placeholders needed for confirmation email
		{Invoice Number} => $ledger->event_group_id,
		{Price} => $ledger->price'
		{Invoice Number} => $ldeger->event_group_id,
		"{event_date_to}" => date("F jS  Y ",strtotime($event_date) + $activity_duration * 3600)),

		*/


//		return strip_tags(strtr($text_in, $vars),'<p><title><br><br /><iframe>');
		return strtr($text_in, $vars);
	}

	function get_place_holders_text()
	{
		return
			"{first_name}  " .
			"{last_name}  " .
			"{activity}  " .
			"{location}  " .
			"{directions}  " .
			"{event_date}  " .
			"{event_time}  " .
			"{to_expect} " .
			"{we_provide} " .
			"{price} " .
			"{invoice_number} " .
			"{event_date_to} " .
			"{you_bring}";
	}

}