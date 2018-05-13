<?php

class Equipment extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->equipment_model->get_records()) {
			$data['title'] = 'Equipments';
			$data['title_action'] = 'Manage Equipments';
			$data['top_note'] = 'List of your equipments.';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->parser->parse('equipment/equipment_over_view', $data);
		} else {

			$this->equipment_create();
		}
	}

	function equipment_view()
	{
		$data['title'] = 'equipment';
		$data['title_action'] = 'Edit equipment';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->equipment_model->get_record();
		$this->load->view('equipment/equipment_view', $data);
	}

	function equipment_create()
	{
		$data['title'] = 'New equipment';
		$data['title_action'] = 'Create equipment';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$this->load->view('equipment/equipment_create_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'equipment' => $this->input->post('equipment'),
		);

		$this->equipment_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'equipment' => $this->input->post('equipment'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->equipment_model->delete_record();
		} else {
			$this->equipment_model->update_record($data);
		}
		$this->index();
	}

	function delete()
	{
		$this->equipment_model->delete_record();
		$this->index();
	}

}
