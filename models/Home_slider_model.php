<?php

class Home_slider_model extends CI_Model
{

	function get_records($from_front_end = FALSE)
	{
		$this->db->select('
		home_slider.*,
		home_slider.home_slider_id AS home_slider_home_slider_id,
		home_slider_picture.*');
		$this->db->join('home_slider_picture', 'home_slider_picture.home_slider_id = home_slider.home_slider_id', 'left');

		if ($from_front_end)
			$this->db->where('is_active', TRUE);

		$this->db->order_by('order', 'asc');
		$query = $this->db->get('home_slider');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('home_slider_id', $this->uri->segment(3));
		$query = $this->db->get('home_slider');
		return $query->result();
	}

	function get_home_slider_name($home_slider_id)
	{
		$this->db->where('home_slider_id', $home_slider_id);
		$query = $this->db->get('home_slider');
		foreach ($query->result() AS $row)
			$name = $row->name;
		return $name;
	}

	function add_record($data)
	{
		$this->db->insert('home_slider', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('home_slider_id', $this->uri->segment(3));
		$this->db->update('home_slider', $data);
	}

	function delete_record()
	{
		$this->db->where('home_slider_id', $this->uri->segment(3));
		$this->db->delete('home_slider');
	}

}