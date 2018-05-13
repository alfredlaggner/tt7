<?php

class Geostates_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('geo_states');
		$states = [];
		foreach ($query->result() as $row) {

			$states[] = $row->name;
		}
		return $states;

	}

	function add_record($data)
	{
		$this->db->insert('geo_states', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('name', $this->uri->segment(3));
		$this->db->update('geo_states', $data);
	}

	function delete_record()
	{
		$this->db->where('geo_state_id', $this->uri->segment(3));
		$this->db->delete('geo_states');
	}

}