<?php

class Customer extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->customer_model->get_records()) {
			$data['title'] = 'customers';
			$data['title_action'] = 'Manage customers';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->load->view('customer/customer_over_view', $data);
		} else {

			$this->customer_create();
		}
	}

	function customer_questionaire_view($customer_id, $event_id = 0, $location_id = 0, $counter = 0)
	{
		$data['title'] = 'Participant Questionnaire';
		$data['title_action'] = 'Edit Questionnaire';
		$data['breadcrumb'] = '';
		$data['states'] = $this->customer_model->states();
		$data['counter'] = $counter;
		$data['event_id'] = $event_id;
		$data['location_id'] = $location_id;
		$data['customers'] = $this->customer_model->get_record();
		$data['questionaires'] = $this->customer_model->get_questionaire_record($customer_id);
		$data['customer_id'] = $customer_id;
//		echo $customer_id;
//print_r2( $data['questionaires']);die();
		$this->load->view('customer/customer_questionaire_view', $data);
	}

	function customer_view()
	{
		$this->load->model('geostates_model');
		$data['title'] = 'customer';
		$data['title_action'] = 'Edit customer';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['states'] = $this->customer_model->states();
		$data['records'] = $this->customer_model->get_record();
		$data['states'] = $this->geostates_model->get_records();
		$this->load->view('customer/customer_view', $data);
	}

	function customer_create()
	{
		$data['title'] = 'New Customer';
		$data['title_action'] = 'Create Customer';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['states'] = $this->customer_model->states();
		$this->load->view('customer/customer_create_view', $data);
	}

	function create()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'sex' => strtoupper($this->input->post('sex')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'physical_condition_id' => $this->input->post('physical_condition_id'),
			'health_self_description' => $this->input->post('health_self_description'),
			'experience_self_description' => $this->input->post('experience_self_description'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('add') == "Add") {
			$this->customer_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function update()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'sex' => strtoupper($this->input->post('sex')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'physical_condition_id' => $this->input->post('physical_condition_id'),
			'health_self_description' => $this->input->post('health_self_description'),
			'experience_self_description' => $this->input->post('experience_self_description'),
			'email' => $this->input->post('email'),
			'cell' => $this->input->post('cell'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->customer_model->update_record($data);
			$this->customer_view($this->input->post('customer_id'));
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->customer_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function customer_delete($customer_id)
	{
		$data['title'] = 'customer';
		$data['title_action'] = 'Delete customer';
		$data['records'] = $this->customer_model->get_record($customer_id);
		$this->load->view('customer/customer_delete', $data);
	}

	function delete()
	{
		$this->customer_model->delete_record();
		$this->index();
	}

}
