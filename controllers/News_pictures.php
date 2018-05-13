<?php

class News_pictures extends Common_Auth_Controller
{
	function index($news_picture_id = 0, $news_id = 0, $folder = '')
	{
		$data = array();
		if ($query = $this->news_pictures_model->get_records($news_id)) {
			$data['records'] = $query;
		}
		$data['title'] = 'news Pictures';
		$data['title_action'] = 'Manage news Pictures';
		$data['top_note'] = 'Enter the pictures for this news';
		$data['bottom_note'] = '';
		$data['folder'] = $folder;
		$data['news_id'] = $news_id;
		$data['news_picture_id'] = $news_picture_id;

		$this->load->view('tables/news_pictures_view', $data);
	}

	function create()
	{
		$data = array(
			'news_id' => $this->input->post('news_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		$this->news_pictures_model->add_record($data);
		$news_picture_id = $this->db->insert_id();
		$this->index($news_picture_id, $this->input->post('news_id'), $this->input->post('folder'));
	}

	function update($news_picture_id)
	{
		$data = array(
			'news_id' => $this->input->post('news_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->news_pictures_model->delete_record();
		} else {
			$this->news_pictures_model->update_record($data);
		}
		$this->index($this->input->post('news_picture_id'), $this->input->post('news_id'), $this->input->post('folder'));
	}
}
