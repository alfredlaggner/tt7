<?php

class News_related extends Common_Auth_Controller
{
	function index($news_id)
	{
		$data['title'] = 'Related news';
		$data['title_action'] = 'Manage related news';
		$data['top_note'] = 'Choose related activities';
		$data['breadcrumb'] = '';

		$data['selected_activities'] = $this->news_model->get_record($news_id);
		$data['activities'] = $this->news_model->get_records();

		$data['news_related'] = $this->news_related_model->get_records($news_id);
		$data['news_id'] = $news_id;
		$data['news_count'] = $this->news_model->count_all();
		$this->load->view('news/news_related_view', $data);
	}

	//assign instructors
	function assign_employees($event_id, $news_id)
	{
		$data['title'] = 'news Management';
		$data['title_action'] = 'Assign Instructors';
		$data['breadcrumb'] = '';
		$data['records'] = $this->event_model->get_record($event_id);
		$data['event_id'] = $event_id;
		$data['news_id'] = $news_id;
		$data['intials'] = $this->event_to_employee_model->get_employee_string($event_id);
		$data['event_employees'] = $this->event_to_employee_model->get_event_to_employee_records($event_id);
		$data['employees'] = $this->employee_model->get_records();
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$data['employee_count'] = $this->employee_model->count_all();
		$this->load->view('news/event_to_employees', $data);
	}

	function xcreate($news_id)
	{

		$this->news_related_model->delete_record($news_id);
		$this->news_related_model->add_record($news_id);
		$this->index($news_id);
	}

	function create($news_id, $news_count)
	{
		if ($this->input->post('assign_news') == "Assign news") {
			$this->news_related_model->delete_record($news_id);
			$this->news_related_model->add_record($news_id, $news_count);
			$this->index($news_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->news_related_model->delete_record($news_id);
			$this->news_related_model->add_record($news_id, $news_count);
//				$this->index($news_id);
			redirect('news', 'refresh');
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($news_id);
		} else {
			$this->index($news_id);
		}
	}

	function update($news_id)
	{
		$data = array(
			'news_related_id' => $this->input->post('news_related_id'),
			'news_id' => $this->input->post('news_id')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->news_related_model->delete_record();
		} else {
			$this->news_related_model->update_record($data);
		}
		$this->index();
	}
}
