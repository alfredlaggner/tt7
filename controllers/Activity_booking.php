<?php

class Activity_booking extends Common_Auth_Controller
{
	function index()
	{
		$data = array();
		$data['title'] = 'Available Events';
		$data['title_action'] = 'Book available events';
		$data['top_note'] = '. Event booking of the activity';
		$data['bottom_note'] = '';
		$data['records'] = $this->activity_booking_model->get_records();
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('activity/activity_booking_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->activity_booking_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->activity_booking_model->delete_record();
		} else {
			$this->activity_booking_model->update_record($data);
		}
		$this->index();
	}
}
