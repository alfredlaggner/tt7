<?php

class Confirmation_message extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->confirmation_message_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Confirmation Messages';
		$data['title_action'] = 'Confirmation Messages';
		$data['top_note'] = 'Enter standardized email texts for confirmation messages';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/confirmation_message_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->confirmation_message_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->confirmation_message_model->delete_record();
		} else {
			$this->confirmation_message_model->update_record($data);
		}
		$this->index();
	}
}
