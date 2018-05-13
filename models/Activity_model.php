<?php

class Activity_model extends CI_Model
{

	function get_records()
	{
		$query =
			$this->db->order_by('code', 'asc')
				->join('account', 'activity.account_id = account.account_id', 'left')
				->get('activity');
		return $query->result();
	}

	function count_all()
	{
		return $this->db->count_all('activity');
	}


	function get_names()
	{
		$this->db->select('activity_id, name');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');
		return $query->result();
	}

	function get_record($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');
		return $query->result();
	}

	function get_activity_name($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');

		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_activity_description_short($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');

		foreach ($query->result() as $row) {
			return $row->description_short;
		}
	}

	function get_activity_code($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');

		foreach ($query->result() as $row) {
			return $row->code;
		}
	}

	function get_activity_capacity($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity');
		foreach ($query->result() as $row) {
			return $row->capacity_max;
		}
	}

	function get_activity_to_region_records($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->join('region', 'region.region_id = activity_to_region.region_id');
		$query = $this->db->get('activity_to_region');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('activity', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_id', $this->uri->segment(3));
		$this->db->update('activity', $data);
	}

	function delete_record()
	{
		$this->db->where('activity_id', $this->uri->segment(3));
		$this->db->delete('activity');
	}

}