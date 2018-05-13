<?php

class Coordinates extends Common_Auth_Controller
{
	function index($location_id=0)
	{
		$data = array();

//		echo "1";

		$this->load->model('coordinates_model');
//		echo "2";
		$data['records'] = $this->coordinates_model->get_records($location_id);
//		echo "3";
//print_r2($data['records'] ); die();

		$data['title'] = 'Coordinatess';
		$data['title_action'] = 'Manage Coordinates';
		$location_name = $this->location_model->get_location_name($location_id);
//echo $location_name;
		$data['top_note'] = 'Enter the coordinates of location <b>' . $location_name . '</b>';
		$data['bottom_note'] = '';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['location_id'] = $location_id;
//		echo "4";
		$this->load->view('tables/coordinates_view', $data);
	}

	function create()
	{
		$data = array(
			'location_id' => $this->input->post('location_id'),
			'location' => $this->input->post('location'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
		);

		// 510 752 1190

		$this->coordinates_model->add_record($data);
		$this->index($this->input->post('location_id'));
	}

	function update()
	{
		$data = array(
			'location_id' => $this->input->post('location_id'),
			'location' => $this->input->post('location'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->coordinates_model->delete_record();
		} else {
			$this->coordinates_model->update_record($data);
		}
		$this->index($this->input->post('location_id'));
	}
}
