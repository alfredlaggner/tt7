<?php

class Gear_pictures extends Common_Auth_Controller
{
	function index($gear_picture_id = 0, $gear_id = 0, $folder = '')
	{
		$data = array();
		if ($query = $this->gear_pictures_model->get_records($gear_id)) {
			$data['records'] = $query;
		}
		$data['title'] = 'Gear Pictures';
		$data['title_action'] = 'Manage Gear Pictures';
		$data['top_note'] = 'Enter the pictures for this gear';
		$data['bottom_note'] = '';
		$data['folder'] = $folder;
		$data['gear_id'] = $gear_id;
		$data['gear_picture_id'] = $gear_picture_id;

		$this->load->view('tables/gear_pictures_view', $data);
	}

	function create()
	{
		$data = array(
			'gear_id' => $this->input->post('gear_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		$this->gear_pictures_model->add_record($data);
		$gear_picture_id = $this->db->insert_id();
		$this->index($gear_picture_id, $this->input->post('gear_id'), $this->input->post('folder'));
	}

	function update($gear_picture_id)
	{
		$data = array(
			'gear_id' => $this->input->post('gear_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->gear_pictures_model->delete_record();
		} else {
			$this->gear_pictures_model->update_record($data);
		}
		$this->index($this->input->post('gear_picture_id'), $this->input->post('gear_id'), $this->input->post('folder'));
	}
}
