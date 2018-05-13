<?php

class Region_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('region');
		return $query->result();
	}

	function get_records_not_all_records()
	{
		$this->db->where('region_id >', '0');
		$query = $this->db->get('region');
		return $query->result();
	}

	function get_region_name($region_id)
	{
		$this->db->where('region_id', $region_id);
		$query = $this->db->get('region');
		foreach ($query->result() as $row) {
			return $row->region;
		}
	}

	function count_all()
	{
		return $this->db->count_all('region');
	}

	function get_record()
	{
		$this->db->where('region_id', $this->uri->segment(3));
		$query = $this->db->get('region');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('region', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('region_id', $this->uri->segment(3));
		$this->db->update('region', $data);
	}

	function delete_record()
	{
		$this->db->where('region_id', $this->uri->segment(3));
		$this->db->delete('region');
	}

}