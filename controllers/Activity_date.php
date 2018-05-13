<?php

class Activity_date extends Common_Auth_Controller
{

	function index($activity_id)
	{

		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Schedule Events';
		$data['top_note'] = 'Set up event dates, schedule instructors, and determine group size for events';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->activity_model->get_record($activity_id);
		$data['dates'] = $this->activity_date_model->get_records($activity_id);
		print_r2($data['dates']);
		$this->load->view('activity/activity_date_over_view', $data);
	}

	function activity_date_view($activity_date_id, $activity_id, $from_calendar = 0)
	{
		$data['title'] = 'Activity Date Management';
		$data['title_action'] = 'Edit Activity Date';
		$data['records'] = $this->activity_date_model->get_record($activity_date_id);
		$data['activity_id'] = $activity_id;
		$data['from_calendar'] = $from_calendar;
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['activity_code'] = $this->activity_model->get_activity_code($activity_id);
		$this->load->view('activity/activity_date_view', $data);
	}

	function activity_date_create($activity_id)
	{
		$data['title'] = 'New Activity_date';
		$data['title_action'] = 'Create Activity_date';
		$data['activity_id'] = $activity_id;
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['capacity'] = $this->activity_model->get_activity_capacity($activity_id);
		$this->load->view('activity/activity_date_create_view', $data);
	}

	function create()
	{
		$activity_id = $this->input->post('activity_id');
		$data = array(
			'activity_id' => $activity_id,
			'date' => $this->input->post('date'),
			'time' => $this->input->post('time'),
			'capacity_max' => $this->input->post('capacity_max'),
			'available' => $this->input->post('capacity_max'),
			'employee_id' => $this->input->post('employee_id'),
//			'data' => 	$this->input->post('activity_code') . ' ' . 
//							$this->input->post('capacity_max') . '/' .
//							$this->input->post('capacity_max') 
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} elseif ($this->input->post('create') == "Create") {
			$this->activity_date_model->add_record($data);
			$this->index($activity_id);
		} else {
			$this->index($activity_id);
		};
	}

	function update()
	{

		$activity_id = $this->input->post('activity_id');
		$data = array(
			'date' => $this->input->post('date'),
			'time' => $this->input->post('time'),
			'capacity_max' => $this->input->post('capacity_max'),
//			'data' => 	$this->input->post('activity_code') . ' ' . 
//							$this->input->post('capacity_max') . '/' .
//							$this->input->post('available') 
		);
		$is_calendar = $this->session->userdata('from_calendar');
//if ( $this->input->post('from_calendar'))
//echo "this is true";
//else
//echo "this is false";
//echo  "<br>";
//if ($is_calendar)
//echo "xxx is true";
//else
//echo "xxx is false";
//
		$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
		if (!$is_calendar) {
//echo  "<br>";
//echo "not from calendar";			

			if ($this->input->post('cancel') == "Cancel") {
				$this->index($activity_id);
			} elseif ($this->input->post('update') == "Update") {
				$this->activity_date_model->update_record($data);
				$this->activity_date_view($this->input->post('activity_date_id'), $activity_id);
			} elseif ($this->input->post('return') == "Save & Return") {
				$this->activity_date_model->update_record($data);
				$this->index($activity_id);
			} else {
				$this->index($activity_id);
			};
		} else {
//echo  "<br>";
//echo "from calendar";			
			// remember it is from calendar
			$cal_flag = array('from_calendar' => '1');
			$this->session->set_userdata($cal_flag);
			// turn calendar mode off
			$cal_flag = array('from_calendar' => '0');

			if ($this->input->post('cancel') == "Cancel") {
				$this->session->set_userdata($cal_flag);
				redirect('calendar/display', 'refresh');
			} elseif ($this->input->post('update') == "Update") {
				// leave calendar turned on
				$this->activity_date_model->update_record($data);
				$this->activity_date_view($this->input->post('activity_date_id'), $activity_id);
			} elseif ($this->input->post('return') == "Save & Return") {
				$this->session->set_userdata($cal_flag);
				$this->activity_date_model->update_record($data);
				redirect('calendar/display', 'refresh');
			} else {
				$this->session->set_userdata($cal_flag);
				redirect('calendar/display', 'refresh');
			};
		}

	}

	function delete()
	{
		$this->activity_date_model->delete_record();
		$this->index();
	}

	//assign instructors
	function assign_employees($activity_date_id, $activity_id)
	{
		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Assign Instructors';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->activity_date_model->get_record($activity_date_id);
		$data['activity_date_id'] = $activity_date_id;
		$data['activity_id'] = $activity_id;
		$data['intials'] = $this->activity_date_to_employee_model->get_employee_string($activity_date_id);
		$data['activity_date_employees'] = $this->activity_date_to_employee_model->get_activity_date_to_employee_records($activity_date_id);
		$data['employees'] = $this->employee_model->get_records();
		$data['employee_functions'] = $this->employee_function_model->get_records();
		$data['employee_count'] = $this->employee_model->count_all();
		$this->load->view('activity/activity_date_to_employees', $data);
	}

	function add_activity_date_to_employees($activity_date_id, $employee_count, $activity_id)
	{
		if ($this->input->post('assign_employees') == "Assign Instructors") {
			$this->activity_date_to_employee_model->delete_activity_date_records($activity_date_id);
			$this->activity_date_to_employee_model->add_record($activity_date_id, $employee_count);
			$this->assign_employees($activity_date_id, $activity_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->activity_date_to_employee_model->delete_activity_date_records($activity_date_id);
			$this->activity_date_to_employee_model->add_record($activity_date_id, $employee_count);
			$this->index($activity_id);
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} else {
			$this->index($activity_id);
		}
	}
}