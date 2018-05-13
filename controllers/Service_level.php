<?php

class Service_level extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->service_level_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Service Levels';
		$data['title_action'] = 'Manage Service Levels';
		$data['top_note'] = 'Enter the level of service here';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/service_level_view', $data);
	}

	function create()
	{
		$data = array(
			'level' => $this->input->post('level'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->service_level_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'level' => $this->input->post('level'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->service_level_model->delete_record();
		} else {
			$this->service_level_model->update_record($data);
		}
		$this->index();
	}
}
