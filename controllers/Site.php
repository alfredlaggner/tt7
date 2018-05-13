<?php

class Site extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->physical_level_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Styles';
		$data['title_action'] = 'Manage Styles';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/options_view', $data);
	}

	function create()
	{
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		);

		$this->physical_level_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$data = array(
			'title' => 'My Freshly UPDATED Title',
			'content' => 'Content should go here; it is updated.'
		);

		$this->physical_level_model->update_record($data);
	}


	function delete()
	{
		$this->physical_level_model->delete_row();
		$this->index();
	}
}
