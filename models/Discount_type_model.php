<?php

class Discount_type_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('type', 'asc');
		$query = $this->db->get('discount_type');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('discount_type_id', $this->uri->segment(3));
		$query = $this->db->get('discount_type');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('discount_type', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('discount_type_id', $this->uri->segment(3));
		$this->db->update('discount_type', $data);
	}

	function delete_record()
	{
		$this->db->where('discount_type_id', $this->uri->segment(3));
		$this->db->delete('discount_type');
	}

}