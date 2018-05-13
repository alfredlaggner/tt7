<?php

class News_related_model extends CI_Model
{

	function get_records($news_id = 0)
	{
		if ($news_id) $this->db->where('news_id', $news_id);

		$this->db->order_by('news_id', 'asc');
		$query = $this->db->get('news_related');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('news_related_id', $this->uri->segment(3));
		$query = $this->db->get('news_related');
		return $query->result();
	}

	function add_record($news_id, $news_count)
	{
		for ($i = 1; $i <= $news_count; $i++) {
			$checked = 'news_related_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$news_related_id = 'news_related_id' . $i;
				$news_related_id_val = $this->input->post($news_related_id);

//echo "news_related_id =	" .	$news_related_id . "<br>";
//echo "news_related_id_val =	" .	$news_related_id_val . "<br>";

				$this->db->query("REPLACE INTO news_related (news_id, news_related_id) VALUES ('$news_id','$news_related_id_val')");
			};
		};
		return;
	}


	function xadd_record($news_id)
	{
		$this->db->order_by('news_id', 'asc');
		$query = $this->db->get('news');
		$i = 1;
		foreach ($query->result() As $row) {
			if (isset($_POST['news_related_id' . $i])) {
				echo '<br>' . $row->name;
				echo '<br>i= ' . $i;
				echo '<br>news_id= ' . $row->news_id;
				$data = array(
					'news_related_id' => $row->news_id,
					'news_id' => $news_id);
				$this->db->insert('news_related', $data);
			};
			$i++;
		}
		return;
	}


	function xxxadd_record($data)
	{
		$this->db->insert('news_related', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('news_related_id', $this->uri->segment(3));
		$this->db->update('news_related', $data);
	}

	function delete_record($news_id)
	{

		$this->db->where('news_id', $news_id);
		$this->db->delete('news_related');
	}

	function get_related_newss($news_id)
	{
		$this->db->select('
			news_related.*,
			news.*, 
			news_pictures.*, 
			news_group.name AS news_group_name
			');
		$this->db->where('news_related.news_id', $news_id);
		$this->db->join('news', 'news.news_id=news_related.news_related_id');
		$this->db->join('news_group', 'news.news_group_id=news_group.news_group_id');
		$this->db->join('news_pictures', 'news_pictures.news_id = news.news_id', 'left');
		$this->db->group_by('news.news_id'); //new	
		$query = $this->db->get('news_related');
		return $query->result();

	}


}