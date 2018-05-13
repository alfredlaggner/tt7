<?php

class Discount_to_activity_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('discount_to_activity');
		return $query->result();
	}

	function get_discount_to_activity_records($discount_id)
	{
		$this->db->select('*');
		$this->db->from('discount_to_activity');
		$this->db->where('discount_id', $discount_id);
		$this->db->join('activity', 'activity.activity_id = discount_to_activity.activity_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_activity_records($discount_id)
	{
		$this->db->where('discount_id', $discount_id);
		$query = $this->db->get('activity');
		return $query->result();
	}


	function get_record($discount_id)
	{
		$this->db->where('discount_id', $discount_id);
		$query = $this->db->get('discount_to_activity');
		return $query->result();
	}

	function add_record($discount_id, $activity_count)
	{
		for ($i = 1; $i <= $activity_count; $i++) {
			$checked = 'activity_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$activity_id = 'activity_id' . $i;
				$activity_id_val = $this->input->post($activity_id);

//echo "activity_id =	" .	$activity_id . "<br>";
//echo "activity_id_val =	" .	$activity_id_val . "<br>";

				$this->db->query("REPLACE INTO discount_to_activity (discount_id, activity_id) VALUES ('$discount_id','$activity_id_val')");
			};
		};
		return;
	}

	function update_record($data)
	{
		$this->db->where('discount_id', $this->uri->segment(3));
		$this->db->update('discount_to_activity', $data);
	}

	function delete_record($discount_id, $activity_id)
	{
		$this->db->where('discount_id', $discount_id);
		$this->db->where('activity_id', $activity_id);
		$this->db->delete('discount_to_activity');
	}

	function delete_activity_records($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->delete('discount_to_activity');
	}

	function delete_discount_records($discount_id)
	{
		$this->db->where('discount_id', $discount_id);
		$this->db->delete('discount_to_activity');
	}

}