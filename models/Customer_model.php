<?php

class Customer_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('first_name', 'asc');
		$query = $this->db->get('customer');
		return $query->result();
	}

	function get_customer_name($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get('customer');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function count_all()
	{
		return $this->db->count_all('customer');
	}

	function get_record($customer_id = 0)
	{
		if ($customer_id)
			$this->db->where('customer_id', $customer_id);
		else
			$this->db->where('customer_id', $this->uri->segment(3));

		$query = $this->db->get('customer');
		return $query->result();
	}

	function get_questionaire_record($customer_id = 0)
	{
		if ($customer_id)
			$this->db->where('customer_id', $customer_id);
		else
			$this->db->where('customer_id', $this->uri->segment(3));

		$query = $this->db->get('customer_questionaire');
		return $query->result();
	}
	function get_questionaire_id($customer_id = 0)
	{
		$query = $this->db->get('customer_questionaire');
		foreach ($query->result() as $row)
		{ $questionaire_id = $row->customer_questionaire_id;}
		return $questionaire_id;
	}

	function add_record($data)
	{
		$this->db->insert('customer', $data);
		return $this->db->insert_id();
	}

	function update_record($data)
	{
		$this->db->where('customer_id', $this->uri->segment(3));
		$this->db->update('customer', $data);
	}

	function delete_record()
	{
		$this->db->where('customer_id', $this->uri->segment(3));
		$this->db->delete('customer');
	}

	function add_health_record($data)
	{
		$this->db->insert('customer_questionaire', $data);
	}

	function update_health_record($customer_questionaire_id, $data)
	{
//		echo 'questionaire_id = ' . $customer_questionaire_id;
		$this->db->where('customer_questionaire_id', $customer_questionaire_id);
		return ($this->db->update('customer_questionaire', $data));
	}

	function delete_health_record()
	{
		$this->db->where('customer_questionaire', $this->uri->segment(3));
		$this->db->delete('customer_questionaire');
	}

	function update_checked_questionaire($customer_id, $event_id, $data)
	{
		//	echo $customer_id; echo $event_id; print_r2($data);

		$this->db->where('customer_id', $customer_id);
		//$this->db->where('event_id', $event_id);
		$query = $this->db->get('ledger');
		print_r2($query->result());
		//if ($this->db->update('ledger', $data)) echo 'success';
	}

	function states()
	{
		$states = array(
			'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
		);
		return $states;
	}

	function birthday($birthday)
	{
		if (!$birthday = '0000-00-00') {
			list($year, $month, $day) = explode("-", $birthday);
			$year_diff = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff = date("d") - $day;
			if ($month_diff < 0) $year_diff--;
			elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
			return $year_diff;
		} else {
			return '';
		}
	}
}