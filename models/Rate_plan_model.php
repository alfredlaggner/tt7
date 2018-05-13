<?php

class Rate_plan_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('rate_plan');
		return $query->result();
	}

//all rate_plans with tax plan data
	function get_records_full()
	{
		$query = $this->db->query('
			SELECT 
			rate_plan.name AS rate_plan_name,
			rate_plan.rate_plan_id,
			rate_plan.is_active,
			rate_plan.type,
			tax_plan.name AS tax_plan_name
			FROM rate_plan
			LEFT JOIN 
				tax_plan 
			ON 
				tax_plan.tax_plan_id = rate_plan.tax_plan_id');
		return $query->result();
	}

	function get_rate_plan_records($rate_plan_id)
	{
		$this->db->order_by('rate_plan_id', 'asc');
		$this->db->where('rate_plan_id', $rate_plan_id);
		$query = $this->db->get('rate_plan');
		return $query->result();
	}

	function get_record($rate_plan_id)
	{
		$this->db->where('rate_plan_id', $rate_plan_id);
		$query = $this->db->get('rate_plan');
		return $query->result();
	}

	function get_rate_plan_name($rate_plan_id)
	{
		$this->db->where('rate_plan_id', $rate_plan_id);
		$query = $this->db->get('rate_plan');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_rate_plan_id()
	{
		$this->db->where('rate_plan_id', $this->uri->segment(3));
		$query = $this->db->get('rate_plan');
		foreach ($query->result() as $row) {
			return $row->rate_plan_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('rate_plan', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('rate_plan_id', $this->uri->segment(3));
		$this->db->update('rate_plan', $data);
	}

	function delete_record()
	{
		$this->db->where('rate_plan_id', $this->uri->segment(3));
		$this->db->delete('rate_plan');
	}

}