<?php

class Tt_model_v2 extends CI_Model
{

	private $q_string;

	function __construct()
	{
		parent::__construct();

	}

	function get_Regions()
	{
		$query = $this->db->get('region');
		return $query->result();

	}

	function get_region_name($region_id)
	{
//echo "region id =" . $region_id;	
		if ($region_id) $this->db->where('region_id', $region_id); else return "all regions";

		$query = $this->db->get('region');
		foreach ($query->result() as $row) {
			return $row->region;
		}

	}

	// get the first picture from each set
	function xget_featured_pictures($is_featured = 0)
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region
		if ($region_id)
			$this->db->where('region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);

		$this->db->select('activity.activity_id, activity.code, activity_pictures.picture');
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->group_by('activity.activity_id'); //new
		$this->db->order_by('rate_price.effective_date desc'); //new
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new
		$query = $this->db->get('activity');
		$pictures = array();
		foreach ($query->result() AS $row) {
			array_push($pictures, base_url() . CLASSES_IMAGE_DIR .
				strtoupper($row->code) . '/' . strtoupper($row->picture));
		}
		return $pictures;

	}

//	function get_all_classes($limit, $offset, $is_featured=0)
	function get_all_classes($style_id, $is_featured)
	{
//		echo "query: ". $isQuery.'<br>';
//		echo "limit: ".$limit.'<br>';
//		echo "offset: ".$offset.'<br>';
		date_default_timezone_set('America/Los_Angeles');


		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region
		if ($region_id)
			$this->db->where('activity_to_region.region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);
		if ($style_id)
			$this->db->where('activity.style_id', $style_id);

		$this->db->where('activity.is_active', TRUE);

		$this->db->select('activity.*, rate_price.price as rate_price_price, activity_pictures.picture');
		if ($region_id)
			$this->db->join('activity_to_region', 'activity_to_region.activity_id = activity.activity_id');

		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->join('style', 'activity.style_id = style.style_id', 'left');
		$this->db->group_by('activity.activity_id'); //new
		$this->db->order_by('activity.order asc'); //new
		$this->db->order_by('rate_price.effective_date desc'); //new
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new
		$query = $this->db->get('activity');
		//	$query = $this->db->get('activity_to_region');
//print_r($query->result()); die();		
		return $query->result();

	}

	function get_paginated_classes_featured($limit, $offset)
	{

		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later

		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$this->db->where('is_featured', TRUE);
		if ($limit)
			$this->db->limit($limit);
		if ($offset)
			$this->db->offset($offset);

		$query = $this->db->get('activity');

		return $query->result();
	}

	function get_paginated_classes($limit, $offset, $is_featured = 0)
	{

		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later

		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);
		if ($limit)
			$this->db->limit($limit);
		if ($offset)
			$this->db->offset($offset);

		$query = $this->db->get('activity');

		return $query->result();
	}

	function get_class($activity_id)
	{

		$this->db->select('
			activity.*, 
			activity_pictures.*, 
			style.name AS style_name,
			physical_level.level AS physical_level_level,
			physical_level.name AS physical_level_name,
			service_level.name AS service_level_name,
			rate_price.price 
			');
		$this->db->where('activity.activity_id', $activity_id);
		$this->db->join('style', 'activity.style_id=style.style_id');
		$this->db->join('physical_level', 'activity.physical_level_id = physical_level.physical_level_id');
		$this->db->join('service_level', 'activity.service_level_id = service_level.service_level_id');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->group_by('activity.activity_id'); //new
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new
		$query = $this->db->get('activity');
		return $query->result();
	}

	function get_related_activities($activity_id)
	{
		$this->db->select('
			activity_related.*,
			activity.*, 
			activity_pictures.*, 
			style.name AS style_name,
			physical_level.level AS physical_level_level,
			physical_level.name AS physical_level_name,
			service_level.name AS service_level_name,
			rate_price.price 
			');
		$this->db->where('activity_related.activity_id', $activity_id);
		$this->db->join('activity', 'activity.activity_id=activity_related.activity_related_id');
		$this->db->join('style', 'activity.style_id=style.style_id');
		$this->db->join('physical_level', 'activity.physical_level_id = physical_level.physical_level_id');
		$this->db->join('service_level', 'activity.service_level_id = service_level.service_level_id');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->group_by('activity.activity_id'); //new
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new
		$query = $this->db->get('activity_related');
		return $query->result();

	}

	function get_rows()
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$query = $this->db->get('activity');
		return $query->num_rows();

	}

	function get_rows_featured()
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$this->db->where('is_featured', TRUE);
		$query = $this->db->get('activity');
		return $query->num_rows();

	}

