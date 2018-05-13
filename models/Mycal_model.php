<?php

class Mycal_model extends CI_Model
{

	var $conf;

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => site_url() . 'mycal/display'
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

	function get_calendar_data($year, $month)
	{
		$query = $this->db->query("SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-%e') AS date
                                            FROM event
                                            WHERE date LIKE '$year-$month%' "); //date format eliminates zeros make
		//days look 05 to 5

		$cal_data = array();

		foreach ($query->result() as $row) { //for every date fetch data
			$a = array();
			$i = 0;
			$query2 = $this->db->query("SELECT *
                                                FROM event
                                                WHERE date LIKE DATE_FORMAT('$row->date', '%Y-%m-%d') ");
			//date format change back the date format
			//that fetched earlier
//                     foreach ($query2->result() as $r) {
//                         $a[$i] = $r->data;     //make data array to put to specific date
//                         $i++;                         
//                     }
			foreach ($query2->result() as $r) {
				$employees = $this->event_to_employee_model->get_employee_string($r->event_id);
				$code = $this->activity_model->get_activity_code($r->activity_id);
				$data = $code . ' ' . $r->available . '/' . $r->capacity_max . ' ' . $employees;
				$a[$i] = $data;     //make data array to put to specific date
				$i++;
			}
			$cal_data[substr($row->date, 8, 2)] = $a;

		}

		return $cal_data;
	}

	function vvget_calendar_data($year, $month)
	{

		$query = $this->db->select('date, data')->from('calendar')
			->like('date', "$year-$month", 'after')->get();

		$cal_data = array();

		foreach ($query->result() as $row) {
			$cal_data[substr($row->date, 8, 2)] = $row->data;
		}

		return $cal_data;

	}

	function add_calendar_data($date, $data)
	{

		if ($this->db->select('date')->from('event')
			->where('date', $date)->count_all_results()
		) {

			$this->db->where('date', $date)
				->update('calendar', array(
					'date' => $date,
					'data' => $data
				));

		} else {

			$this->db->insert('calendar', array(
				'date' => $date,
				'data' => $data
			));
		}

	}

	function generate($year, $month)
	{

		$this->load->library('calendar', $this->conf);

		$cal_data = $this->get_calendar_data($year, $month);

		return $this->calendar->generate($year, $month, $cal_data);

	}
}
