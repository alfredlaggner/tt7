<?php

class Tax_plan_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('tax_plan');
		return $query->result();
	}

	function get_tax_plan_records($tax_plan_id)
	{
		$this->db->order_by('tax_plan_id', 'asc');
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax_plan');
		return $query->result();
	}

	function get_record($tax_plan_id)
	{
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax_plan');
		return $query->result();
	}

	function get_tax_plan_name($tax_plan_id)
	{
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax_plan');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_tax_plan_id()
	{
		$this->db->where('tax_plan_id', $this->uri->segment(3));
		$query = $this->db->get('tax_plan');
		foreach ($query->result() as $row) {
			return $row->tax_plan_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('tax_plan', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('tax_plan_id', $this->uri->segment(3));
		$this->db->update('tax_plan', $data);
	}

	function delete_record()
	{
		$this->db->where('tax_plan_id', $this->uri->segment(3));
		$this->db->delete('tax_plan');
	}

}