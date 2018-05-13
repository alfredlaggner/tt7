<?php

class Location extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->location_model->get_records()) {
			$data['title'] = 'Locations';
			$data['title_action'] = 'Manage Locations';
			$data['top_note'] = 'List of your event locations.';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
//print_r2($data['records']); die();
			$data['regions'] = $this->region_model->get_records();
			$this->parser->parse('location/location_over_view', $data);
		} else {

			$this->location_create();
		}
	}

	function location_view()
	{
		$data['title'] = 'Location';
		$data['title_action'] = 'Edit Location';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->location_model->get_record();
		$data['regions'] = $this->region_model->get_records();
		$this->load->view('location/location_view', $data);
	}

	function location_create()
	{
		$data['title'] = 'New Location';
		$data['title_action'] = 'Create Location';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['regions'] = $this->region_model->get_records();
		$this->load->view('location/location_create_view', $data);
	}

	function create()
	{
		$data = array(
			'code' => $this->input->post('code'),
			'name' => $this->input->post('name'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'region_id' => $this->input->post('region_id'),
			'address' => $this->input->post('address'),
			'country' => $this->input->post('country'),
			'continent' => $this->input->post('continent'),
			'directions' => $this->input->post('directions'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'map_link' => $this->input->post('map_link')
		);

		$this->location_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'code' => $this->input->post('code'),
			'name' => $this->input->post('name'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'region_id' => $this->input->post('region_id'),
			'address' => $this->input->post('address'),
			'directions' => $this->input->post('directions'),
			'country' => $this->input->post('country'),
			'continent' => $this->input->post('continent'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'map_link' => $this->input->post('map_link')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->location_model->delete_record();
		} else {
			$this->location_model->update_record($data);
		}
		$this->index();
	}

	function delete()
	{
		$this->location_model->delete_record();
		$this->index();
	}

}
