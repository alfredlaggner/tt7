<?php

class Coordinates_model extends CI_Model
{

	function get_records($location_id)
	{
		$this->db->where('location_id', $location_id);
		$query = $this->db->get('coordinates');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('coordinates_id', $this->uri->segment(3));
		$query = $this->db->get('coordinates');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('coordinates', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('coordinates_id', $this->uri->segment(3));
		$this->db->update('coordinates', $data);
	}

	function delete_record()
	{
		$this->db->where('coordinates_id', $this->uri->segment(3));
		$this->db->delete('coordinates');
	}

	function delete_records($location_id)
	{
		$this->db->where('location_id', $location_id);
		$this->db->delete('coordinates');
	}

}