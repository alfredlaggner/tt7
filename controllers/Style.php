<?php

class Style extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->style_model->get_records()) {
			$data['records'] = $query;
		}
		$data['title'] = 'Styles';
		$data['title_action'] = 'Manage Styles';
		$data['top_note'] = 'Enter the style of the activity';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$this->load->view('tables/style_view', $data);
	}

	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		$this->style_model->add_record($data);
		redirect('style');
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->style_model->delete_record();
		} else {
			$this->style_model->update_record($data);
		}
//		$this->index();
		redirect('style');
	}
}
