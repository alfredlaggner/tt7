<?php

class Employee extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->employee_model->get_records()) {
			$data['title'] = 'Employees';
			$data['title_action'] = 'Manage Employees';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['employee_functions'] = $this->employee_function_model->get_records();
//			$data['commission'] =  $this->employee_cms_model->get_commission($employee_id,date('Y/m/d'));
			$data['records'] = $query;
			$this->load->view('employee/employee_over_view', $data);
		} else {

			$this->employee_create();
		}
	}

	function employee_view()
	{
		$data['title'] = 'Employee';
		$data['title_action'] = 'Edit Employee';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$data['records'] = $this->employee_model->get_record();
		$this->load->view('employee/employee_view', $data);
	}

	function employee_create()
	{
		$data['title'] = 'New Employee';
		$data['title_action'] = 'Create employee';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$this->load->view('employee/employee_create_view', $data);
	}

	function create()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'dob' => $this->input->post('dob'),
			'initials' => strtoupper($this->input->post('initials')),
			'employee_function_id' => $this->input->post('employee_function_id'),
			'bio' => $this->input->post('bio'),
			'picture' => $this->input->post('picture'),
			'about' => $this->input->post('about'),
		);
		$this->employee_model->add_record($data);
		$this->index();
	}


	function update()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'dob' => $this->input->post('dob'),
			'initials' => strtoupper($this->input->post('initials')),
			'employee_function_id' => $this->input->post('employee_function_id'),
			'bio' => $this->input->post('bio'),
			'picture' => $this->input->post('picture'),
			'about' => $this->input->post('about'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->employee_model->update_record($data);
			$this->employee_view($this->input->post('employee_id'));
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->employee_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function delete()
	{
		$this->employee_model->delete_record();
		$this->index();
	}

// commission handling

	function employee_cms_overview($employee_id)
	{
		if ($records = $this->employee_cms_model->get_records($employee_id)) {
			$data['title'] = 'Employee Commission Management';
			$data['title_action'] = 'Employee Commission';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['employees'] = $this->employee_model->get_record($employee_id);
			$data['employee_name'] = $this->employee_model->get_employee_name($employee_id);
//			$on_date= date('Y/m/d');
			$data['commission'] = $this->employee_cms_model->get_commission($employee_id, date('Y/m/d'));
			$data['records'] = $records;
			$this->load->view('employee/employee_cms_overview', $data);
		} else {
			$data['records'] = $this->employee_cms_create($employee_id);
		}
	}

	function calc_commission($employee_id)
	{
		$data['title'] = 'Employee Commission Management';
		$data['title_action'] = 'Employee Commission';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['employees'] = $this->employee_model->get_record($employee_id);
		$data['employee_name'] = $this->employee_model->get_employee_name($employee_id);
		$data['records'] = $this->employee_cms_model->calc_commission($employee_id);
		$this->load->view('employee/employee_cms_commissions', $data);
	}

	function employee_cms_create($employee_id)
	{
		$data['title'] = 'Employee Commission Management';
		$data['title_action'] = 'Create Employee Commission';
		$data['employees'] = $this->employee_model->get_record($employee_id);
		$data['employee_name'] = $this->employee_model->get_employee_name($employee_id);
		$data['employee_id'] = $employee_id;
		$this->load->view('employee/employee_cms_create_view', $data);
	}

	function employee_cms_edit($employee_cms_id, $employee_id)
	{
		$data['title'] = 'Employee Commission Management';
		$data['title_action'] = 'Create Employee Commission';
		$data['employees'] = $this->employee_model->get_record($employee_id);
		$data['employee_name'] = $this->employee_model->get_employee_name($employee_id);
		$data['employee_id'] = $employee_id;
		$data['records'] = $this->employee_cms_model->get_record($employee_cms_id);
		$this->load->view('employee/employee_cms_view', $data);
	}

	function return_employee_cms()
	{
		//	$this->employee_cms_overview($this->input->post('employee_id'));
		$this->index();
	}

	function add_employee_cms()
	{
		$data = array(
			'employee_id' => $this->input->post('employee_id'),
			'cms_eff_date' => $this->input->post('cms_eff_date'),
			'cms_amount' => $this->input->post('cms_amount'),
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('create') == "Create") {
			$this->employee_cms_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		}
	}

	function update_employee_cms($employee_cms_id, $employee_id)
	{

		$data = array(
			'employee_id' => $this->input->post('employee_id'),
			'cms_eff_date' => $this->input->post('cms_eff_date'),
			'cms_amount' => $this->input->post('cms_amount'),
		);
		if ($this->input->post('return') == "Save & Return") {
			$this->employee_cms_model->update_record($data);
			$this->employee_cms_overview($employee_id);
		} elseif ($this->input->post('update') == "Update") {
			$this->employee_cms_model->update_record($data);
			$this->employee_cms_edit($employee_cms_id, $employee_id);
		} else {
			$this->employee_cms_overview($employee_id);
		}


	}

	function employee_cms_delete($employee_cms_id, $employee_id)
	{
		$this->employee_cms_model->delete_record();
		$this->employee_view($employee_id);
	}

}
