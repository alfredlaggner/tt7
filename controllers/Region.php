<?php

class Region extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->region_model->get_records()) {
			$data['title'] = 'Regions';
			$data['title_action'] = 'Manage Regions';
			$data['top_note'] = 'List of your regions.';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->parser->parse('region/region_over_view', $data);
		} else {

			$this->region_create();
		}
	}

	function region_view()
	{
		$data['title'] = 'Region';
		$data['title_action'] = 'Edit Region';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->region_model->get_record();
		$this->load->view('region/region_view', $data);
	}

	function region_create()
	{
		$data['title'] = 'New Region';
		$data['title_action'] = 'Create Region';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$this->load->view('region/region_create_view', $data);
	}

	function create()
	{
		$data = array(
			'region' => $this->input->post('region'),
		);

		$this->region_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'region' => $this->input->post('region'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->region_model->delete_record();
		} else {
			$this->region_model->update_record($data);
		}
		$this->index();
	}

	function delete()
	{
		$this->region_model->delete_record();
		$this->index();
	}

}
