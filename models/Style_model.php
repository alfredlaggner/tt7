<?php

class Style_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('style');
		return $query->result();
	}

	function get_records_list()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('style');
		$style_list = '';
		foreach ($query->result() as $row) {
			$style_list = $style_list . $row->name . '<br>';
		}
		return $style_list;
	}

	function get_front_page_styles()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('style');
		$style_array = [];
		$style_array[] = ['id' => 0, 'order' => 0, 'name' => 'All Classes', 'slogan' => 'If you carry adventure in your heart, you landed in the right place', 'description' => 'Backpacking <br> Rock Climbing  <br>Survival Training', 'picture' => 'nature1.jpg'];
		foreach ($query->result() as $row) {
			if ($row->is_active) {
				$style_array[] = ['id' => $row->style_id, 'order' => $row->order, 'name' => $row->name, 'slogan' => $row->slogan, 'description' => $row->description, 'picture' => $row->carousel_picture];
			}
		}
		//      print_r2($style_array); die();
		return $style_array;
	}

	function get_record()
	{
		$this->db->where('style_id', $this->uri->segment(3));
		$query = $this->db->get('style');
		return $query->result();
	}

	function get_style_name()
	{
		$this->db->where('style_id', $this->uri->segment(3));
		$query = $this->db->get('style');
		return $query->result();
	}

	function get_style_name2($style_id)
	{
		$this->db->where('style_id', $style_id);
		$query = $this->db->get('style');
		return $query->row()->name;
	}

	function add_record($data)
	{
		$this->db->insert('style', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('style_id', $this->uri->segment(3));
		$this->db->update('style', $data);
	}

	function delete_record()
	{
		$this->db->where('style_id', $this->uri->segment(3));
		$this->db->delete('style');
	}

}