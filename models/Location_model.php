<?php

class Location_model extends CI_Model
{

	function get_records()
	{
		$this->db->select('*,location.location_id as location_id');
		$this->db->order_by('code', 'asc');
		$this->db->join('coordinates', 'coordinates.location_id = location.location_id','left');
		$query = $this->db->get('location');
		return $query->result();
	}

	function get_location_name($location_id)
	{
		$this->db->where('location_id', $location_id);
		$query = $this->db->get('location');

		foreach ($query->result() as $row) {
			//	echo $row->name;
			return $row->name;
		}
	}

	function get_record()
	{
		$this->db->where('location_id', $this->uri->segment(3));
		$query = $this->db->get('location');
		return $query->result();
	}

	function get_location($activity_id) // rework
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->limit(1);
		$query = $this->db->get('activity');
		foreach ($query->result() as $row) {
			$location_id = $row->location_id;
		}
		$this->db->where('location_id', $location_id);
		$query = $this->db->get('location');
		return $query->result();
	}

	function get_coordinates($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->limit(1);
		$query = $this->db->get('activity');
		$location_id = 0;
		foreach ($query->result() as $row) {
			$location_id = $row->location_id;
		}
		$this->db->where('location_id', $location_id);
		$query = $this->db->get('coordinates');
		return $query->result();
	}


	function add_record($data)
	{
		$this->db->insert('location', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('location_id', $this->uri->segment(3));
		$this->db->update('location', $data);
	}

	function delete_record()
	{
		$this->db->where('location_id', $this->uri->segment(3));
		$this->db->delete('location');
	}

}