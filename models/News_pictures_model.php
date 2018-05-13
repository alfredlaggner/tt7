<?php

class News_pictures_model extends CI_Model
{

	function get_records($news_id)
	{
		$query = $this->db
			->where('news_id', $news_id)
			->get('news_pictures');

		return $query->result();
	}

	function get_record()
	{
		$this->db->where('news_pictures_id', $this->uri->segment(3));
		$query = $this->db->get('news_pictures');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('news_pictures', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('news_picture_id', $this->uri->segment(3));
		$this->db->update('news_pictures', $data);
	}

	function delete_record()
	{
		$this->db->where('news_picture_id', $this->uri->segment(3));
		$this->db->delete('news_pictures');
	}

}