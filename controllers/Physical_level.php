<?php

class Physical_level extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->physical_level_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Physical Level';
		$data['title_action'] = 'Manage Physical Levels';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['top_note'] = 'Enter the level of physical demand here';
		$data['bottom_note'] = '';

		$this->load->view('tables/physical_level_view', $data);
	}

	function create()
	{
		$data = array(
			'level' => $this->input->post('level'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->physical_level_model->add_record($data);
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
			$this->physical_level_model->delete_record();
		} else {
			$this->physical_level_model->update_record($data);
		}
		$this->index();
	}
}
