<?php

class Division extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->division_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Divisions';
		$data['title_action'] = 'Manage Divisions';
		$data['top_note'] = 'Enter divisions';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/division_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->division_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->division_model->delete_record();
		} else {
			$this->division_model->update_record($data);
		}
		$this->index();
	}
}
