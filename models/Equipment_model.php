<?php

class Equipment_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('equipment');
		return $query->result();
	}

	function get_equipment_name($equipment_id)
	{
		$this->db->where('equipment_id', $equipment_id);
		$query = $this->db->get('equipment');
		foreach ($query->result() as $row) {
			return $row->equipment;
		}
	}

	function get_record()
	{
		$this->db->where('equipment_id', $this->uri->segment(3));
		$query = $this->db->get('equipment');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('equipment', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('equipment_id', $this->uri->segment(3));
		$this->db->update('equipment', $data);
	}

	function delete_record()
	{
		$this->db->where('equipment_id', $this->uri->segment(3));
		$this->db->delete('equipment');
	}

	function get_equipment($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->limit(1);
		$query = $this->db->get('activity');
		$equipment_id = 0;
		foreach ($query->result() as $row) {
			$equipment_id = $row->equipment_id;
		}
		$this->db->where('equipment_id', $equipment_id);
		$query = $this->db->get('equipment');
		return $query->result();
	}

}