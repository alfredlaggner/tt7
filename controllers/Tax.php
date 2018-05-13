<?php

class Tax extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->tax_plan_model->get_records()) {
			$data['title'] = 'Tax Plan Management';
			$data['title_action'] = 'Manage Tax Plans';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->parser->parse('tax/tax_plan_over_view', $data);
		} else {
			$this->tax_plan_create();
		}
	}

	function tax_plan_view($tax_plan_id)
	{

		$data['title'] = 'Tax Plan Management';
		$data['title_action'] = 'Edit Tax Plan';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->tax_plan_model->get_record($tax_plan_id);
		$data['taxs'] = $this->tax_plan_to_tax_model->get_tax_plan_to_tax_records($tax_plan_id);
		$this->load->view('tax/tax_plan_view', $data);
	}

	function tax_plan_create()
	{
		$data['title'] = 'Tax Plan';
		$data['title_action'] = 'Create Tax Plan';
		$this->load->view('tax/tax_plan_create_view', $data);
	}

	function add_tax_plan()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0
		);

		if ($this->input->post('create') == "Create") {
			$this->tax_plan_model->add_record($data);
			$this->index();
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} else {
			$this->index();
		}
	}

	function update_tax_plan($tax_plan_id)
	{

		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0
		);

		if ($this->input->post('return') == "Save & Return") {
			$this->tax_plan_model->update_record($data);
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->tax_plan_model->update_record($data);
			$this->tax_plan_view($tax_plan_id);
		} else {
			$this->index();
		}

	}

	function delete_tax_plan()
	{
		$this->tax_plan_model->delete_record();
		$this->index();
	}

	function add_taxes($tax_plan_id)
	{
		$data = array();

		$data['title'] = 'Add Taxes';
		$data['title_action'] = 'Add Taxes for ' . $this->tax_plan_model->get_tax_plan_name($tax_plan_id);
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->tax_model->get_records();
		$data['tax_plan_id'] = $tax_plan_id;
		$data['tax_count'] = $this->tax_model->count_all();
		$data['tax_plan_name'] = $this->tax_plan_model->get_tax_plan_name($tax_plan_id);

		$this->load->view('tax/add_taxes', $data);
	}

	function add_tax_plan_to_tax($tax_plan_id, $tax_count)
	{
		$this->tax_plan_to_tax_model->add_record($tax_plan_id, $tax_count);
		$this->tax_plan_view($tax_plan_id);
	}

	function delete_tax_plan_to_tax($tax_plan_id, $tax_id)
	{
		$this->tax_plan_to_tax_model->delete_record($tax_plan_id, $tax_id);
		$this->tax_plan_view($tax_plan_id);
	}

	//taxes
	function tax_over_view()
	{
		$data = array();

		if ($query = $this->tax_model->get_records()) {
			$data['title'] = 'Tax Management';
			$data['title_action'] = 'Manage Taxes';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->load->view('tax/tax_over_view', $data);
		} else {
			$this->tax_create();
		}
	}

	function tax_edit($tax_id)
	{

		$data['title'] = 'Tax Management';
		$data['title_action'] = 'Edit Tax';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->tax_model->get_record($tax_id);
		$this->load->view('tax/tax_view', $data);
	}

	function tax_create()
	{
		$data['title'] = 'New tax';
		$data['title_action'] = 'Create tax';
		$this->load->view('tax/tax_view_create', $data);
	}

	function add_tax()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'authority' => $this->input->post('authority'),
			'amount_type' => $this->input->post('amount_type'),
			'person_or_reservation' => $this->input->post('person_or_reservation'),
			'amount' => $this->input->post('amount'),
			'is_exempt' => isset($_POST['is_exempt']) ? 1 : 0
		);
//echo 'person or group = ' . $this->input->post('person_or_reservation');

		if ($this->input->post('cancel') == "Cancel") {
			$this->tax_over_view();
		} elseif ($this->input->post('create') == "Create") {
			$this->tax_model->add_record($data);
			$this->tax_over_view();
		} else {
			$this->tax_over_view();
		}
	}

	function update_tax()
	{

		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'authority' => $this->input->post('authority'),
			'amount_type' => $this->input->post('amount_type'),
			'person_or_reservation' => $this->input->post('person_or_reservation'),
			'amount' => $this->input->post('amount'),
			'is_exempt' => isset($_POST['is_exempt']) ? 1 : 0
		);


		if ($this->input->post('return') == "Save & Return") {
			$this->tax_model->update_record($data);
			$this->tax_over_view($this->input->post('tax_plan_id'));
		} elseif ($this->input->post('update') == "Update") {
			$this->tax_model->update_record($data);
			$this->tax_edit($this->input->post('tax_id'));
		} else {
			$this->tax_over_view();
		}


	}

	function tax_delete($tax_id)
	{
		$this->tax_model->delete_record();
		$this->tax_plan_to_tax_model->delete_tax_records($tax_id);
		$this->tax_over_view();
	}
}
