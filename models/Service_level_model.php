<?php

class Service_level_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('level', 'asc');
		$query = $this->db->get('service_level');
		return $query->result();
	}

	function get_records_list()
	{
		$this->db->order_by('level', 'asc');
		$query = $this->db->get('service_level');
		$list = '';
		foreach ($query->result() as $row) {
			$list = $list . $row->name . '<br>';
		}
		return $list;
	}

	function get_record()
	{
		$this->db->where('service_level_id', $this->uri->segment(3));
		$query = $this->db->get('service_level');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('service_level', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('service_level_id', $this->uri->segment(3));
		$this->db->update('service_level', $data);
	}

	function delete_record()
	{
		$this->db->where('service_level_id', $this->uri->segment(3));
		$this->db->delete('service_level');
	}

}