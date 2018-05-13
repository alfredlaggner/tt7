<?php

class Rate_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'asc');
		$query = $this->db->get('rate');
		return $query->result();
	}

	function get_rate_plan_records($rate_plan_id)
	{
		$this->db->order_by('rate_plan_id', 'asc');
		$this->db->where('rate_plan_id', $rate_plan_id);
		$query = $this->db->get('rate');
		return $query->result();
	}

	function get_record($rate_id)
	{
		$this->db->where('rate_id', $rate_id);
		$query = $this->db->get('rate');
		return $query->result();
	}

	function get_rate_name($rate_id)
	{
		$this->db->where('rate_id', $rate_id);
		$query = $this->db->get('rate');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_rate_id()
	{
		$this->db->where('rate_id', $this->uri->segment(3));
		$query = $this->db->get('rate');
		foreach ($query->result() as $row) {
			return $row->rate_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('rate', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('rate_id', $this->uri->segment(3));
		$this->db->update('rate', $data);
	}

	function delete_record()
	{
		$this->db->where('rate_id', $this->uri->segment(3));
		$this->db->delete('rate');
	}

}