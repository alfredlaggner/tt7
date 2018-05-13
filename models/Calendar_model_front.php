<?php

class Calendar_model_front extends CI_Model
{

	var $conf;

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => site_url() . 'tt2/display'
		);

		$this->conf['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';

	}

//      $query2 = $this->db->query("SELECT 
//		event.activity_id , 
//		event.event_id as event_event_id, 
//		event.date as event_date, 
//		event.time as event_time, 
//		event.capacity_max as capacity,
//		event.available as available,
//		activity.activity_id  as activity_activity_id, 
//		activity.name as activity_name,
//		activity.code as code,
//		activity.duration as duration,
//		activity.rate_plan_id as activity_rate_plan_id
//		\n"
//		. "FROM   
//		event, 
//		activity
//		\n"
//		. "WHERE (\n"
//		. "event.activity_id=activity.activity_id AND
//	      event.date LIKE DATE_FORMAT('$row->date', '%Y-%m-%d')\n"
//		. ")\n"
//		. "ORDER BY event.time ASC \n" 
//		. " "
//		
//		);

	function get_calendar_data($year, $month, $activity_id = 0, $location_id = 0)
	{
		$query = $this->db->query("SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%e') AS date
                                            FROM event
                                            WHERE date LIKE '$year-$month%' "); //date format eliminates zeros make
		//days look 05 to 5

//$activity_id =  $this->session->userdata('activity_id'); 
//$location_id =  $this->session->userdata('location_id'); 
		$style_id = $this->session->userdata('style_id');
		$region_id = $this->session->userdata('region_id');
		$is_booked = $this->session->userdata('is_booked');
		$is_finished = $this->session->userdata('is_finished');
//echo "activity id = ". $activity_id;
//echo "location id = ". $location_id;
//echo "style id = ". $style_id;
//echo "is_booked = " . $is_booked;	
//echo "region_id = " . $region_id;	
//echo "<br>is_finished= " . $is_finished ; 


		$cal_data = array();

		foreach ($query->result() as $row) { //for every date fetch data
			$a = array();
			$i = 0;
//echo $row->date .' ';
//echo date('Y m d',strtotime( $row->date)).' ';
//echo date('Y-m-j',strtotime( $row->date)).' ';
			//echo '<br>';
			$this->db->select('
		location.*,
		event.activity_id ,
		event.event_id AS event_event_id, 
		event.date AS event_date, 
		event.is_deleted, 
		event.time AS event_time, 
		event.capacity_max AS capacity,
		event.available AS available,
		event.attending AS attending,
		activity.activity_id  AS activity_activity_id, 
		activity.name AS activity_name,
		activity.code AS code,
		activity.duration AS duration,
		activity.style_id,
		activity.rate_plan_id AS activity_rate_plan_id');

			$this->db->join('activity', 'event.activity_id=activity.activity_id');
			$this->db->join('location', 'event.location_id=location.location_id');

			$this->db->where("event.date LIKE DATE_FORMAT('$row->date', '%Y-%m-%d')");
//		->where("event.date = '$row->date'")

			if ($activity_id) $this->db->where("activity.activity_id", $activity_id);
			if ($location_id) $this->db->where("event.location_id", $location_id);
			if ($style_id) $this->db->where("activity.style_id", $style_id);
			if ($region_id) $this->db->where("location.region_id", $region_id);
			if ($is_booked) {
//			$where = "event.capacity_max > event.attending";
				$where = "event.attending > 0";
				$this->db->where($where);
			}
			if ($is_finished)
				$this->db->where("event.date < ", date('Y-m-d'));
			else
				$this->db->where("event.date >= ", date('Y-m-d'));


			$this->db->order_by('event.time', 'ASC');
			$query2 = $this->db->get('event');;

			$activities = array();
//		$query1 = $query2; // its a patch
//echo $this->db->last_query();

			foreach ($query2->result_array() as $row) {
//echo $row['event_date'];			
//echo '<br>';
				$row['tax'] = 0.00;
				$row['discount'] = 0.00;

				$row = $this->activity_booking_model->new_get_eff_date($row, $row['activity_id'], $row['event_date']);
				$row = $this->activity_booking_model->get_discount($row, $row['activity_activity_id'], $row['event_date']);
				$row = $this->activity_booking_model->get_tax($row, $row['activity_activity_id']);
				array_push($activities, $row);
			}
			foreach ($activities as $row) {
//echo $row['event_date'];			
//echo '<br>';
				if ($row['is_deleted'])
					$disp_red = " style='color: red; '";
				else
					$disp_red = "";
				$employees = $this->event_to_employee_model->get_employee_string($row['event_event_id']);
				$event_time = '<span' . $disp_red . '>' . date('H:i', strtotime($row['event_time'])) . '</span>';
				$title_1 = $this->make_title("Manage Attendants", $row, $employees);
				$title_2 = $this->make_title("Change Event", $row, $employees);
				$title_3 = $this->make_title("Select Instructors", $row, $employees);

				$full_data = $event_time . ' ' .
					'<a  ' . $disp_red .
					'class = "tooltip" 
			 title = "' . $title_2 .
					'" href="' . site_url() . 'event/event_view/' . $row['event_event_id'] . '/' . $row['activity_activity_id'] . '/1">' . $row['code'] . '</a>  ';


				$attending = $row['capacity'] - $row['attending'];

//			if ($row['capacity'] - $row['attending'] > 0)
				$full_data .= '<a ' . $disp_red .
					'class = "tooltip" 
			 title = "' . $title_1 .
					'" href="' . site_url() . 'customer_contact/customers_by_event/' . $row['event_event_id'] . '/' . $row['location_id'] . '">' . ($row['capacity'] - $row['attending']) . '/' . $row['capacity'] . '</a>  ';

				$full_data .=
					'<a ' . $disp_red .
					'class = "tooltip" 
			 title = "' . $title_3 .
					'" href="' . site_url() . 'event/assign_employees/' . $row['event_event_id'] . '/' . $row['activity_activity_id'] . '">'
					. $employees . '</a>';


				$a[$i] = $full_data;     //make data array to put to specific date
				$i++;
			}
//		print_r($a);
			if ($a)
				$cal_data[intval(substr($row['event_date'], 8, 2))] = $a;

//echo 'day=' . substr($row['event_date'],8,2)	;  
//echo '<br>';
		}

		return $cal_data;
	}

	function make_title($link_to, $row, $employees)
	{
		$t =
			"<h3>" . $link_to . "</h3>" .
			" . " . $row['activity_name'] . "<br>" .
			"  . Id: " . $row['event_event_id'] . "<br>" .
			"  . Location: " . $row['name'] . "<br>" .
			"  . Duration: " . $row['duration'] . " hours" . "<br>" .
			"  . Price: " . $row['rate_price'] .
			"  . Discount: " . $row['discount'] . "<br>" .
			"  . Instructors: " . $employees;
		return $t;
	}

	function generate($year, $month)
	{

		$this->load->library('calendar', $this->conf);

		$cal_data = array();
		$cal_data = $this->get_calendar_data($year, $month);
//print_r($cal_data);	die();	
		return $this->calendar->generate($year, $month, $cal_data);

	}
}
