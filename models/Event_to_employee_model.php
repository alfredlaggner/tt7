<?php

class Event_to_employee_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('event_to_employee');
		return $query->result();
	}

	function get_event_to_employee_records($event_id)
	{
		$this->db->select('*');
		$this->db->from('event_to_employee');
		$this->db->where('event_id', $event_id);
		$this->db->join('employee', 'employee.employee_id = event_to_employee.employee_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_employee_records($event_id)
	{
		$this->db->where('event_id', $event_id);
		$query = $this->db->get('employee');
		return $query->result();
	}

	function get_employee_string($event_id)
	{
		$employees_string = '';
		$this->db->select('*');
		$this->db->from('event_to_employee');
		$this->db->where('event_id', $event_id);
		$this->db->join('employee', 'employee.employee_id = event_to_employee.employee_id');
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


	function get_record($event_id)
	{
		$this->db->where('event_id', $event_id);
		$query = $this->db->get('event_to_employee');
		return $query->result();
	}

	function add_record($event_id, $employee_count)
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

	function update_record($data)
	{
		$this->db->where('event_id', $this->uri->segment(3));
		$this->db->update('event_to_employee', $data);
	}

	function delete_record($event_id, $employee_id)
	{
		$this->db->where('event_id', $event_id);
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('event_to_employee');
	}

	function delete_employee_records($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('event_to_employee');
	}

	function delete_event_records($event_id)
	{
		$this->db->where('event_id', $event_id);
		$this->db->delete('event_to_employee');
	}
}