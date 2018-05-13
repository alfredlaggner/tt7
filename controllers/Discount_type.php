<?php

class discount_type extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->discount_type_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Discount Types';
		$data['title_action'] = 'Manage Discount Types';
		$data['top_note'] = 'Enter discount types. Do not change the numbering system please!';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/discount_type_view', $data);
	}

	function create()
	{
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->discount_type_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->discount_type_model->delete_record();
		} else {
			$this->discount_type_model->update_record($data);
		}
		$this->index();
	}
}
