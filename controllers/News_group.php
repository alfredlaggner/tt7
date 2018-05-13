<?php

class News_group extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->news_group_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'news Groups';
		$data['title_action'] = 'Manage news groups';
		$data['top_note'] = '';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '';

		$this->load->view('tables/news_group_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		$this->news_group_model->add_record($data);
		redirect('news_group');
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->news_group_model->delete_record();
		} else {
			$this->news_group_model->update_record($data);
		}
//		$this->index();
		redirect('news_group');
	}
}
