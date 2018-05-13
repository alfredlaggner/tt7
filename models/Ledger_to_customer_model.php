<?php

class Ledger_to_customer_model extends CI_Model
{

	function get_records()
	{
		$this->db->order_by('booking_date', 'asc');
		$this->db->order_by('booking_time', 'asc');
		$query = $this->db->get('ledger_to_customer');
		return $query->result();
	}

	function get_attendants($ledger_id)
	{

		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('ledger_to_customer', 'ledger_to_customer.customer_id = customer.customer_id');
		$this->db->where('ledger_to_customer.ledger_id', $ledger_id);

		$query = $this->db->get();

		return $query->result();
	}

	function get_nr_filled_out($ledger_id)
	{
		$this->db->where('ledger_id', $ledger_id);
		$query = $this->db->get('ledger_to_customer');
		return $query->num_rows();
	}

	function get_ledger_to_customer_name($ledger_to_customer_id)
	{
		$this->db->where('ledger_to_customer_id', $ledger_to_customer_id);
		$query = $this->db->get('ledger_to_customer');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function count_all()
	{
		return $this->db->count_all('ledger_to_customer');
	}

	function get_record($ledger_to_customer_id = 0)
	{
		if (!$ledger_to_customer_id)
			$this->db->where('ledger_to_customer_id', $this->uri->segment(3));
		else
			$this->db->where('ledger_to_customer_id', $ledger_to_customer_id);

		$query = $this->db->get('ledger_to_customer');
		return $query->result();
	}

	function add_record($ledger_id, $customer_id, $main_customer)
	{
		$data = array(
			'ledger_id' => $ledger_id,
			'main_customer' => $main_customer,
			'customer_id' => $customer_id);
		$this->db->insert('ledger_to_customer', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('ledger_to_customer_id', $this->uri->segment(3));
		$this->db->update('ledger_to_customer', $data);
	}

	function delete_record()
	{
		$this->db->where('ledger_to_customer_id', $this->uri->segment(3));
		$this->db->delete('ledger_to_customer');
	}
}