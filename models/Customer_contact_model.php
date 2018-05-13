<?php

class Customer_contact_model extends CI_Model
{


	function get_selected_customers($customers_to_mail)
	{
		if ($customers_to_mail) {
			$this->db->select('customer.*, ledger.*');
			$this->db->where_in('ledger_id', $customers_to_mail);
			$this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
			$query = $this->db->get('ledger');
			return $query->result();
		} else
			return "";

	}

	function get_customers_by_event($event_id)
	{
		$this->db->select('customer.*,ledger.*, ledger.status AS ledger_status, customer_questionaire_id,is_questionaire_viewed_by_admin, activity.is_questionaire,discount.name AS discount_name');
		$this->db->where('ledger.paid_code >', '0'); //finished transaction
//			$this->db->where('ledger.status !=', LEDGER_DELETED); //finished transaction
//			$this->db->group_by('customer.email');
		$this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
		$this->db->join('discount', 'ledger.promo_code = discount.promo_code', 'left');
		$this->db->join('activity', 'ledger.activity_id = activity.activity_id', 'left');
		$this->db->join('customer_questionaire', 'customer_questionaire.customer_id = customer.customer_id', 'left');
		$this->db->where("ledger.event_id", $event_id);
		$query = $this->db->get('ledger');
		return $query->result();
	}

	function send_email($event_id, $employee_count)
	{
		for ($i = 1; $i <= $employee_count; $i++) {
			$checked = 'employee_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$employee_id = 'employee_id' . $i;
				$employee_id_val = $this->input->post($employee_id);

//echo "employee_id =	" .	$employee_id . "<br>";
//echo "employee_id_val =	" .	$employee_id_val . "<br>";

				$this->db->query("REPLACE INTO event_to_employee (event_id, employee_id) VALUES ('$event_id','$employee_id_val')");
			};
		};
		return;
	}


	function get_active_customers()
	{
		$this->db->where('ledger.paid_code', TRUE); //finished transaction
		$this->db->where('ledger.status !=', LEDGER_DELETED); //finished transaction
		$this->db->group_by('customer.email');
		$this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
		$query = $this->db->get('ledger');
		return $query->result();
	}

	function get_customer_history($email)
	{
		$query = $this->db
			->select('customer.*,ledger.*, event.date,activity.name')
			->where('customer.email', $email)
//			->where('ledger.status !=', LEDGER_DELETED) //finished transaction
			->where('ledger.paid_code', TRUE)//finished transaction
			->join('ledger', 'ledger.customer_id = customer.customer_id')
			->join('event', 'ledger.event_id = event.event_id')
			->join('activity', 'ledger.activity_id = activity.activity_id')
			->get('customer');
		return $query->result();
	}

	function xget_customer_history($email)
	{
		$query = $this->db
			->select('customer.*,ledger.*, event.date,activity.name')
			->where('ledger.customer_id', $customer_id)
			->where('ledger.status !=', LEDGER_DELETED)//finished transaction
			->where('ledger.paid_code', TRUE)//finished transaction
			->join('customer', 'ledger.customer_id = customer.customer_id', 'right')
			->join('event', 'ledger.event_id = event.event_id', 'right')
			->join('activity', 'ledger.activity_id = activity.activity_id', 'right')
			->get('ledger');
		return $query->result();
	}


	function get_contacts($customer_id)
	{
		$query = $this->db
			->where('customer_contact.customer_id', $customer_id)
			->join('customer_contact_type', 'customer_contact.type_id = customer_contact_type.customer_contact_type_id', 'left')
			->join('employee', 'customer_contact.employee_id = employee.employee_id', 'left')
			->join('mail', 'customer_contact.mail_id = mail.mail_id', 'left')
			->select('
			customer_contact_id,
			entered_at,
			type_id,
			note,
			group,
			customer_contact.mail_id,
			next_contact,
			customer_contact.employee_id,
			customer_contact_type.name,
			contact_of,
			customer_contact.customer_id AS customer_contact_customer_id,
			mail.mail_id,
			mail.body,
			employee.employee_id,
			employee.first_name,
			employee.last_name
			')
			->get('customer_contact');
		$q = $query->result();
		return $q;
	}

	function get_customer_name($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('customer');
		foreach ($query->result() as $row) {
			return trim($row->first_name) . ' ' . trim($row->last_name);
		}
	}

	function get_customer_email($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('customer');
		foreach ($query->result() as $row) {
			return $row->email;
		}
	}

	function get_customer_emails($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('mail');
		return $query->result();
	}

	function get_record($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('customer');
		return $query->result();
	}

	function get_contact($customer_contact_id)
	{
		$this->db->where('customer_contact_id', $customer_contact_id);
		$this->db->join('mail', 'customer_contact.mail_id = mail.mail_id', 'left');
		$this->db->select('
			customer_contact_id,
			entered_at,
			type_id,
			note,
			group,
			customer_contact.mail_id,
			next_contact,
			customer_contact.employee_id,
			contact_of,
			customer_contact.customer_id AS customer_contact_customer_id,
			mail.mail_id,
			mail.body
			');
		$query = $this->db->get('customer_contact');
		$q = $query->result();
		return $q;
	}

	function add_record($data)
	{
		$this->db->insert('customer_contact', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('customer_contact_id', $this->uri->segment(3));
		$this->db->update('customer_contact', $data);
	}

	function delete_record()
	{
		$this->db->where('customer_contact_id', $this->uri->segment(3));
		$this->db->delete('customer_contact');
	}


}