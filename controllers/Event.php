<?php

class Event extends Common_Auth_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->_ajax();
	}

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		// Xajax Form Validator library
		$this->load->library('xajax/xajax_validator');

		$this->xajax->configure("requestURI", base_url() . 'event/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('delete_event', &$this, 'delete_event'));
		$this->xajax->processRequest();
	}


	function delete_event($event_id, $count)
	{
		$invisible = $this->activity_booking_model->mark_deleted($event_id);

		if ($invisible)
			$status = "Invisible";
		else
			$status = "";


		$objResponse = new xajaxResponse();
		$objResponse->Assign("status" . $count, "innerHTML", $status);

		return $objResponse;
	}


	function index($activity_id)
	{

		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Schedule Events';
		$data['top_note'] = 'Set up event dates, schedule instructors, and determine group size for events';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->activity_model->get_record($activity_id);
		$data['dates'] = $this->event_model->get_records($activity_id);
		$this->load->view('activity/event_over_view', $data);
	}

	function event_view($event_id, $activity_id, $from_calendar = 0)
	{
		$data['title'] = 'Activity Date Management';
		$data['title_action'] = 'Edit Activity Date';
		$data['activity_id'] = $activity_id;
		$data['from_calendar'] = $from_calendar;
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['locations'] = $this->location_model->get_records();
		$data['activity_code'] = $this->activity_model->get_activity_code($activity_id);
		$data['records'] = $this->event_model->get_record($event_id);
		$this->load->view('activity/event_view', $data);
	}

	function event_create($activity_id)
	{
		$data['title'] = 'New event';
		$data['title_action'] = 'Create event';
		$data['activity_id'] = $activity_id;
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['locations'] = $this->location_model->get_records();
		$data['capacity'] = $this->activity_model->get_activity_capacity($activity_id);
		$this->load->view('activity/event_create_view', $data);
	}

	function create()
	{
		$activity_id = $this->input->post('activity_id');
		$data = array(
			'activity_id' => $activity_id,
			'location_id' => $this->input->post('location_id'),
			'date' => $this->input->post('date'),
			'time' => $this->input->post('time'),
			'capacity_max' => $this->input->post('capacity_max'),
			'available' => $this->input->post('capacity_max'),
//			'employee_id' => $this->input->post('employee_id'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} elseif ($this->input->post('create') == "Create") {
			$this->event_model->add_record($data);
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
			'location_id' => $this->input->post('location_id'),
			'time' => $this->input->post('time'),
			'capacity_max' => $this->input->post('capacity_max'),
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
				$this->event_model->update_record($data);
				$this->event_view($this->input->post('event_id'), $activity_id);
			} elseif ($this->input->post('return') == "Save & Return") {
				$this->event_model->update_record($data);
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
				$this->event_model->update_record($data);
				$this->event_view($this->input->post('event_id'), $activity_id);
			} elseif ($this->input->post('return') == "Save & Return") {
				$this->session->set_userdata($cal_flag);
				$this->event_model->update_record($data);
				redirect('calendar/display', 'refresh');
			} else {
				$this->session->set_userdata($cal_flag);
				redirect('calendar/display', 'refresh');
			};
		}

	}

	function import()
	{
		$this->discount_model->import_event_dates();
//		$this->index();
	}

	function delete($event_id, $activity_id)
	{
		$this->event_model->delete_record();
		$this->index($activity_id);
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

	function add_event_to_employees($event_id, $employee_count, $activity_id)
	{
		if ($this->input->post('assign_employees') == "Assign Instructors") {
			$this->event_to_employee_model->delete_event_records($event_id);
			$this->event_to_employee_model->add_record($event_id, $employee_count);
			$this->assign_employees($event_id, $activity_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->event_to_employee_model->delete_event_records($event_id);
			$this->event_to_employee_model->add_record($event_id, $employee_count);
			$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
			if (!$is_calendar)
				redirect('calendar/display', 'refresh');
			else
				$this->index($activity_id);
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} else {
			$this->index($activity_id);
		}
	}
}