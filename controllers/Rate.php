<?php

class Rate extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->rate_plan_model->get_records_full()) {
			$data['title'] = 'Rate Plan Management';
			$data['title_action'] = 'Manage Rate Plans';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->load->view('rate/rate_plan_over_view', $data);
		} else {
			$this->rate_plan_create();
		}
	}

	function rate_plan_view($rate_plan_id)
	{

		$data['title'] = 'Rate Plan Management';
		$data['title_action'] = 'Edit Rate Plan';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->rate_plan_model->get_record($rate_plan_id);
		$data['tax_plans'] = $this->tax_plan_model->get_records();
		$data['rates'] = $this->rate_model->get_rate_plan_records($rate_plan_id);
		$this->load->view('rate/rate_plan_view', $data);
	}

	function rate_plan_create()
	{
		$data['title'] = 'New Rate Plan';
		$data['title_action'] = 'Create Rate Plan';
		$this->load->view('rate/rate_plan_create_view', $data);
	}

	function add_rate_plan()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'type' => $this->input->post('type'),
			'tax_plan_id' => $this->input->post('tax_plan_id'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
		);

		$this->rate_plan_model->add_record($data);
		$this->index();
	}

	function update_rate_plan($rate_plan_id)
	{

		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'type' => $this->input->post('type'),
			'tax_plan_id' => $this->input->post('tax_plan_id'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
		);

		if ($this->input->post('return') == "Save & Return") {
			$this->rate_plan_model->update_record($data);
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->rate_plan_model->update_record($data);
			$this->rate_plan_view($rate_plan_id);
		} else {
			$this->index();
		}

	}

	function delete_rate_plan()
	{
		$this->rate_plan_model->delete_record();
		$this->index();
	}


	function xxrate_overview()
	{
		$data = array();

		if ($query = $this->rate_model->get_records()) {
			$data['title'] = 'Rate Management';
			$data['title_action'] = 'Manage Rates';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->parser->parse('rate/rate_over_view', $data);
		} else {
			$this->rate_create();
		}
	}

	//rates
	function xxrates_over_view()
	{
		$data = array();

		if ($query = $this->rate_model->get_records()) {
			$data['title'] = 'Rate Management';
			$data['title_action'] = 'Manage Rates';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->parser->parse('rate/rate_over_view', $data);
		} else {
			$this->rate_create();
		}
	}

	function rate_edit($rate_id, $rate_plan_id)
	{

		$data['title'] = 'Rate Management';
		$data['title_action'] = 'Edit Rate';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
//		$data['rate_plans'] = $this->rate_plan_model->get_record($rate_plan_id);
		$data['records'] = $this->rate_model->get_record($rate_id);
		$data['rate_plan_name'] = $this->rate_plan_model->get_rate_plan_name($rate_plan_id);
		$data['rate_prices'] = $this->rate_price_model->get_records($rate_id);
		$this->load->view('rate/rate_view', $data);
	}

	function rate_create($rate_plan_id)
	{
		$data['title'] = 'New rate';
		$data['title_action'] = 'Create rate';
		$data['rate_plans'] = $this->rate_plan_model->get_record($rate_plan_id);
		$data['rate_plan_name'] = $this->rate_plan_model->get_rate_plan_name($rate_plan_id);
		$data['rate_plan_id'] = $rate_plan_id;
		$this->load->view('rate/rate_view_create', $data);
	}

	function add_rate()
	{
		$data = array(
			'rate_plan_id' => $this->input->post('rate_plan_id'),
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description'),
			'is_status_dependent' => isset($_POST['is_status_dependent']) ? 1 : 0,
			'status_dependent_text' => $this->input->post('status_dependent_text'),
			'age_from' => $this->input->post('age_from'),
			'age_to' => $this->input->post('age_to'),
			'party_size_min' => $this->input->post('party_size_min'),
			'party_size_max' => $this->input->post('party_size_max'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->rate_plan_view($this->input->post('rate_plan_id'));
		} elseif ($this->input->post('create') == "Create") {
			$this->rate_model->add_record($data);
//			$this->rate_edit($this->input->post('rate_id'),$this->input->post('rate_plan_id'));
			$this->rate_plan_view($this->input->post('rate_plan_id'));
		} else {
			$this->rate_plan_view($this->input->post('rate_plan_id'));
		}
	}

	function update_rate()
	{

		$data = array(
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description'),
			'is_status_dependent' => isset($_POST['is_status_dependent']) ? 1 : 0,
			'status_dependent_text' => $this->input->post('status_dependent_text'),
			'age_from' => $this->input->post('age_from'),
			'age_to' => $this->input->post('age_to'),
			'party_size_min' => $this->input->post('party_size_min'),
			'party_size_max' => $this->input->post('party_size_max'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0
		);
		if ($this->input->post('return') == "Save & Return") {
			$this->rate_model->update_record($data);
			$this->rate_plan_view($this->input->post('rate_plan_id'));
		} elseif ($this->input->post('update') == "Update") {
			$this->rate_model->update_record($data);
			$this->rate_edit($this->input->post('rate_id'), $this->input->post('rate_plan_id'));
		} else {
			$this->rate_plan_view($this->input->post('rate_plan_id'));
		}


	}

	function rate_delete($rate_id, $rate_plan_id)
	{
		$this->rate_model->delete_record();
		$this->rate_plan_view($rate_plan_id);
	}

// rate price
	function rate_price_view($rate_price_id, $rate_id, $rate_plan_id)
	{
		$data['title'] = 'Rate Price Management';
		$data['title_action'] = 'Edit Rate Price';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['records'] = $this->rate_price_model->get_record($rate_price_id);
		$data['rate_id'] = $rate_id;
		$data['rate_plan_id'] = $rate_plan_id;
		$data['rate_name'] = $this->rate_model->get_rate_name($rate_id);
		$data['week_end_days'] = $this->rate_price_model->weekend_days($this->rate_price_model->get_weekend_days($rate_price_id));
		$data['rate_plan_name'] = $this->rate_plan_model->get_rate_plan_name($rate_plan_id);
		$this->load->view('rate/rate_price_view', $data);
	}

	function rate_price_create_view($rate_id, $rate_plan_id)
	{
		$data['title'] = 'New Rate Price';
		$data['title_action'] = 'Create rate_price';
		$data['rate_id'] = $rate_id;
		$data['rate_plan_id'] = $rate_plan_id;
		$data['rate_name'] = $this->rate_model->get_rate_name($rate_id);
		$data['rate_plan_name'] = $this->rate_plan_model->get_rate_plan_name($rate_plan_id);
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
			'rate_id' => $this->input->post('rate_id'),
			'effective_date' => $this->input->post('effective_date'),
			'price' => $this->input->post('price'),
			'wholesale_price' => $this->input->post('wholesale_price'),
			'price_weekend' => $this->input->post('price_weekend'),
			'weekend_days' => $weekend,
		);


		if ($this->input->post('create') == "Create") {
			$this->rate_price_model->add_record($data);
		}

		$this->rate_edit($this->input->post('rate_id'), $this->input->post('rate_plan_id'));
	}

	function update_rate_price($rate_price_id, $rate_id, $rate_plan_id)
	{
		$weekend = '';
		for ($i = 1; $i <= 7; $i++) {
			$day = 'day' . $i;
			$weekend .= isset($_POST[$day]) ? '1' : '0';
		};

		$data = array(
			'rate_id' => $this->input->post('rate_id'),
			'effective_date' => $this->input->post('effective_date'),
			'price' => $this->input->post('price'),
			'wholesale_price' => $this->input->post('wholesale_price'),
			'price_weekend' => $this->input->post('price_weekend'),
			'weekend_days' => $weekend,
		);
		if ($this->input->post('return') == "Save & Return") {
			$this->rate_price_model->update_record($data);
			$this->rate_edit($rate_id, $rate_plan_id);
		} elseif ($this->input->post('update') == "Update") {
			$this->rate_price_model->update_record($data);
			$this->rate_price_view($rate_price_id, $rate_id, $rate_plan_id);
		} else {
			$this->rate_edit($rate_id, $rate_plan_id);
		}

	}

	function delete_rate_price($rate_price_id, $rate_id, $rate_plan_id)
	{
		$this->rate_price_model->delete_record();
		$this->rate_edit($rate_id, $rate_plan_id);
	}

	function get_weekdays()
	{
		$weekdays = $this->rate_price_model->weekend_days('1000011');
	}
}