	function format_booking1($locations, $events)
	{
		$test = FALSE;

		$data = [];
		$j = 1;
		if (isset($locations)) {
			$pre_month = '0';
			$pre_location = '0';
			$is_month = '-1';
			$i = 1;
			$k = 1;
			$lc = 0;
			$mc = 0;
			$ec = 0;

			$all_location_counter = 0;
			$all_event_counter = 0;
			foreach ($locations as $location) {
				++$all_location_counter;
				if ($test) echo "all_location_counter: " . $all_location_counter . "<br>";

				if ($test) echo $location->name . ' (' . $pre_location . ")<br>";
				if ($pre_location) {
					if ($test) echo "end location <br> ";
					$data[$i++] = array('end_location' => 1, 'end_month' => 0, 'location' => 0, 'event_date' => 0, 'mc' => $mc, 'ec' => $ec, 'month' => 0);
				}
				$pre_month = '0';
				$pre_location = '0';
				$is_month = '-1';

				$pre_location = $location->name;
				$data[$i++] = array('lc' => ++$lc, 'location' => $location->name, 'month' => 0, 'event_date' => 0, 'end_month' => 0, 'mc' => $mc, 'ec' => $ec, 'end_location' => 0);

				if (isset($events)) {
					foreach ($events as $event) {
						++$all_event_counter;
						if ($test) echo " <br> all_event_counter: " . $all_event_counter . "<br>";

						if ($location->location_id == $event['location_id']) {
							$is_month = date('m', strtotime($event['event_date']));
							if ($is_month != $pre_month) {
								if ($pre_month != 0) {
									$data[$i++] = array('end_month' => 1, 'location' => 0, 'event_date' => 0, 'mc' => $mc, 'ec' => $ec, 'month' => 0, 'end_location' => 0);
									if ($test) echo "end month <br> ";
								}

								$ec = 1;
								if ($test) echo "new month: ";
								if ($test) echo date('F, Y', strtotime($event['event_date'])) . "<br>";
								$pre_month = date('m', strtotime($event['event_date']));
								$k++;
								$data[$i++] = array('end_month' => 0, 'location' => 0, 'event_date' => 0, 'mc' => ++$mc, 'ec' => $ec, 'month' => date('F, Y', strtotime($event['event_date'])), 'end_location' => 0);
							}

							if ($event['is_two_days'] and get_cookie('set_admin_status')) $disable = "X"; else $disable = "";

							if ($test) echo date('D, M j', strtotime($event['event_date']));
							if ($test) echo date('g:i', strtotime($event['event_time']));
							$data[$i++] = array('end_location' => 0,
								'end_month' => 0,
								'location' => 0,
								'month' => 0,
								'ec' => $ec++,
								'mc' => $mc,
								'all_events' => $all_event_counter,
								'all_locations' => $all_location_counter,
								'event_date' => date('D, M j', strtotime($event['event_date'])),
								'event_time' => date('g:i', strtotime($event['event_time'])),
								'duration' => date('g:i', strtotime($event['event_time']) + $event['duration'] * 3600),
								'is_two_days' => $event['is_two_days'] ? 1 : 0,
								'is_two_days_message' => $event['is_two_days'] ? '<span style="color:#00F" >Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span>' : 'Please continue with the order',
								'available' => $event['capacity'] - $this->ledger_model->attending($event['event_event_id']));

							if ($event['is_two_days']) {
								$twodays = TRUE;         //  <span style="color:#00F" >Please call <span style="color:#C00">(650) 557-4893 </span> to make a last minute reservation! </span>
							}
							if ($test) echo '<br>';
						}

					}
					if ($test) echo " very end month <br> ";
					$data[$i++] = array('end_location' => 0, 'end_month' => 1, 'location' => 0, 'event_date' => 0, 'mc' => $mc, 'ec' => $ec, 'month' => 0);
				}


			}
			if ($test) echo " very end location <br> ";
			$data[$i++] = array('end_location' => 1, 'end_month' => 0, 'location' => 0, 'event_date' => 0, 'mc' => $mc, 'ec' => $ec, 'month' => 0);

			$j++;
		}
		return ($data);
	}
}
// end of model class