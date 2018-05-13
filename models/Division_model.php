<?php

class Division_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('division');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('division_id', $this->uri->segment(3));
		$query = $this->db->get('division');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('division', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('division_id', $this->uri->segment(3));
		$this->db->update('division', $data);
	}

	function delete_record()
	{
		$this->db->where('division_id', $this->uri->segment(3));
		$this->db->delete('division');
	}

}