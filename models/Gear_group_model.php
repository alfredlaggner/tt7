<?php

class Gear_group_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('gear_group');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('gear_group_id', $this->uri->segment(3));
		$query = $this->db->get('gear_group');
		return $query->result();
	}

//	function get_gear_group_name()
//	{
//		$this->db->where('gear_group_id', $this->uri->segment(3));
//		$query = $this->db->get('gear_group');
//		return $query->result();
//	}
	function get_gear_group_name($gear_group_id)
	{
		$this->db->where('gear_group_id', $gear_group_id);
		$query = $this->db->get('gear_group');
		return $query->row()->name;
	}

	function add_record($data)
	{
		$this->db->insert('gear_group', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('gear_group_id', $this->uri->segment(3));
		$this->db->update('gear_group', $data);
	}

	function delete_record()
	{
		$this->db->where('gear_group_id', $this->uri->segment(3));
		$this->db->delete('gear_group');
	}

}