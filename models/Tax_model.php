<?php

class Tax_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('order', 'desc');
		$query = $this->db->get('tax');
		return $query->result();
	}

	function count_all()
	{
		return $this->db->count_all('tax');
	}


	function get_tax_plan_records($tax_plan_id)
	{
		$this->db->order_by('tax_plan_id', 'asc');
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax');
		return $query->result();
	}

	function get_record($tax_id)
	{
		$this->db->where('tax_id', $tax_id);
		$query = $this->db->get('tax');
		return $query->result();
	}

	function get_tax_name($tax_id)
	{
		$this->db->where('tax_id', $tax_id);
		$query = $this->db->get('tax');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_tax_id()
	{
		$this->db->where('tax_id', $this->uri->segment(3));
		$query = $this->db->get('tax');
		foreach ($query->result() as $row) {
			return $row->tax_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('tax', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('tax_id', $this->uri->segment(3));
		$this->db->update('tax', $data);
	}

	function delete_record()
	{
		$this->db->where('tax_id', $this->uri->segment(3));
		$this->db->delete('tax');
	}

}