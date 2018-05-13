<?php

class Home_slider extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->home_slider_model->get_records()) {
			$data['records'] = $query;
//print_r($data['records']);		
			$data['title'] = 'Home Slider';
			$data['title_action'] = 'Manage Home Slides';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['top_note'] = 'Enter slides for the home page';
			$data['bottom_note'] = '';

			$this->load->view('home_slider/home_slider_over_view', $data);
		} else {
			$this->home_slider_create();
		}
	}

	function home_slider_create()

	{
		$data['title'] = 'New Home Slide';
		$data['title_action'] = 'Create Home Slide';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['regions'] = $this->region_model->get_records();
		$this->load->view('home_slider/home_slider_create_view', $data);
	}

	function home_slider_view($home_slider_id)
	{
		$data['title'] = 'Home Slide';
		$data['title_action'] = 'Edit Home Slide';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->home_slider_model->get_record($home_slider_id);
		$data['regions'] = $this->region_model->get_records();
		$this->load->view('home_slider/home_slider_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'slogan' => $this->input->post('slogan'),
			'link' => $this->input->post('link'),
			'description_short' => $this->input->post('description_short'),
			'region_id' => $this->input->post('region_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} else {
			$this->home_slider_model->add_record($data);
			$this->index();
		}
	}

	function delete()
	{
		$this->home_slider_model->delete_record();
		$this->index();
	}

	function update($home_slider_id)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'slogan' => $this->input->post('slogan'),
			'link' => $this->input->post('link'),
			'description_short' => $this->input->post('description_short'),
			'region_id' => $this->input->post('region_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->home_slider_model->update_record($data);
			$this->home_slider_view($home_slider_id);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->home_slider_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}
}
