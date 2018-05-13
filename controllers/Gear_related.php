<?php

class Gear_related extends Common_Auth_Controller
{
	function index($gear_id)
	{
		$data['title'] = 'Related gear';
		$data['title_action'] = 'Manage related gear';
		$data['top_note'] = 'Choose related activities';
		$data['breadcrumb'] = '';

		$data['selected_activities'] = $this->gear_model->get_record($gear_id);
		$data['activities'] = $this->gear_model->get_records();

		$data['gear_related'] = $this->gear_related_model->get_records($gear_id);
		$data['gear_id'] = $gear_id;
		$data['gear_count'] = $this->gear_model->count_all();
		$this->load->view('gear/gear_related_view', $data);
	}

	//assign instructors
	function assign_employees($event_id, $gear_id)
	{
		$data['title'] = 'Gear Management';
		$data['title_action'] = 'Assign Instructors';
		$data['breadcrumb'] = '';
		$data['records'] = $this->event_model->get_record($event_id);
		$data['event_id'] = $event_id;
		$data['gear_id'] = $gear_id;
		$data['intials'] = $this->event_to_employee_model->get_employee_string($event_id);
		$data['event_employees'] = $this->event_to_employee_model->get_event_to_employee_records($event_id);
		$data['employees'] = $this->employee_model->get_records();
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$data['employee_count'] = $this->employee_model->count_all();
		$this->load->view('gear/event_to_employees', $data);
	}

	function xcreate($gear_id)
	{

		$this->gear_related_model->delete_record($gear_id);
		$this->gear_related_model->add_record($gear_id);
		$this->index($gear_id);
	}

	function create($gear_id, $gear_count)
	{
		if ($this->input->post('assign_gear') == "Assign Gear") {
			$this->gear_related_model->delete_record($gear_id);
			$this->gear_related_model->add_record($gear_id, $gear_count);
			$this->index($gear_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->gear_related_model->delete_record($gear_id);
			$this->gear_related_model->add_record($gear_id, $gear_count);
//				$this->index($gear_id);
			redirect('gear', 'refresh');
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($gear_id);
		} else {
			$this->index($gear_id);
		}
	}

	function update($gear_id)
	{
		$data = array(
			'gear_related_id' => $this->input->post('gear_related_id'),
			'gear_id' => $this->input->post('gear_id')
		);

		if ($this->input->post('delete') == "Delete") {
			$this->gear_related_model->delete_record();
		} else {
			$this->gear_related_model->update_record($data);
		}
		$this->index();
	}
}
