<?php

class Employee_function extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->employee_function_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Employee Function';
		$data['title_action'] = 'Manage Employee Function';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['top_note'] = 'Enter function name of employee here';
		$data['bottom_note'] = '';

		$this->load->view('tables/employee_function_view', $data);
	}

	function create()
	{
		$data = array(
			'short' => $this->input->post('short'),
			'name' => $this->input->post('name'),
		);

		$this->employee_function_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'short' => $this->input->post('short'),
			'name' => $this->input->post('name'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->employee_function_model->delete_record();
		} else {
			$this->employee_function_model->update_record($data);
		}
		$this->index();
	}
}
