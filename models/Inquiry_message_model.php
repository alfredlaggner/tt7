<?php

class Inquiry_message_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('inquiry_message');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('inquiry_message_id', $this->uri->segment(3));
		$query = $this->db->get('inquiry_message');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('inquiry_message', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('inquiry_message_id', $this->uri->segment(3));
		$this->db->update('inquiry_message', $data);
	}

	function delete_record()
	{
		$this->db->where('inquiry_message_id', $this->uri->segment(3));
		$this->db->delete('inquiry_message');
	}

}