<?php

class Employee_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('employee');
		return $query->result();
	}

	function get_guides()
	{
		$this->db->order_by('order', 'asc');
		$this->db->where('is_published', TRUE);
		$query = $this->db->get('employee');
		return $query->result();
	}

	function get_employee_name($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$query = $this->db->get('employee');
		foreach ($query->result() as $row) {
			return $row->first_name . ' ' . $row->last_name;
		}
	}

	function count_all()
	{
		return $this->db->count_all('employee');
	}

	function get_record($employee_id = 0)
	{
		if ($employee_id)
			$this->db->where('employee_id', $employee_id);
		else
			$this->db->where('employee_id', $this->uri->segment(3));

		$query = $this->db->get('employee');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('employee', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('employee_id', $this->uri->segment(3));
		$this->db->update('employee', $data);
	}

	function delete_record()
	{
		$this->event_to_employee_model->delete_employee_records($this->uri->segment(3));
		$this->db->where('employee_id', $this->uri->segment(3));
		$this->db->delete('employee');
	}
}