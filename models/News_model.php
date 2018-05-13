<?php

class News_model extends CI_Model
{

	function get_records($news_group_id = 0)
	{
		if ($news_group_id)
			$this->db->where('news.news_group_id', $news_group_id);

		$this->db->order_by('code', 'asc');
		$this->db->join('account', 'news.account_id = account.account_id', 'left');
		$query = $this->db->get('news');
		return $query->result();
	}

	function count_all()
	{
		return $this->db->count_all('news');
	}


	function get_record($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news');
		return $query->result();
	}

	function get_news_name($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news');

		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_news_description_short($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news');

		foreach ($query->result() as $row) {
			return $row->description_short;
		}
	}

	function get_news_code($news_id)
	{
		$this->db->where('news_id', $news_id);
		$query = $this->db->get('news');

		foreach ($query->result() as $row) {
			return $row->code;
		}
	}

	function add_record($data)
	{
		$this->db->insert('news', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('news_id', $this->uri->segment(3));
		$this->db->update('news', $data);
	}

	function delete_record()
	{
		$this->db->where('news_id', $this->uri->segment(3));
		$this->db->delete('news');
	}

}