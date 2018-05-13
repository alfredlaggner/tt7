<?php

class Customer_contact_type extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->customer_contact_type_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Customer Contacts Types';
		$data['title_action'] = 'Manage Customer Contact Types';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['top_note'] = 'Please do not delete or change codes.';
		$data['bottom_note'] = '';

		$this->load->view('tables/customer_contact_type_view', $data);
	}

	function create()
	{
		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->customer_contact_type_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->customer_contact_type_model->delete_record();
		} else {
			$this->customer_contact_type_model->update_record($data);
		}
		$this->index();
	}
}
