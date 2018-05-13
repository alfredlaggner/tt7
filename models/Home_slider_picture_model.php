<?php

class home_slider_picture_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('home_slider_picture');
		return $query->result();
	}

	function get_record($home_slider_id)
	{
		$this->db->where('home_slider_picture_id', $home_slider_id);
		$query = $this->db->get('home_slider_picture');
		return $query->result();
	}

	function get_home_slider_picture_name()
	{
		$this->db->where('home_slider_picture_id', $this->uri->segment(3));
		$query = $this->db->get('home_slider_picture');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('home_slider_picture', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('home_slider_picture_id', $this->uri->segment(3));
		$this->db->update('home_slider_picture', $data);
	}

	function delete_record()
	{
		$this->db->where('home_slider_picture_id', $this->uri->segment(3));
		$this->db->delete('home_slider_picture');
	}

}