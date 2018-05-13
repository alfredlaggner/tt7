<?php

class Activity_rate extends Common_Auth_Controller
{
	function index($activity_id)
	{
		$data['title'] = 'Rate Price Management';
		$data['title_action'] = 'Rates Overview';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['top_note'] = 'Set up effective dates and event rates';
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['activity_id'] = $activity_id;
		$data['rate_prices'] = $this->rate_price_model->get_records($activity_id);
		$this->load->view('rate/rate_price_over_view', $data);
	}

	function rate_price_view($rate_price_id, $activity_id)
	{
		$data['title'] = 'Rate Price Management';
		$data['title_action'] = 'Edit Rate Price';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->rate_price_model->get_record($rate_price_id);
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['activity_id'] = $activity_id;
		$data['week_end_days'] = $this->rate_price_model->weekend_days($this->rate_price_model->get_weekend_days($rate_price_id));
		$this->load->view('rate/rate_price_view', $data);
	}

	function rate_price_create_view($activity_id)
	{
		$data['title'] = 'Rate Price Management';
		$data['title_action'] = 'Create Rate Price';
		$data['activity_id'] = $activity_id;
		$data['activity_name'] = $this->activity_model->get_activity_name($activity_id);
		$data['week_end_days'] = $this->rate_price_model->weekend_days('0000011');
		$this->load->view('rate/rate_price_create_view', $data);
	}

	function add_rate_price()
	{
		$weekend = '';
		for ($i = 1; $i <= 7; $i++) {
			$day = 'day' . $i;
			$weekend .= isset($_POST[$day]) ? '1' : '0';
		};
		$data = array(
			'activity_id' => $this->input->post('activity_id'),
			'effective_date' => $this->input->post('effective_date'),
			'price' => $this->input->post('price'),
			'exp_discount_price' => $this->input->post('exp_discount_price'),
			'wholesale_price' => $this->input->post('wholesale_price'),
			'price_weekend' => $this->input->post('price_weekend'),
			'weekend_days' => $weekend,
		);


		if ($this->input->post('create') == "Create") {
			$this->rate_price_model->add_record($data);
		}

		$this->index($this->input->post('activity_id'));
	}

	function update_rate_price($rate_price_id, $activity_id)
	{
		$weekend = '';
		for ($i = 1; $i <= 7; $i++) {
			$day = 'day' . $i;
			$weekend .= isset($_POST[$day]) ? '1' : '0';
		};

		$data = array(
			'activity_id' => $this->input->post('activity_id'),
			'effective_date' => $this->input->post('effective_date'),
			'price' => $this->input->post('price'),
			'exp_discount_price' => $this->input->post('exp_discount_price'),
			'wholesale_price' => $this->input->post('wholesale_price'),
			'price_weekend' => $this->input->post('price_weekend'),
			'weekend_days' => $weekend,
		);
		if ($this->input->post('return') == "Save & Return") {
			$this->rate_price_model->update_record($data);
			$this->index($activity_id);
		} elseif ($this->input->post('update') == "Save") {
			$this->rate_price_model->update_record($data);
			$this->rate_price_view($rate_price_id, $activity_id);
		} else {
			$this->index($activity_id);
		}

	}

	function delete_rate_price($rate_price_id, $activity_id)
	{
		$this->rate_price_model->delete_record();
		$this->index($activity_id);
	}

	function get_weekdays()
	{
		$weekdays = $this->rate_price_model->weekend_days('1000011');
	}
}