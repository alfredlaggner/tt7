<?php

class mail_sent_model extends CI_Model
{

	function get_records($mail_from = 0, $mail_to = 0)
	{
		$this->db->select('
				customer.first_name ,
				customer.last_name ,
				customer.email, 
				mail.*');
		$this->db->join('customer', 'customer.customer_id=mail.customer_id');
		$this->db->order_by('date_time', 'desc');
		$this->db->where('is_incoming', MAIL_OUTGOING);
		if ($mail_from) $this->db->where('DATE(date_time) >=', $mail_from);
		if ($mail_to) $this->db->where('DATE(date_time) <=', $mail_to);
		$query = $this->db->get('mail');
		return $query->result();
	}


	function get_mail_sent_name($mail_sent_id)
	{
		$this->db->where('mail_sent_id', $mail_sent_id);
		$query = $this->db->get('mail_sent');
		foreach ($query->result() as $row) {
			return $row->name;
		}
	}

	function get_record($mail_id = 0)
	{
		if ($mail_id)
			$this->db->where('mail_id', $mail_id);
		else
			$this->db->where('mail_id', $this->uri->segment(3));

		$this->db->join('customer', 'customer.customer_id=mail.customer_id');
		$query = $this->db->get('mail');
		return $query->result();
	}


	function add_record($data)
	{
		$this->db->insert('mail', $data);
		return;
	}

	function update_record($mail_id)
	{
		$this->db->where('mail_id', $mail_id);
		$this->db->update('mail', $data);
	}

	function delete_record($mail_id)
	{
		$this->db->where('mail_id', $mail_id);
		$this->db->delete('mail');
	}

}