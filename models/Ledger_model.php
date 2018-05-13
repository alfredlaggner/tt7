<?php

class Ledger_model extends CI_Model
    {

        function get_overview_by_date($to_excel = false, $ledger_id = 0, $activity_id = 0, $location_id = 0, $region_id = 0, $event_date_from = '', $event_date_to = '', $booking_date_from = '', $booking_date_to = '', $customer_id = '') // get all info for summary
            {

                $this->db->select('customer.*,
				  activity.code as activity_code,
				  activity.name as activity_name,
				  event.*,
				  event.date,
				  event.time,
				  discount.name AS discount_name,
				  region.region_id,
				  region.region AS region_name,
				  location.name AS location_name,
				  location.code AS location_code,
				  ledger.price AS ledger_price,
				  ledger.*,
				  ledger.event_group_id,
				  ledger.ledger_id,
				  ledger.booking_date,
				  ledger.discount_amount_type,
				  ledger.promo_code,
				  ledger.discount ,
				  ledger.price ,
				  ledger.location_id ,
				  ledger.event_id ,
				  ledger.tax AS ledger_tax');

                if ($ledger_id)
                    $this->db->where('ledger.ledger_id', $ledger_id);
                if ($activity_id)
                    $this->db->where('ledger.activity_id', $activity_id);
                if ($location_id)
                    $this->db->where('ledger.location_id', $location_id);
                if ($customer_id)
                    $this->db->where('ledger.customer_id', $customer_id);
                if ($region_id)
                    $this->db->where('location.region_id', $region_id);

                $this->db->where('ledger.paid_code ', TRUE);
                $this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
                $this->db->join('event', 'ledger.event_id = event.event_id', 'right');
                $this->db->join('activity', 'ledger.activity_id = activity.activity_id', 'right');
                $this->db->join('location', 'ledger.location_id = location.location_id', 'right');
                $this->db->join('region', 'location.region_id = region.region_id', 'right');
                $this->db->join('discount', 'ledger.promo_code = discount.promo_code', 'right');

                if (!$to_excel)
                    $this->db->limit(500);

                if ($event_date_from && $event_date_to) {
                    $event_date_from = strtotime($event_date_from);
                    $event_date_to = strtotime($event_date_to);
                    $this->db->where("event.date >= ", date('Y-m-d', $event_date_from));
                    $this->db->where("event.date <= ", date('Y-m-d', $event_date_to));
                    $this->db->order_by("event.date", "asc");
                }
                if ($booking_date_from && $booking_date_to) {
                    $booking_date_from = strtotime($booking_date_from . ' 00:00:00');
                    $booking_date_to = strtotime($booking_date_to . ' 23:59:59');
                    $this->db->where("ledger.booking_date >= ", date('Y-m-d H:i:s', $booking_date_from));
                    $this->db->where("ledger.booking_date <= ", date('Y-m-d H:i:s', $booking_date_to));
                    $this->db->order_by("ledger.booking_date", "asc");
                }

                $this->db->order_by("ledger.booking_date", "desc");

                $query = $this->db->get('ledger');
                if (!$to_excel) {

                    return $query->result();
                } else {
                    //            die("hallo");
                    $this->excel->getProperties()->setCreator('Treks and tracks')
                        ->setLastModifiedBy('Jakob Laggner')
                        ->setTitle('Customer List')
                        ->setSubject('Email List')
                        ->setDescription('Temporary Excel Sheet');

                    // Create the worksheet
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setCellValue('A1', 'First_Name')
                        ->setCellValue('B1', 'Last Name')
                        ->setCellValue('C1', 'Email');

                    $output = array();
                    $this->load->dbutil();
                    $this->load->helper('download'); // call download helper
                    $filename = 'email_list.csv'; // name of csv file to download with data
                    force_download($filename, $this->dbutil->csv_from_result($query)); // download file
                    return false;

                }

            }

        function get_records()
            {
//		$query = $this->db
//			->order_by('date','asc')
//			->order_by('time','asc')
//		 	->get('ledger');
                $qstring =
                    "SELECT 
ledger.ledger_id AS ledger_ledger_id, name, date, time, duration, attending, instructor, price, discount, tax, status, main_customer, 
concat_ws('. ',SUBSTRING(first_name,1,1), last_name) as customer " .
                    "  FROM  ledger  " .
                    "LEFT JOIN  ledger_to_customer ON ledger_to_customer.ledger_id  = ledger.ledger_id " .
                    "LEFT JOIN customer ON ledger_to_customer.customer_id = customer.customer_id ";

                $query = $this->db->query($qstring);
                $data = array();
                foreach ($query->result() as $row) {

                    if ($row->main_customer OR $row->main_customer == NULL) {
                        array_push($data, $row);
                    }
                }

                return $data;
            }

        function get_activity_records($event_id)
            {
//		$query = $this->db
//			->order_by('date','asc')
//			->order_by('time','asc')
//		 	->get('ledger');
                $qstring =
                    "SELECT 
ledger.ledger_id AS ledger_ledger_id, name, attending,  price, discount, tax, status, main_customer, 
concat_ws('. ',SUBSTRING(first_name,1,1), last_name) as customer " .
                    "  FROM  ledger  " .
                    "LEFT JOIN customer ON ledger.customer_id = customer.customer_id " .
                    "WHERE  ledger.event_id = $event_id ";

                $query = $this->db->query($qstring);
                $data = array();
                foreach ($query->result() as $row) {

                    if ($row->main_customer OR $row->main_customer == NULL) {
                        array_push($data, $row);
                    }
                }

                return $data;
            }

        function get_record_by_event_customer($event_id, $customer_id)
            {
                $query = $this->db
                    ->where('event_id', $event_id)
                    ->where('customer_id', $customer_id)
                    ->limit(1)
                    ->get('ledger');
                foreach ($query->result() as $row) {
                    return $query->result();
                }

            }

        function get_activity_booked($event_id)
            {
                $query = $this->db->where('event_id', $event_id)->get('ledger');
                foreach ($query->result() as $row) {
                    return $query->result();
                }
            }


        function ycalc_fixed_discount($event_group_id) // calculate fixed discount
            {
                $query = $this->db
                    ->where('event_group_id', $event_group_id)
                    ->where('main_customer', 1)
                    ->get('ledger');

            }

        function xcalc_fixed_discount($event_group_id) // calculate fixed discount
            {
                $query = $this->db
                    ->where('event_group_id', $event_group_id)
                    ->get('ledger');

                $i = 1;
                foreach ($query->result() as $row) {
                    if ($i == 1) {
                        $rest_discount = $row->discount;
                        $total_discount = $row->discount;
                    } else
                        $rest_discount = $row->discount - $total_discount;

                    if ($rest_discount <= 0)
                        $rest_discount = 0;  // avoid negative values
                    $data = array(
                        'discount' => $rest_discount,
                    );
                    $this->db->where('ledger_id', $row->ledger_id);    //
                    $this->db->update('ledger', $data);
                    $i++;
                }
            }

        function get_email_name($event_group_id)
// for discount read ledger summary	(no payment record
            {
                $query = $this->get_summary($event_group_id);
                foreach ($query as $row) {
                    $email = $row->email;
                    break;
                }
                return ($email);
            }


        function get_summary($event_group_id, $isPaid = TRUE) // get all info for summary
            {
                if ($isPaid)
                    $this->db->select('customer.*,
					  activity.*,
					  customer.customer_id AS customer_customer_id,
					  activity.duration AS activity_duration,
					  payment.*,
					  location.name AS location_name,
					  location.description_long AS location_description_long,
					  event.*,
					  ledger.price AS ledger_price,
					  ledger.is_confirm_email_sent AS confirm_email_sent,
					  ledger.event_group_id,
					  ledger.exp_discount_price,
					  ledger.ledger_id,
					  ledger.discount_amount_type,
					  ledger.promo_code,
					  ledger.discount AS ledger_discount,
					  ledger.tax AS ledger_tax');
                else
                    $this->db->select('customer.*,
					  activity.*,
					  activity.duration AS activity_duration,
					  location.name AS location_name,
					  location.description_long AS location_description_long,
					  event.*,
					  ledger.price AS ledger_price,
					  ledger.is_confirm_email_sent AS confirm_email_sent,
					  ledger.event_group_id,
					  ledger.exp_discount_price,
					  ledger.ledger_id,
					  ledger.discount_amount_type,
					  ledger.promo_code,
					  ledger.discount AS ledger_discount,
					  ledger.tax AS ledger_tax');

                $this->db->where('ledger.event_group_id', $event_group_id);
                $this->db->where('ledger.status !=', LEDGER_DELETED);
//		->where('ledger.paid_code ', TRUE)
                $this->db->join('customer', 'ledger.customer_id = customer.customer_id', 'right');
                $this->db->join('event', 'ledger.event_id = event.event_id', 'right');
                $this->db->join('activity', 'ledger.activity_id = activity.activity_id', 'right');
                $this->db->join('location', 'ledger.location_id = location.location_id', 'right');
                if ($isPaid)
                    $this->db->join('payment', 'ledger.event_group_id = payment.ledger_id', 'left');
                $query = $this->db->get('ledger');
                foreach ($query->result() as $row) {
                    return $query->result();
                }
            }


        function payment_summary($payment_id)
            {
                $query = $this->db
                    ->select('customer.*,
				  payment.*,
				  activity.*,
				  location.name AS location_name,
				  event.*,
				  ledger.price AS ledger_price,
				  ledger.event_group_id,
				  ledger.ledger_id,
				  ledger.promo_code,
				  ledger.discount AS ledger_discount,
				  ledger.tax AS ledger_tax')
                    ->where('payment_id', $payment_id)
                    ->join('customer', 'payment.customer_id = customer.customer_id')
                    ->join('ledger', 'payment.ledger_id = ledger.ledger_id')
                    ->join('event', 'ledger.event_id = event.event_id')
                    ->join('location', 'payment.location_id = location.location_id', 'left')
                    ->join('activity', 'ledger.activity_id = activity.activity_id')
                    ->get('payment');
//		foreach ($query->result() as $row)
//		{
//		print_r($row);
//		}

//	die();	
                return $query->result();
            }

        function get_email_message_text($event_group_id)
            {
                $query = $this->get_summary($event_group_id);
//print_r($query);     
                foreach ($query as $row) {
                    $price = ($row->ledger_price - $row->ledger_discount < 0) ? 0 : $row->ledger_price - $row->ledger_discount;

//echo $price;			

                    if ($row->discount_amount_type == DISCOUNT_FIXED_AMOUNT)

                        $price = ($row->ledger_price - $row->ledger_discount < 0) ? '$0.00' : $row->ledger_price - $row->ledger_discount;

                    else
                        $price = $row->ledger_price - ($row->ledger_price / 100 * $row->ledger_discount);

                    $email =

                        '<html><body><h2>Thank you for booking! </h2>' .
                        '<h4>Activity: <span> ' . $row->name . '</span></h4>' .
                        '<h4>Location: <span> ' . $row->location_name . '</span></h4>' .
                        '<h4> Date/Time: <b>' .
                        date("F jS  Y ", strtotime($row->date)) .
                        '</b> from <b>' .
                        date("g:i a", strtotime($row->time)) .
                        '</b> to <b>' .
                        date("g:i a", strtotime($row->time) + $row->activity_duration * 3600) .
                        '</b></h4>' .
                        '<h3>Booking Details</h3>' .
                        '<p>Invoice Number: ' . $row->event_group_id . '</p>' .
                        '<p>Promo Code: ' . $row->promo_code . '</p>' .
                        '<p>Amount Paid: $ ' . $price . '</p>' .
                        '<h3>Please bring: </h3>' .
                        '<p>' . $row->they_bring . '</p>';
                    break;
                }
                // run again for names
                $email .= '<h3>Directions: </h3>';
                $email .=
                    '<p> ' . $row->location_description_long . '</p>';
                $email .= '<h3>Rescheduling: </h3>

<p>If a scheduling conflict arises and you need to reschedule, we are happy to reactivate your voucher. If a reschedule is requested within 10 days prior to your class, a $25 fee will apply.</p>';


                $email .= '<h3>Participants: </h3>';

                foreach ($query as $row) {

                    $email .=
                        '<p> ' . $row->first_name . ' ' . $row->last_name . '</p>';
                }
                $email .=

                    '<p> &nbsp;</p>' .
                    '<p> See you soon!</p>' .
                    '<p> Your Treks and Tracks Team</p>' .
                    '<p> &nbsp;</p>' .
                    '<p> &nbsp;</p>' .
                    '<p style="font-size: 6px">' . $row->customer_id . '/' . $event_group_id . '</p>' .
                    '</html></body>';

                return $email;
            }


//	function get_email_message_text($event_group_id)
//	{
//		$query= $this->get_summary($event_group_id);
////print_r($query);	    
//	    
//		foreach ($query as $row)
//		{
//			$email='<html><body><h2>Thank you for booking! </h2>' . 
//				'<h4>Activity: <span> ' . $row->name . '</span></h4>' .
//				'<h4>Location: <span> ' . $row->location_name . '</span></h4>' . 
//				'<h4> Date/Time: <b>' . 
//		date("F jS  Y ",strtotime($row->date)) .
// 		'</b> from <b>' . 
//		date("g:i a",strtotime($row->time))  . 
//		'</b> to <b>' . 
//		date("g:i a",strtotime($row->time)+$row->duration * 3600) . 
//		'</b></h4>' . 
//			'<h3>Booking Details</h3>' .
//			'<p>Invoice Number: ' . $row->event_group_id . '</p>' .
//			'<p>Promo Code: ' .  $row->promo_code . '</p>' .
//			'<p>Amount Paid: $ ' . ($row->ledger_price - $row->ledger_discount) . '</p>' .
//			'<h3>Please bring: </h3>' .
//			'<p>' . $row->they_bring . '</p>';
//		 break;		
//		}
//		// run again for names
//		 $query = $this->db
//		->where('payment_id', $payment_id)
//		->join('ledger','ledger.event_group_id = payment.ledger_id','left')
//		->join('customer','customer.customer_id = ledger.customer_id')
//		->get('payment');
//    
//		
//		
//		$email.= '<h3>Participants: </h3>' ; 
//
//		foreach ($query->result() as $row)
//		{
//
//			$email.= 
//				'<p> ' . $row->first_name . ' ' . $row->last_name .  '</p>';
//		}
//			$email.= 
//			
//				'<p> &nbsp;</p>' .
//				'<p> See you soon!</p>' .
//				'<p> Your Treks and Tracks Team</p>' .
//			'</html></body>';
//
//	   return $email;	
//	}

        function book_ledger_full_discount($ledger_id, $event_group_id)
            {

                $this->db->where('event_group_id', $event_group_id);
//		$this->db->where('ledger.paid_code ', TRUE); //finished transaction
                $this->db->where('status !=', LEDGER_DELETED);
                $query = $this->db->get('ledger');
                $attending = 0;
                foreach ($query->result() as $row) {
                    $attending++;
                    $event_id = $row->event_id;
                    $promo_code = $row->promo_code;
                    $activity_id = $row->activity_id;
                }
                if ($attending) {
                    $data = array(
                        //			'location_id' => $location_id,
                        'paid_code' => '1');
                    $this->db->where('event_group_id', $event_group_id);    // update all attending with paid code
                    $this->db->update('ledger', $data);

                    $this->db->where('event_id', $event_id);
                    $query = $this->db->get('event');                    //write back the value
                    $row = $query->row();

                    $attending = $this->attending($event_id);
//			$data = array('attending' => $attending+$row->attending);
                    $data = array('attending' => $attending);
                    $this->db->where('event_id', $event_id);
                    $this->db->update('event', $data);

                    //write back promo_code
                    $data = array('is_rule_active' => 0);
                    $this->db->where('promo_code', $promo_code);
                    $this->db->where('is_single_use', 1);                      // only if set to one time use
                    $this->db->update('discount', $data);                    //write back the values
                }
                return $activity_id;
            }

        function book_ledger($payment_id, $event_group_id, $event_id, $location_id)
            {
                $attending = 1;
                $this->db->where('payment_id', $payment_id);
                $query = $this->db->get('payment');
                foreach ($query->result() as $row) {
                    $amount = $row->amount;
                    $payment_id = $row->payment_id;
                }

                $this->db->where('event_group_id', $event_group_id);
//		$this->db->where('ledger.paid_code ', TRUE); //finished transaction
                $this->db->where('status !=', LEDGER_DELETED);
                $query = $this->db->get('ledger');
                $attending = 0;
                foreach ($query->result() as $row) {
                    $attending++;
                }
                if ($attending) {
                    $amount_per_attending = $amount / $attending;
                    $data = array(
                        'location_id' => $location_id,
                        'amount_paid' => $amount_per_attending,
                        'payment_id' => $payment_id,
                        'paid_code' => '1');
                    $this->db->where('event_group_id', $event_group_id);    // update all attending with the payment
                    $this->db->update('ledger', $data);

                    $data = array('cc_amount' => $amount);
                    $this->db->where('event_group_id', $event_group_id);
                    $this->db->where('main_customer', 1);                    // update the payer with the credit card amount
                    $this->db->update('ledger', $data);


                    $this->db->where('event_id', $event_id);
                    $query = $this->db->get('event');                    //write back the value
                    $row = $query->row();
                    $attending = $this->attending($event_id);

                    //		$data = array('attending' => $attending+$row->attending); //8-9 CHANGE
                    $data = array('attending' => $attending);
                    $this->db->where('event_id', $event_id);
                    $this->db->update('event', $data);                    //write back the values
//die();		
                }
                return TRUE;
            }


        function get_attendants($ledger_id)
            {
                $query = $this->db
                    ->where('ledger_to_customer.ledger_id', $ledger_id)
                    ->where('ledger_to_customer.customer_id', 'customer.customer_id')
                    ->get('ledger_to_customer')
                    ->get('customer');
                return $query->result();
            }

        function get_ledger_name($ledger_id)
            {
                $this->db->where('ledger_id', $ledger_id);
                $query = $this->db->get('ledger');
                foreach ($query->result() as $row) {
                    return $row->name;
                }
            }

        function mark_deleted($ledger_id)
            {
                $this->db->where('ledger_id', $ledger_id);
                $this->db->where("event.date >= ", date('Y-m-d'));
                $this->db->join('event', 'ledger.event_id = event.event_id', 'right');
                $query = $this->db->get('ledger');

                if ($query->result()) {
                    foreach ($query->result() as $row) {
                        $status = $row->status;
                    }
                    $data = array('status' => $status == LEDGER_DELETED ? LEDGER_BOOKED : LEDGER_DELETED);
                    $this->db->where('ledger_id', $ledger_id);
                    $this->db->update('ledger', $data);

                    $this->db->where('ledger_id', $ledger_id);
                    $query = $this->db->get('ledger');
                    foreach ($query->result() as $row) {
                        $event_id = $row->event_id;
                    }

//				$this->db->where('event_id',$event_id );		
//				$this->db->where('status !=',LEDGER_DELETED);		
//				$this->db->where('ledger.paid_code ', TRUE); 
//				$attending = $this->db->count_all_results('ledger');

                    $attending = $this->attending($event_id);

                    $data = array('attending' => $attending);
                    $this->db->where('event_id', $event_id);
                    $this->db->update('event', $data);

                    return (array(
                        'status' => $status == LEDGER_DELETED ? LEDGER_BOOKED : LEDGER_DELETED,
                        'attending' => $attending));
                } else {
                    return FALSE;
                }
            }

        function get_activity_id($event_group_id)
            {
                $this->db->where('event_group_id', $event_group_id);
                $query = $this->db->get('ledger');
                foreach ($query->result() as $row) {
                    $activity_id = $row->activity_id;
                }
                return $activity_id;
            }

        function attending($event_id)
            {

                $this->db->where('event_id', $event_id);
                $this->db->where('status !=', LEDGER_DELETED);
                $this->db->where('ledger.paid_code ', TRUE);

                return $this->db->count_all_results('ledger');
            }

        function mark_show_noshow($ledger_id)
            {
                $this->db->select('event.*, ledger.*');
                $this->db->where('ledger.ledger_id', $ledger_id);
                $this->db->where('ledger.status != ', LEDGER_DELETED);
                $this->db->where("event.date <= ", date('Y-m-d'));
                $this->db->join('event', 'ledger.event_id = event.event_id', 'right');
                $query = $this->db->get('ledger');


                if ($query->result()) {
                    foreach ($query->result() as $row) {
                        $status = $row->status;
                    }
                    $data = array('status' => $status == LEDGER_SHOW ? LEDGER_NO_SHOW : LEDGER_SHOW);
                    $this->db->where('ledger.ledger_id', $ledger_id);
                    $this->db->update('ledger', $data);

                    $this->db->where('ledger_id', $ledger_id);
                    $query = $this->db->get('ledger');
                    foreach ($query->result() as $row) {
                        $event_id = $row->event_id;
                    }

//			$this->db->where('event_id',$event_id );		
//			$this->db->where('ledger.status',LEDGER_SHOW);
//			$this->db->where('ledger.paid_code ', TRUE); 
//		 	$attended = $this->db->count_all_results('ledger');
                    $attended = $this->attending($event_id);
                    $data = array('attended' => $attended);
                    $this->db->where('event_id', $event_id);
                    $this->db->update('event', $data);                    //write back the values

                    return ([
                        'status' => $status == LEDGER_SHOW ? LEDGER_NO_SHOW : LEDGER_SHOW,
                        'attended' => $attended]);
                } else {
                    return FALSE;
                }

            }


        function change_reserved_state()
            {
                $this->db->where('status', LEDGER_RESERVED);
                $query = $this->db->get('ledger');
                $now = time();
                foreach ($query->result() as $row) {
//		echo $now . '<br>' ; 
//		echo strtotime($row->booking_date). '<br>' ;
//		echo $now - strtotime($row->booking_date);

                    if ($now - strtotime($row->booking_date) >= RESERVED_TIME) {
                        $data = array('status' => LEDGER_CANCELLED);
                        $this->update_record($row->ledger_id, $data);
                    }
                }
            }

        function count_all()
            {
                return $this->db->count_all('ledger');
            }

        function get_record($ledger_id = 0)
            {
                if (!$ledger_id)
                    $this->db->where('ledger_id', $this->uri->segment(3));
                else
                    $this->db->where('ledger_id', $ledger_id);

                $query = $this->db->get('ledger');
                return $query->result();
            }

        function get_available($ledger_id)
            {
                $q_string =
                    "SELECT * FROM	event,ledger WHERE ledger.ledger_id = $ledger_id AND event.event_id=ledger.event_id ";

                $query = $this->db->query($q_string);
                foreach ($query->result() as $row) {
                    return $row->available;
                }
            }

        function add_attendant_record($ledger_id, $customer_id, $main_customer)
            {
                $data = array(
                    'ledger_id' => $ledger_id,
                    'main_customer' => $main_customer,
                    'customer_id' => $customer_id);
                $this->db->where('ledger_id', $ledger_id);
                return $this->db->update('ledger', $data);
            }

        function add_record($data)
            {
                return $this->db->insert('ledger', $data);
            }

        function add_payment($data)
            {
                $this->db->insert('payment', $data);
                return $this->db->insert_id();
            }

        function update_record($ledger_id, $data)
            {
                $this->db->where('ledger_id', $ledger_id);
                return $this->db->update('ledger', $data);
            }

        function delete_record()
            {
                $this->db->where('ledger_id', $this->uri->segment(3));
                $this->db->delete('ledger');
            }

        function response_reason_codes($response_code)
            {
                if ($response_code == 1)
                    $return_text = 'This transaction has been approved.';
                elseif ($response_code == 2)
                    $return_text = 'This transaction has been declined.';
                elseif ($response_code == 3)
                    $return_text = 'This transaction has been declined.';
                elseif ($response_code == 4)
                    $return_text = 'This transaction has been declined. The code returned from the processor indicating that the card used needs to be picked up.';
                elseif ($response_code == 5)
                    $return_text = 'A valid amount is required. The value submitted in the amount field did not pass validation for a number.';
                elseif ($response_code == 6)
                    $return_text = 'The credit card number is invalid.';
                elseif ($response_code == 7)
                    $return_text = 'The credit card expiration date is invalid. The format of the date submitted was incorrect.';
                elseif ($response_code == 8)
                    $return_text = 'The credit card has expired.';
                elseif ($response_code == 9)
                    $return_text = 'Not a valid financial institution.';
                elseif ($response_code == 11)
                    $return_text = 'A duplicate transaction has been submitted.';
                elseif ($response_code == 12)
                    $return_text = 'An authorization code is required but not present.';
                elseif ($response_code == 14)
                    $return_text = 'The Referrer or Relay Response URL is invalid.';
                elseif ($response_code == 15)
                    $return_text = 'The transaction ID is invalid';
                elseif ($response_code == 27)
                    $return_text = 'The address provided does not match billing address of cardholder.';
                elseif ($response_code == 44)
                    $return_text = 'CCV code is invalid';
                else
                    $return_text = 'Other transaction error ' . $response_code;

                return $return_text;
            }
    }