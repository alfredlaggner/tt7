<?php

class Activity_date_to_employee_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('activity_date_to_employee');
		return $query->result();
	}

	function get_activity_date_to_employee_records($activity_date_id)
	{
		$this->db->select('*');
		$this->db->from('activity_date_to_employee');
		$this->db->where('activity_date_id', $activity_date_id);
		$this->db->join('employee', 'employee.employee_id = activity_date_to_employee.employee_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_employee_records($activity_date_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$query = $this->db->get('employee');
		return $query->result();
	}

	function get_employee_string($activity_date_id)
	{
		$employees_string = '';
		$this->db->select('*');
		$this->db->from('activity_date_to_employee');
		$this->db->where('activity_date_id', $activity_date_id);
		$this->db->join('employee', 'employee.employee_id = activity_date_to_employee.employee_id');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$employees_string .= $row->initials . ' ';
		}
		if (!$employees_string)
			$employees_string = "n/a";
		else
			substr($employees_string, 0, -2);

		return $employees_string;
	}


	function get_record($activity_date_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$query = $this->db->get('activity_date_to_employee');
		return $query->result();
	}

	function add_record($activity_date_id, $employee_count)
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

				$this->db->query("REPLACE INTO activity_date_to_employee (activity_date_id, employee_id) VALUES ('$activity_date_id','$employee_id_val')");
			};
		};
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_date_id', $this->uri->segment(3));
		$this->db->update('activity_date_to_employee', $data);
	}

	function delete_record($activity_date_id, $employee_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('activity_date_to_employee');
	}

	function delete_employee_records($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('activity_date_to_employee');
	}

	function delete_activity_date_records($activity_date_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$this->db->delete('activity_date_to_employee');
	}
}