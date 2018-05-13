<?php

class Home_slider_pictures extends Common_Auth_Controller
{
	function index($home_slider_picture_id = 0, $home_slider_id = 0, $folder = 'home_slider')
	{
		$data = array();

		if ($query = $this->home_slider_picture_model
			->get_record($home_slider_id)
		) {
			$data['records'] = $query;
		}
		$data['title'] = 'Home Slider Pictures';
		$data['title_action'] = 'Manage Home Slider Pictures';
		$data['top_note'] = 'Enter the pictures for this home slide';
		$data['bottom_note'] = '';
		$data['folder'] = $folder;
		$data['home_slider_id'] = $home_slider_id;
		$data['home_slider_name'] = $this->home_slider_model->get_home_slider_name($home_slider_id);
		$data['home_slider_picture_id'] = $home_slider_picture_id;

		$this->load->view('tables/home_slider_pictures_view', $data);
	}

	function create()
	{
		$data = array(
			'home_slider_id' => $this->input->post('home_slider_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		$this->home_slider_picture_model
			->add_record($data);
		$home_slider_picture_id = $this->db->insert_id();
		$this->index($home_slider_picture_id, $this->input->post('home_slider_id'), $this->input->post('folder'));
	}

	function update($home_slider_picture_id)
	{
		$data = array(
			'home_slider_id' => $this->input->post('home_slider_id'),
			'folder' => $this->input->post('folder'),
			'picture' => $this->input->post('picture'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->home_slider_picture_model
				->delete_record();
		} else {
			$this->home_slider_picture_model
				->update_record($data);
		}
		$this->index($this->input->post('home_slider_picture_id'), $this->input->post('home_slider_id'), $this->input->post('folder'));
	}
}
