<?php

class Activity_related extends Common_Auth_Controller
{
	function index($activity_id)
	{
		$data['title'] = 'Related activity';
		$data['title_action'] = 'Manage related activity';
		$data['top_note'] = 'Choose related activities';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';

		$data['selected_activities'] = $this->activity_model->get_record($activity_id);
		$data['activities'] = $this->activity_model->get_records();

		$data['activity_related'] = $this->activity_related_model->get_records($activity_id);
		$data['activity_id'] = $activity_id;
		$data['activity_count'] = $this->activity_model->count_all();

		$this->load->view('activity/activity_related_view', $data);
	}

	//assign instructors
	function assign_employees($event_id, $activity_id)
	{
		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Assign Instructors';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->event_model->get_record($event_id);
		$data['event_id'] = $event_id;
		$data['activity_id'] = $activity_id;
		$data['intials'] = $this->event_to_employee_model->get_employee_string($event_id);
		$data['event_employees'] = $this->event_to_employee_model->get_event_to_employee_records($event_id);
		$data['employees'] = $this->employee_model->get_records();
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$data['employee_count'] = $this->employee_model->count_all();
		$this->load->view('activity/event_to_employees', $data);
	}

	function xcreate($activity_id)
	{

		$this->activity_related_model->delete_record($activity_id);
		$this->activity_related_model->add_record($activity_id);
		$this->index($activity_id);
	}

	function create($activity_id, $activity_count)
	{
		if ($this->input->post('assign_activities') == "Assign Activites") {
			$this->activity_related_model->delete_record($activity_id);
			$this->activity_related_model->add_record($activity_id, $activity_count);
			$this->index($activity_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->activity_related_model->delete_record($activity_id);
			$this->activity_related_model->add_record($activity_id, $activity_count);
//				$this->index($activity_id);
			redirect('activity', 'refresh');
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} else {
			$this->index($activity_id);
		}
	}

	function update($activity_id)
	{
		$data = array(
			'activity_related_id' => $this->input->post('activity_related_id'),
			'activity_id' => $this->input->post('activity_id')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->activity_related_model->delete_record();
		} else {
			$this->activity_related_model->update_record($data);
		}
		$this->index();
	}
}
