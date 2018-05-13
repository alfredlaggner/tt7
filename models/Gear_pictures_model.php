<?php

class Gear_pictures_model extends CI_Model
{

	function get_records($gear_id)
	{
		$query = $this->db
			->where('gear_id', $gear_id)
			->get('gear_pictures');

		return $query->result();
	}

	function get_record()
	{
		$this->db->where('gear_pictures_id', $this->uri->segment(3));
		$query = $this->db->get('gear_pictures');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('gear_pictures', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('gear_picture_id', $this->uri->segment(3));
		$this->db->update('gear_pictures', $data);
	}

	function delete_record()
	{
		$this->db->where('gear_picture_id', $this->uri->segment(3));
		$this->db->delete('gear_pictures');
	}

}