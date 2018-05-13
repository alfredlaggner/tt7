<?php

class Event_model extends CI_Model
{

	function xxget_records()
	{
		$query = $this->db->get('event');
		return $query->result();
	}

	function get_records($activity_id)
	{
		$this->db->order_by('date', 'desc');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('event');
		return $query->result();
	}

	function get_by_location($activity_id)
	{

		$region_id = $this->session->userdata('region_id') ? $this->session->userdata('region_id') : false;
		if ($region_id) $this->db->where('region.region_id', $region_id);
		$this->db->where('event.activity_id', $activity_id);
		$this->db->join('location', 'event.location_id=location.location_id');
		$this->db->join('region', 'region.region_id=location.region_id');
		$this->db->join('coordinates', 'location.location_id=coordinates.location_id');
		$this->db->group_by('event.location_id');
		$this->db->order_by('date');
		$query = $this->db->get('event');
		return $query->result();
	}

	function get_by_location_v2()
	{
		$region_id = $this->session->userdata('region_id');
		$this->db->order_by('date');
//		->where('event.activity_id', $activity_id)
		$this->db->select('region.*,activity.*,location.*,event.*,
				activity.name AS activity_name');
		if ($region_id) $this->db->where('region.region_id', $region_id);
		$this->db->where("event.is_deleted", FALSE);
		$this->db->join('activity', 'activity.activity_id = event.activity_id');
		$this->db->join('location', 'event.location_id=location.location_id');
		$this->db->join('region', 'region.region_id=location.region_id');
		$this->db->group_by('event.location_id');
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			echo $row->activity_name . '<br>';
		}

		return false;
	}

	function get_by_location_v1($activity_id)
	{
		$region_id = $this->session->userdata('region_id');
		$region_id=false;
		if ($region_id) $this->db->where("location.region_id", $region_id);
		$this->db->order_by('date');
		$this->db->select('location.*,coordinates.*');
		$this->db->where('event.activity_id', $activity_id);
//		$this->db->where('location.location_id', 5);
		$this->db->join('location', 'event.location_id=location.location_id');
		$this->db->join('coordinates', 'location.location_id=coordinates.location_id');
		$this->db->where("event.is_deleted", FALSE);
		$this->db->where('event.date >=', date("Y-m-d"));
		$this->db->group_by('event.location_id');
		$query = $this->db->get('event');

		return $query->result();
	}

	function get_location_ids($activity_id)
	{
		$query = $this->db->order_by('date')
			->where('event.activity_id', $activity_id)
			->group_by('event.location_id')
			->get('event');
		$location_ids = array();
		foreach ($query->result() as $row) {
			if ($row->location_id > 0)
				$location_ids[] = $row->location_id;
		}
		return $location_ids;
	}

	function get_initials($activity_id)
	{
		$initials = array();
		$this->db->order_by('date');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			$initials .= $this->event_to_employee_model->get_employee_string($row->event_id);
		}
		return $initials;
	}

	function get_record($event_id)
	{
		$query = $this->db->where('event_id', $event_id)
			->select('location.name as location_name, location.directions as location_directions,  activity.name as activity_name, activity.duration as activity_duration, activity.code as activity_code, activity.*, event.*, location.* ')
			->join('activity', 'event.activity_id=activity.activity_id', 'right')
			->join('location', 'event.location_id=location.location_id', 'right')
			->get('event');
		return $query->result();
	}

	function get_event_instructor($event_id)
	{
		$this->db->where('event_id', $event_id);
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			return $row->instructor_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('event', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('event_id', $this->uri->segment(3));
		$this->db->update('event', $data);
	}

	function update_available($event_id, $data)
	{
		$this->db->where('event_id', $event_id);
		$this->db->update('event', $data);
	}

	function delete_record()
	{
		$this->db->where('event_id', $this->uri->segment(3));
		$this->db->delete('event');
	}

}