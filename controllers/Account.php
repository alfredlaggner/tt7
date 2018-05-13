<?php

class Account extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->account_model->get_records()) {
			$data['title'] = 'Accounts';
			$data['title_action'] = 'Manage accounts';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->load->view('account/account_over_view', $data);
		} else {

			$this->account_create();
		}
	}

	function account_view()
	{
		$data['title'] = 'account';
		$data['title_action'] = 'Edit account';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['states'] = $this->account_model->states();
		$data['employees'] = $this->employee_model->get_records();
		$data['records'] = $this->account_model->get_record();
		$this->load->view('account/account_view', $data);
	}

	function account_create()
	{
		$data['title'] = 'New account';
		$data['title_action'] = 'Create account';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['employees'] = $this->employee_model->get_records();
		$data['states'] = $this->account_model->states();
		$this->load->view('account/account_create_view', $data);
	}

	function create()
	{
		$data = array(
			'account_name' => $this->input->post('account_name'),
			'account_short' => $this->input->post('account_short'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'created_on' => $this->input->post('created_on'),
			'type' => strtoupper($this->input->post('type')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'employee_id' => $this->input->post('employee_id'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('add') == "Add") {
			$this->account_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function update()
	{
		$x = "name";
		$data = array(
//			'account_name' => $this->input->post('account_' . $x),
			'account_name' => $this->input->post('account_name'),
			'account_short' => $this->input->post('account_short'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'created_on' => $this->input->post('created_on'),
			'type' => strtoupper($this->input->post('type')),
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'city' => $this->input->post('city'),
			'zip' => $this->input->post('zip'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'employee_id' => $this->input->post('employee_id'),
		);
//print_r($data);		
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->account_model->update_record($data);
			$this->account_view($this->input->post('account_id'));
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->account_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function delete()
	{
		$this->account_model->delete_record();
		$this->index();
	}

}
