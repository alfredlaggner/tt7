<?php

class Employee_cms_model extends CI_Model
{

	function get_records($employee_id)
	{
		$query = $this->db->order_by('cms_eff_date', 'desc')
			->where('employee_id', $employee_id)
			->get('employee_cms');
		return $query->result();
	}

	function get_commission($employee_id, $on_date)
	{
		$query = $this->db->order_by('cms_eff_date', 'desc')
			->where('employee_id', $employee_id)
			->where('cms_eff_date <= ', $on_date)
			->get('employee_cms');
		foreach ($query->result() as $row) {
			return $row->cms_amount;
		}

	}

	function calc_commission($employee_id)
	{
		$query = $this->db
			->order_by('ledger.ledger_id', 'asc')
			->order_by('employee_cms.cms_eff_date', 'desc')
			->join('event_to_employee', 'ledger.event_id = event_to_employee.event_id', 'left')
			->join('employee_cms', 'event_to_employee.employee_id = employee_cms.employee_id', 'left')
			->where('employee_cms.employee_id', $employee_id)
			->get('ledger');
		$ledger_id = 0;
		$commissions = array();

		foreach ($query->result() as $row) {
			if ($row->cms_eff_date <= substr($row->booking_date, 0, 10) and $ledger_id != $row->ledger_id) {
				echo $row->ledger_id . ':' .
					$row->event_id . ', ' .
					$row->employee_id . ', ' .
					$row->cms_amount . '%, ' .
					$row->price . '%, ' .
					$row->price * $row->cms_amount / 100 . '$ commission, ' .
					substr($row->booking_date, 0, 10) . ', ' .
					$row->cms_eff_date .
					'<br>';
				array_push($commissions, $row);

			}
			$ledger_id = $row->ledger_id;

		}
		return $commissions;
	}

	function get_record($employee_cms_id)
	{
		$query = $this->db->where('employee_cms_id', $employee_cms_id)->get('employee_cms');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('employee_cms', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('employee_cms_id', $this->uri->segment(3));
		$this->db->update('employee_cms', $data);
	}

	function delete_record()
	{
		$this->db->where('employee_cms_id', $this->uri->segment(3));
		$this->db->delete('employee_cms');
	}

	function delete_employee_cms()
	{
		$this->db->where('employee_id', $this->uri->segment(3));
		$this->db->delete('employee_cms');
	}
}