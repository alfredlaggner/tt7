<?php

class Account_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('priority', 'asc');
		$query = $this->db->get('account');
		return $query->result();
	}

	function get_account_name($account_id)
	{
		$this->db->where('account_id', $account_id);
		$query = $this->db->get('account');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function count_all()
	{
		return $this->db->count_all('account');
	}

	function get_record($account_id = 0)
	{
		if ($account_id)
			$this->db->where('account_id', $account_id);
		else
			$this->db->where('account_id', $this->uri->segment(3));

		$query = $this->db->get('account');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('account', $data);
		return $this->db->insert_id();
	}

	function update_record($data)
	{
		$this->db->where('account_id', $this->uri->segment(3));
		$this->db->update('account', $data);
	}

	function delete_record()
	{
		$this->db->where('account_id', $this->uri->segment(3));
		$this->db->delete('account');
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
		list($year, $month, $day) = explode("-", $birthday);
		$year_diff = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
		return $year_diff;
	}
}