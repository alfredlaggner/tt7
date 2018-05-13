<?php

class News_group_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('news_group');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('news_group_id', $this->uri->segment(3));
		$query = $this->db->get('news_group');
		return $query->result();
	}

//	function get_news_group_name()
//	{
//		$this->db->where('news_group_id', $this->uri->segment(3));
//		$query = $this->db->get('news_group');
//		return $query->result();
//	}
	function get_news_group_name($news_group_id)
	{
		if ($news_group_id) {
			$this->db->where('news_group_id', $news_group_id);
			$query = $this->db->get('news_group');
			return $query->row()->name;
		} else return "no group";
	}

	function add_record($data)
	{
		$this->db->insert('news_group', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('news_group_id', $this->uri->segment(3));
		$this->db->update('news_group', $data);
	}

	function delete_record()
	{
		$this->db->where('news_group_id', $this->uri->segment(3));
		$this->db->delete('news_group');
	}

}