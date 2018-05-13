<?php

class Template extends Common_Auth_Controller
{
	function index()
	{
		$data = array();


		if ($query = $this->template_model->get_records()) {
			$data['title'] = 'Templates';
			$data['title_action'] = 'Manage Templates';
			$data['top_note'] = 'List of your mail templates.';
			$data['activities'] = $this->activity_model->get_records();
			$data['records'] = $query;
			$this->load->view('templates/template_select_activity', $data);
		} else {

			$this->template_create();
		}
	}

	function template_over_view()
	{
		$activity_id = $this->input->post('activity_id');
		if ($query = $this->template_model->get_records($activity_id)) {
			$data = array();
			$data['title'] = 'Templates';
			$data['title_action'] = 'Manage Templates';
			$data['top_note'] = $this->activity_model->get_activity_name($activity_id);
			//		$data['activities'] = $this->activity_model->get_records();
			$data['records'] = $query;
			$data['activity_id'] = $activity_id;
			$this->load->view('templates/template_over_view', $data);
		} else {

			$this->template_create($activity_id);
		}

	}

	function template_view()
	{
		$data['title'] = 'Template';
		$data['title_action'] = 'Edit template';
		$data['records'] = $this->template_model->get_record();
		$data['activities'] = $this->activity_model->get_records();
		$data['place_holders_text'] = $this->template_model->get_place_holders_text();
		$this->load->view('templates/template_view', $data);
	}

	function template_edit($template_id)
	{
		$data['title'] = 'Template';
		$data['title_action'] = 'Modify template for this mailing';
		$data['records'] = $this->template_model->get_record_sample();
		$data['regions'] = $this->region_model->get_records();
		$data['template_id'] = $template_id;
		$this->load->view('templates/template_edit', $data);
	}

	function template_create($activity_id = 0)
	{
		$data['title'] = 'New template';
		$data['title_action'] = 'Create template';
		$data['regions'] = $this->region_model->get_records();
		$data['activity_id'] = $activity_id;
		$this->load->view('templates/template_create', $data);
	}

	function create()
	{
		if ($this->input->post('submit') == "Save") {
			$data = array(
				'name' => $this->input->post('name'),
				'activity_id' => $this->input->post('activity_id'),
				'subject' => $this->input->post('subject'),
				'body' => $this->input->post('body'),
			);

			$this->template_model->add_record($data);
		}

		$this->template_over_view();
	}

	function update()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'subject' => $this->input->post('subject'),
			'body' => $this->input->post('body'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->template_model->delete_record();
		} else {
			$this->template_model->update_record($data);
		}
		$this->index();
	}

	function delete()
	{
		$this->template_model->delete_record();
		$this->index();
	}

}
