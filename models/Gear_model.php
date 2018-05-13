<?php

class Gear_model extends CI_Model
{

	function get_records($gear_group_id = 0)
	{
		if ($gear_group_id)
			$this->db->where('gear.gear_group_id', $gear_group_id);

		$this->db->order_by('code', 'asc');
		$this->db->join('account', 'gear.account_id = account.account_id', 'left');
		$query = $this->db->get('gear');
		return $query->result();
	}

	function count_all()
	{
		return $this->db->count_all('gear');
	}


	function get_record($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('gear');
		return $query->result();
	}

	function get_gear_name($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('gear');

		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_gear_description_short($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('gear');

		foreach ($query->result() as $row) {
			return $row->description_short;
		}
	}

	function get_gear_code($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('gear');

		foreach ($query->result() as $row) {
			return $row->code;
		}
	}

	function add_record($data)
	{
		$this->db->insert('gear', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('gear_id', $this->uri->segment(3));
		$this->db->update('gear', $data);
	}

	function delete_record()
	{
		$this->db->where('gear_id', $this->uri->segment(3));
		$this->db->delete('gear');
	}

}