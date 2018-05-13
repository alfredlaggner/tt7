<?php

class Calendar extends Common_Auth_Controller
{

	function display($year = null, $month = null)
	{

		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}

		$this->load->model('calendar_model');

		if ($day = $this->input->post('day')) {
			$this->calendar_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
			);
		}

		$data['title'] = 'Event Calendar';
		$data['title_action'] = 'Monthtly Overview';
		$data['top_note'] =
			$this->session->userdata('activity_text') . ' ' .
			$this->session->userdata('location_text') . ' ' .
			$this->session->userdata('is_finished_text') . ' ' .
			$this->session->userdata('is_booked_text') . ' ' .
			$this->session->userdata('style_text');;
		$data['bottom_note'] = 'Set up your activities and manage event dates';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['calendar'] = $this->calendar_model->generate($year, $month);
		$this->load->view('calendar/calendar', $data);

	}

}
