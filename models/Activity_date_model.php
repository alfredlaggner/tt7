<?php

class Activity_date_model extends CI_Model
{

	function xxget_records()
	{
		$query = $this->db->get('activity_date');
		return $query->result();
	}

	function get_records($activity_id)
	{
		$this->db->order_by('date', 'desc');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity_date');
		return $query->result();
	}

	function get_initials($activity_id)
	{
		$initials = array();
		$this->db->order_by('date');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity_date');
		foreach ($query->result() as $row) {
			$initials .= $this->activity_date_to_employee_model->get_employee_string($row->activity_date_id);
		}
		return $initials;
	}

	function get_record($activity_date_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$query = $this->db->get('activity_date');
		return $query->result();
	}

	function get_activity_date_instructor($activity_date_id)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$query = $this->db->get('activity_date');
		foreach ($query->result() as $row) {
			return $row->instructor_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('activity_date', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_date_id', $this->uri->segment(3));
		$this->db->update('activity_date', $data);
	}

	function update_available($activity_date_id, $data)
	{
		$this->db->where('activity_date_id', $activity_date_id);
		$this->db->update('activity_date', $data);
	}

	function delete_record()
	{
		$this->db->where('activity_date_id', $this->uri->segment(3));
		$this->db->delete('activity_date');
	}

}