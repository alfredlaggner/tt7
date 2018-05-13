<?php

class Gear_group extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->gear_group_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Gear Groups';
		$data['title_action'] = 'Manage gear groups';
		$data['top_note'] = '';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '';

		$this->load->view('tables/gear_group_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		$this->gear_group_model->add_record($data);
		redirect('gear_group');
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->gear_group_model->delete_record();
		} else {
			$this->gear_group_model->update_record($data);
		}
//		$this->index();
		redirect('gear_group');
	}
}
