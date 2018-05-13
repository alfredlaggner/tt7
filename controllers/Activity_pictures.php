<?php

class Activity_pictures extends Common_Auth_Controller
{
	function index($activity_picture_id = 0, $activity_id = 0, $folder = '')
	{
		$data = array();

		if ($query = $this->activity_pictures_model->get_records($activity_id)) {
			$data['records'] = $query;
		}
		$data['title'] = 'Activity Pictures';
		$data['title_action'] = 'Manage Activity Pictures';
		$data['top_note'] = 'Enter the pictures for this activity';
		$data['bottom_note'] = '';
		$data['folder'] = $folder;
		$data['activity_id'] = $activity_id;
		$data['activity_picture_id'] = $activity_picture_id;

		$this->load->view('tables/activity_pictures_view', $data);
	}

	function create()
	{
		$data = array(
			'activity_id' => $this->input->post('activity_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		$this->activity_pictures_model->add_record($data);
		$activity_picture_id = $this->db->insert_id();
		$this->index($activity_picture_id, $this->input->post('activity_id'), $this->input->post('folder'));
	}

	function update($activity_picture_id)
	{
		$data = array(
			'activity_id' => $this->input->post('activity_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->activity_pictures_model->delete_record();
		} else {
			$this->activity_pictures_model->update_record($data);
		}
		$this->index($this->input->post('activity_picture_id'), $this->input->post('activity_id'), $this->input->post('folder'));
	}
}
