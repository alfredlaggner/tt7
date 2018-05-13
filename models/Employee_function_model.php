<?php

class Employee_function_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('short', 'asc');
		$query = $this->db->get('employee_function');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('employee_function', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('employee_function_id', $this->uri->segment(3));
		$this->db->update('employee_function', $data);
	}

	function delete_record()
	{
		$this->db->where('employee_function_id', $this->uri->segment(3));
		$this->db->delete('employee_function');
	}

}