<?php

class Inquiry_message extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->inquiry_message_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Inquiry Messages';
		$data['title_action'] = 'Manage Inquiry Messages';
		$data['top_note'] = 'Enter standardized email texts for inquires';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/inquiry_message_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->inquiry_message_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->inquiry_message_model->delete_record();
		} else {
			$this->inquiry_message_model->update_record($data);
		}
		$this->index();
	}
}
