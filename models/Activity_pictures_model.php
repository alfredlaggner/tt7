<?php

class Activity_pictures_model extends CI_Model
{

	function get_records($activity_id)
	{
		$query = $this->db
			->where('activity_id', $activity_id)
			->get('activity_pictures');

		return $query->result();
	}

	function get_record()
	{
		$this->db->where('activity_pictures_id', $this->uri->segment(3));
		$query = $this->db->get('activity_pictures');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('activity_pictures', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_picture_id', $this->uri->segment(3));
		$this->db->update('activity_pictures', $data);
	}

	function delete_record()
	{
		$this->db->where('activity_picture_id', $this->uri->segment(3));
		$this->db->delete('activity_pictures');
	}

}