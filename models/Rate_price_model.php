<?php

class Rate_price_model extends CI_Model
{

	function get_records($activity_id)
	{
		$this->db->order_by('effective_date', 'asc');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('rate_price');
		return $query->result();
	}

	function get_record($rate_price_id)
	{
		$this->db->where('rate_price_id', $rate_price_id);
		$query = $this->db->get('rate_price');
		return $query->result();
	}
//	function get_records($rate_id)
//	{
//		$this->db->order_by('rate_id','asc');
//		$this->db->where('rate_id',$rate_id);
//		$query = $this->db->get('rate_price');
//		return $query->result();
//	}
//	
//	function get_record($rate_id)
//	{
//		$this->db->where('rate_price_id', $rate_id);
//		$query = $this->db->get('rate_price');
//		return  $query->result();
//	}
//	
//	
	function add_record($data)
	{
		$this->db->insert('rate_price', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('rate_price_id', $this->uri->segment(3));
		$this->db->update('rate_price', $data);
	}

	function delete_record()
	{
		$this->db->where('rate_price_id', $this->uri->segment(3));
		$this->db->delete('rate_price');
	}

	function get_weekend_days($rate_price_id)
	{
		$this->db->where('rate_price_id', $rate_price_id);
		$query = $this->db->get('rate_price');
		foreach ($query->result() as $row) {
			return $row->weekend_days;
		}
	}

	function weekend_days($weekend_days)
	{
		$weekdays = array(
			"monday" => array("day_name" => "day1", "day" => "Mo", "day_selected" => substr($weekend_days, 0, 1)),
			"tuesday" => array("day_name" => "day2", "day" => "Tu", "day_selected" => substr($weekend_days, 1, 1)),
			"wednesday" => array("day_name" => "day3", "day" => "We", "day_selected" => substr($weekend_days, 2, 1)),
			"thursday" => array("day_name" => "day4", "day" => "Th", "day_selected" => substr($weekend_days, 3, 1)),
			"friday" => array("day_name" => "day5", "day" => "Fr", "day_selected" => substr($weekend_days, 4, 1)),
			"saturday " => array("day_name" => "day6", "day" => "Sa", "day_selected" => substr($weekend_days, 5, 1)),
			"sunday" => array("day_name" => "day7", "day" => "Su", "day_selected" => substr($weekend_days, 6, 1)),
		);
//		foreach ($weekdays as $row) 
//		{
//			echo $row['day_name']. '-';
//			echo $row['day_selected'] . '<br>';
//		}
//		

		return $weekdays;

	}

}