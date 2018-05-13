<?php

class Customer_contact_type_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->order_by('code')
			->get('customer_contact_type');
		return $query->result();
	}

	function get_type_code($customer_contact_type_id)
	{
		$this->db->where('customer_contact_type_id', $customer_contact_type_id);
		$query = $this->db->get('customer_contact_type');
		foreach ($query->result() as $row) {
			return $row->code;
		}
	}

	function get_type_name($customer_conact_type_id)
	{
		$this->db->where('customer_contact_type_id', $customer_conact_type_id);
		$query = $this->db->get('customer_contact_type');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function add_record($data)
	{
		$this->db->insert('customer_contact_type', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('customer_contact_type_id', $this->uri->segment(3));
		$this->db->update('customer_contact_type', $data);
	}

	function delete_record()
	{
		$this->db->where('customer_contact_type_id', $this->uri->segment(3));
		$this->db->delete('customer_contact_type');
	}

}