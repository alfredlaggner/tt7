<?php

class Activity_booking_model extends CI_Model
{

	function get_booking($event_id = 0, $activity_id = 0, $location_id = 0)
	{


		$this->db->select('
				event.activity_id ,
				event.event_id AS event_event_id, 
				event.date AS event_date, 
				event.time AS event_time, 
				event.capacity_max AS capacity,
				event.available AS available,
				event.attending AS attending,
				event.location_id,
				location.*,
				location.name as location_name,
				activity.activity_id  AS activity_activity_id, 
				activity.name AS activity_name,
				activity.code AS code,
				activity.is_questionaire,
				activity.duration AS duration,
				activity.rate_plan_id AS activity_rate_plan_id');
		$this->db->join('activity', 'event.activity_id=activity.activity_id');
		$this->db->join('location', 'event.location_id=location.location_id');

		$this->db->where("event.is_deleted", FALSE);

		if ($event_id) $this->db->where("event.event_id", $event_id);
		if ($activity_id) $this->db->where("activity.activity_id", $activity_id);
		if ($location_id) $this->db->where("event.location_id", $location_id);
		$region_id = $this->session->userdata('region_id');

		$region_id = FALSE;
		if ($region_id) $this->db->where("location.region_id", $region_id);

//		$where = "event.date > DATE_ADD(NOW(), INTERVAL 1 DAY)";
//		$this->db->where($where);

		$this->db->where("event.date >= ", date('Y-m-d'));
		$this->db->order_by('event.date', 'ASC');
		$query = $this->db->get('event');

		$activities = array();
		define("SECONDS_PER_HOUR", 60 * 60);
		foreach ($query->result_array() as $row) {
			$row['tax'] = 0.00;
			$row['discount'] = 0.00;
			$row['is_two_days'] = false;

			$now = time(); // or your date as well
			$your_date = strtotime($row['event_date']);
			$datediff = ($your_date - ($now)) / SECONDS_PER_HOUR;
			$row['is_two_days'] = floor($datediff) <= 48;
			//    echo '<br> ' . $row['event_date'] . '= ' . floor($datediff) . "=" . $row['is_two_days']  ;			

//price		
			$row = $this->new_get_eff_date($row, $row['activity_id'], $row['event_date']);
//if ($row)
//{			
//echo' =' . $row['activity_activity_id'];	
//echo' pr-' . $row['rate_price'];	
//echo' dis+' . $row['discount'] .'<br>';
//};
//die();
			$row = $this->get_discount($row, $row['activity_activity_id'], $row['event_date']);
			$row = $this->get_tax($row, $row['activity_activity_id']);
			array_push($activities, $row);
//discount
//			array_push($activities,$row);
//taxes			

		}
//echo "Name=".$row['activity_name'];

		return $activities;
	}


	function get_records($event_id = 0, $activity_id = 0, $location_id = 0)
	{
		$activity_id = $this->session->userdata('activity_id');
		$location_id = $this->session->userdata('location_id');
		$style_id = $this->session->userdata('style_id');
		$region_id = $this->session->userdata('region_id');
		$is_booked = $this->session->userdata('is_booked');
		$is_finished = $this->session->userdata('is_finished');

//echo "<br>activity_id= " . $activity_id ; 
//echo "<br>location_id= " . $location_id ; 
//echo "<br>style_id= " . $style_id ; 
//echo "<br>region_id= " . $region_id ; 
//echo "<br>is_booked= " . $is_booked ; 
//echo "<br>is_finished= " . $is_finished ; 


		$this->db->select('
				event.is_deleted,
				event.activity_id ,
				event.event_id AS event_event_id, 
				event.date AS event_date, 
				event.time AS event_time, 
				event.capacity_max AS capacity,
				event.available AS available,
				event.attending AS attending,
				event.location_id,
				location.*,
				location.name as location_name,
				location.code as location_code,
				activity.activity_id  AS activity_activity_id, 
				activity.name AS activity_name,
				activity.code AS code,
				activity.duration AS duration,
				activity.rate_plan_id AS activity_rate_plan_id');
		$this->db->join('activity', 'event.activity_id=activity.activity_id');
		$this->db->join('location', 'event.location_id=location.location_id');

		if ($event_id) $this->db->where("event.event_id", $event_id);
		if ($activity_id) $this->db->where("activity.activity_id", $activity_id);
		if ($location_id) $this->db->where("event.location_id", $location_id);
		if ($style_id) $this->db->where("activity.style_id", $style_id);
		if ($region_id) $this->db->where("location.region_id", $region_id);
		if ($is_booked) {
//			$where = "event.capacity_max > event.attending";
			$where = "event.attending > 0";
			$this->db->where($where);
		}
		if ($is_finished) {
			$this->db->where("event.date < ", date('Y-m-d'));
			$this->db->order_by('event.date', 'DESC');
		} else {
			$this->db->where("event.date >= ", date('Y-m-d'));
			$this->db->order_by('event.date', 'ASC');
		}

		$this->db->where("event.available > ", "0");
		$query = $this->db->get('event');


		$activities = array();
//	$x= $query->result_array();
//print_r($x); die();		
		foreach ($query->result_array() as $row) {
			$row['tax'] = 0.00;
			$row['discount'] = 0.00;

//price		
			$row = $this->new_get_eff_date($row, $row['activity_id'], $row['event_date']);
//if ($row)
//{			
//echo' =' . $row['activity_activity_id'];	
//echo' pr-' . $row['rate_price'];	
//echo' dis+' . $row['discount'] .'<br>';
//};
//die();
			$row = $this->get_discount($row, $row['activity_activity_id'], $row['event_date']);
			$row = $this->get_tax($row, $row['activity_activity_id']);
			array_push($activities, $row);
//discount
//			array_push($activities,$row);
//taxes			

		}
//echo "Name=".$row['activity_name'];

		return $activities;
	}

	function new_get_eff_date($arow, $activity_id, $event_date)
	{
		$q_string =
			" SELECT
		rate_price.rate_id,
		rate_price.activity_id,
		rate_price.price as rate_price,
		rate_price.exp_discount_price,  
		rate_price.effective_date as rp_eff_date
		\n"
			. "FROM   
		rate_price
		\n"
			. "WHERE (\n"
			. "$activity_id = rate_price.activity_id\n"
			. ")\n"
			. "order by rate_price.effective_date desc \n"
			. " ";

		$query = $this->db->query($q_string);
		$arow['rate_price'] = 0.00;
		$arow['exp_discount_price'] = 0.00;
		$arow['rp_eff_date'] = date('Y-m-d');


		foreach ($query->result_array() as $row) {
//if ($row)
//{			
//echo'id=' . $row['activity_id'];	
//echo' effdate' . $row['rp_eff_date'] ;
//echo' <=  ' . $event_date.'?<br>';	
//}
//else
//echo 'nothing <br>';

			if ($row['rp_eff_date'] <= $event_date) {
				$arow['rate_price'] = $row['rate_price'];
				$arow['exp_discount_price'] = $row['exp_discount_price'];
				$arow['rp_eff_date'] = $row['rp_eff_date'];
//echo "a<br>";				
//print_r($arow['exp_discount_price']);				
//print_r($arow['rate_price']);				
//print_r($arow['rp_eff_date']);				
//				return $arow;
			}
		}
		return $arow;
//		return array();
	}

	function get_discount($activity, $activity_id, $event_date)
	{
		$q_string =
			" SELECT
		discount_to_activity.*, 
		discount.amount         as discount_amount,
		discount.amount_type    as discount_amount_type,
		discount.is_rule_active as discount_is_rule_active,
		discount.exp_date       as discount_exp_date,
		discount.promo_code     as discount_promo_code,
		discount.name           as discount_name
		\n"
			. "FROM   
		discount_to_activity,
		discount
		\n"
			. "WHERE (\n"
			. "$activity_id = discount_to_activity.activity_id\n"
			. "and discount.discount_id = discount_to_activity.discount_id \n"
			. "and discount.promo_code = '' \n"
			. ")\n"
			. "order by discount.exp_date desc \n"
			. " ";
		$query = $this->db->query($q_string);


		foreach ($query->result_array() as $discount) {

	//		echo $discount['discount_amount_type'];
	//		die();

			if ($discount['discount_exp_date'] >= $event_date && $discount['discount_is_rule_active']) {
				if ($discount['discount_amount_type'] == 'P') // percent
				{
					$activity['discount'] += $activity['rate_price'] / 100 * $discount['discount_amount'];
				} elseif ($discount['discount_amount_type'] == 'F') // fixed discount - nothing else matters
				{
					$activity['discount'] = $discount['discount_amount'];
//print_r($activity['discount']);

//					$activity['rate_price'] =  $activity['discount'];
					return $activity;
				} elseif ($discount['discount_amount_type'] == 'R') // reduced amount
				{
					$activity['discount'] += $discount['discount_amount'];
// echo "<br>added up discount...". $discount['discount'] ;			
				} elseif ($discount['discount_amount_type'] == 'A') // fixed amount
				{
					$activity['discount'] = $discount['discount_amount'];
// echo "<br>added up discount...". $discount['discount'] ;			
				} else {
				}
			}
		}
//		$activity['rate_price'] = $activity['rate_price'] - $activity['discount'];
		return $activity;
	}


	function get_promo_discount($activity, $activity_id, $event_date, $promo_code)
	{
		$q_string =
			" SELECT
		discount_to_activity.*, 
		discount.amount         as discount_amount,
		discount.amount_type    as discount_amount_type,
		discount.is_rule_active as discount_is_rule_active,
		discount.exp_date       as discount_exp_date,
		discount.promo_code     as discount_promo_code,
		discount.name           as discount_name
		\n"
			. "FROM   
		discount_to_activity,
		discount
		\n"
			. "WHERE (\n"
			. "$activity_id = discount_to_activity.activity_id\n"
			. "and discount.discount_id = discount_to_activity.discount_id \n"
			. "and discount.promo_code = '$promo_code' \n"
			. ")\n"
			. "order by discount.exp_date desc \n"
			. " ";

		$query = $this->db->query($q_string);

		$activity['discount'] = 0;
		$activity['discount_amount_type'] = 'F';

		foreach ($query->result_array() as $discount) {
			if ($discount['discount_exp_date'] >= $event_date && $discount['discount_is_rule_active']) {
				if ($discount['discount_amount_type'] == 'P') // percent
				{
					//				$activity['discount'] += $activity['rate_price']/ 100 * $discount['discount_amount'];
					$activity['discount'] = $discount['discount_amount'];
					$activity['discount_amount_type'] = $discount['discount_amount_type'];
				} elseif ($discount['discount_amount_type'] == 'F') // fixed discount - nothing else matters
				{
					$activity['discount'] = $discount['discount_amount'];
					print_r($activity['discount']);
					$activity['rate_price'] = $activity['discount'];
					$activity['discount_amount_type'] = $discount['discount_amount_type'];
					return $activity;
				} elseif ($discount['discount_amount_type'] == 'R') // reduced amount
				{
					$activity['discount'] += $discount['discount_amount'];
					$activity['discount_amount_type'] = $discount['discount_amount_type'];
//echo "<br>added up discount...". $discount['discount'] ;			
				} elseif ($discount['discount_amount_type'] == 'A') // fixedamount
				{
					$activity['rate_price'] = $discount['discount_amount'];
					$activity['discount'] = $discount['discount_amount'];
					$activity['discount_amount_type'] = $discount['discount_amount_type'];
//echo "<br>added up discount...". $discount['discount'] ;			
				} else {
				}
			}
		}
//		$activity['rate_price'] = $activity['rate_price'] - $activity['discount'];
		return $activity;
	}

	function get_tax($activity, $activity_id, $nr_people = 1, $nr_days = 1)
	{
		$q_string =
			" SELECT
		activity.activity_id, 
		activity.tax_plan_id, 
		tax_plan.*, 
		tax_plan_to_tax.*, 
		tax.amount         as tax_amount,
		tax.amount_type    as tax_amount_type,
		tax.is_exempt	   as tax_is_exempt,
		tax.person_or_reservation  as tax_person_or_reservation
		\n"
			. "FROM   
		activity,
		tax_plan_to_tax,
		tax_plan,
		tax
		\n"
			. "WHERE (\n"
			. "$activity_id = activity.activity_id\n"
			. "and activity.tax_plan_id = tax_plan_to_tax.tax_plan_id\n"
			. "and tax_plan_to_tax.tax_id= tax.tax_id  \n"
			. ")\n"
			. " ";

		$query = $this->db->query($q_string);
		foreach ($query->result_array() as $tax) {
			if (!$tax['tax_is_exempt']) {
				if ($tax['tax_amount_type'] == 'P') // percent
				{
					$activity['tax'] += $activity['rate_price'] / 100 * $tax['tax_amount'];
				} elseif ($tax['tax_amount_type'] == 'G') // reduced amount
				{
					$activity['tax'] += $tax['tax_amount'];
				} elseif ($tax['tax_amount_type'] == 'D') // reduced amount per day
				{
					$activity['tax'] += $tax['tax_amount'] * $nr_days;
				}

				if ($tax['tax_person_or_reservation'] == "P") // tax per person
				{
					$activity['tax'] += $tax['tax_amount'] * $nr_people;
				}
			}
		}


		return $activity;
	}


	function get_eff_date($arow, $activity_rate_plan_id, $event_date)
	{
		$q_string =
			" SELECT
		rate_plan.*, 
		rate.*,
		rate_price.rate_id,		
		rate_price.exp_discount_price
		rate_price.price as rate_price,
		rate_price.effective_date as rp_eff_date
		\n"
			. "FROM   
		rate_plan,
		rate,
		rate_price
		\n"
			. "WHERE (\n"
			. "$activity_rate_plan_id = rate_plan.rate_plan_id\n"
			. "and rate_plan.rate_plan_id = rate.rate_plan_id \n"
			. "and rate.rate_id = rate_price.rate_id\n"
			. ")\n"
			. "order by rate_price.effective_date desc \n"
			. " ";

		$query = $this->db->query($q_string);
		foreach ($query->result_array() as $row) {

			if ($row['rp_eff_date'] <= $event_date) {
				$arow['rate_price'] = $row['rate_price'];
				$arow['exp_discount_price'] = $row['exp_discount_price'];
//echo "b<br>";				
//print_r($arow['exp_discount_price']);				

				$arow['rp_eff_date'] = $row['rp_eff_date'];
				return $arow;
			}
		}
		return array();
	}

	function xget_discount($activity, $activity_id, $event_date)
	{
		$q_string =
			" SELECT
		discount_to_activity.*, 
		discount.amount         as discount_amount,
		discount.amount_type    as discount_amount_type,
		discount.is_rule_active as discount_is_rule_active,
		discount.exp_date       as discount_exp_date
		\n"
			. "FROM   
		discount_to_activity,
		discount
		\n"
			. "WHERE (\n"
			. "$activity_id = discount_to_activity.activity_id\n"
			. "and discount.discount_id = discount_to_activity.discount_id \n"
			. ")\n"
			. "order by discount.exp_date desc \n"
			. " ";

		$query = $this->db->query($q_string);
		foreach ($query->result_array() as $discount) {
			if ($discount['discount_exp_date'] >= $event_date and $discount['discount_is_rule_active']) {
				if ($discount['discount_amount_type'] == 'P') // percent
				{
					$activity['discount'] += $activity['rate_price'] / 100 * $discount['discount_amount'];
				} elseif ($discount['discount_amount_type'] == 'F') // fixed discount - nothing else matters
				{
					$activity['discount'] = $discount['discount_amount'];
					$activity['rate_price'] = $activity['discount'];
					return $activity;
				} elseif ($discount['discount_amount_type'] == LEDGER_RESERVED) // reduced amount
				{
					$activity['discount'] += $discount['discount_amount'];
				}
			}
		}
//		$activity['rate_price'] = $activity['rate_price'] - $activity['discount'];
		return $activity;
	}


	function get_initials($activity_id)
	{
		$initials = array();
		$this->db->order_by('date');
		$this->db->where('activity_id', $activity_id);
		$query = $this->db->get('activity_booking');
		foreach ($query->result() as $row) {
			$initials .= $this->activity_booking_to_employee_model->get_employee_string($row->activity_booking_id);
		}
		return $initials;
	}

	function get_record($activity_booking_id)
	{
		$this->db->where('activity_booking_id', $activity_booking_id);
		$query = $this->db->get('activity_booking');
		return $query->result();
	}

	function get_activity_booking_instructor($activity_booking_id)
	{
		$this->db->where('activity_booking_id', $activity_booking_id);
		$query = $this->db->get('activity_booking');
		foreach ($query->result() as $row) {
			return $row->instructor_id;
		}
	}

	function add_record($data)
	{
		$this->db->insert('activity_booking', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_booking_id', $this->uri->segment(3));
		$this->db->update('activity_booking', $data);
	}

	function delete_record()
	{
		$this->db->where('activity_booking_id', $this->uri->segment(3));
		$this->db->delete('activity_booking');
	}

	function mark_deleted($event_id)
	{

		$this->db->where('event_id', $event_id);
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			$is_deleted = $row->is_deleted;
		}
		$data = array('is_deleted' => !$is_deleted);
		$this->db->where('event_id', $event_id);
		$this->db->update('event', $data);

		$this->db->where('event_id', $event_id);
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			return $row->is_deleted;
		}
	}

	function count_booking($activity_id, $location_id, $month, $year)
	{

		$this->db->where("event.is_deleted", FALSE);

		if ($activity_id) $this->db->where("event.activity_id", $activity_id);
		if ($location_id) $this->db->where("event.location_id", $location_id);
		$this->db->where("YEAR(event.date)", $year);
		$this->db->where("MONTH(event.date)", $month);
		$this->db->from('event');
		return $this->db->count_all_results();
	}

}