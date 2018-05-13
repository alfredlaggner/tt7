<?php

class Discount_model extends CI_Model
{

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	function get_records($is_imported = 0)
	{
		$this->db->where('is_imported', $is_imported);
		$this->db->group_by('discount.name');
		$this->db->order_by('updated', 'desc');
		$query = $this->db->get('discount');
		return $query->result();
	}

// group functions
	function get_group_records($is_imported = 0, $group_name = '')
	{
		//$this->db->where('is_imported',$is_imported);
		//	$this->db->like('name',$group_name,'match','before');

		//echo 'group_name: ' . $group_name;
		//echo str_replace("%20"," ",$group_name);
		$this->db->where('is_imported', $is_imported);

		if ($group_name) $this->db->where('name', ltrim(str_replace("%20", " ", $group_name)));
		$this->db->order_by('updated', 'desc');
		$query = $this->db->get('discount');
		return $query->result();
	}

	function get_group_count($is_imported = 0, $group_name)
	{
		//$this->db->where('is_imported',$is_imported);
		//	$this->db->like('name',$group_name,'match','before');

		//echo 'group_name: ' . $group_name;
		//echo str_replace("%20"," ",$group_name);
		$this->db->where('name', ltrim(str_replace("%20", " ", $group_name)));
		$this->db->order_by('updated', 'desc');
		$this->db->from('discount');
		return $this->db->count_all_results();
	}

	function group_delete($discount_name)
	{
		$this->db->where('name', ltrim(str_replace("%20", " ", $discount_name)));
		$this->db->delete('discount');
	}

	function xgroup_copy($discount_name)
	{
		$this->load->dbforge();
		$new_table = ltrim(str_replace("%20", "_", $discount_name));
		$this->dbforge->create_table($new_table, TRUE);
		$this->db->where('name', ltrim(str_replace("%20", " ", $discount_name)));
		$this->db->select('*');
		$this->db->last_query();
	}

	function group_copy($discount_name)
	{
		$this->load->dbforge();
		$new_table = ltrim(str_replace("%20", "_", $discount_name));
		$master_table = 'discount';
		$this->db->query("DROP TABLE IF EXISTS $new_table; ");
		$this->db->query("CREATE TABLE $new_table  LIKE $master_table");

		$this->db->where('name', ltrim(str_replace("%20", " ", $discount_name)));
		$query = $this->db->get('discount');
		foreach ($query->result() as $row) {
			$this->db->insert($new_table, $row);
		}


	}


// end group functions

	function get_record($discount_id)
	{
		$this->db->where('discount_id', $discount_id);
		$query = $this->db->get('discount');
		return $query->result();
	}

	function get_record_by_code($promo_code)
	{
		$this->db->where('promo_code', $promo_code);
		$query = $this->db->get('discount');
		return $query->result();
	}

	function get_discount_id($promo_code)
	{
		$this->db->where('promo_code', $promo_code);
		$query = $this->db->get('discount');
		$discount_id = '';
		foreach ($query->result() as $row) {
			$discount_id = $row->discount_id;
		}
		return $discount_id;
	}

	function get_promo_amount_type($promo_code)
	{
		$this->db->where('promo_code', $promo_code);
		$query = $this->db->get('discount');
		$amount_type = '';
		foreach ($query->result() as $row) {
			$amount_type = $row->amount_type;
		}
		return $amount_type;
	}


	function used_codes_count($name = '')
	{
		if ($name) $this->db->where('discount.name', $name);
		$this->db->select("discount.name, COUNT(CASE WHEN discount.is_rule_active = '1' THEN 1 ELSE NULL END) as unused ,COUNT(CASE WHEN discount.is_rule_active = '0' THEN 1 ELSE NULL END) as used, count(*) as alle, ");
		$this->db->group_by('discount.name');
		$this->db->order_by('discount.name', 'desc');
		$query = $this->db->get('discount');

		foreach ($query->result() as $row) {
			$data[] = array(
				$row->name,
				$row->used,
				$row->unused,
				$row->alle
			);
		}

		$this->excel->getProperties()->setCreator('Treks and tracks')
			->setLastModifiedBy('Jakob Laggner')
			->setTitle('Use of Discounts List')
			->setSubject('Email List')
			->setDescription('Sorted by Name');

		// Create the worksheet
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setCellValue('A1', 'Discount Name')
			->setCellValue('B1', 'Used')
			->setCellValue('C1', 'Unused')
			->setCellValue('D1', 'Total');


		$this->excel->getActiveSheet()->fromArray($data, NULL, 'A2');
		$this->excel->getActiveSheet()->freezePane('A2');
		$filename = 'Generated_use_of_discounts_v1.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

		return false;
	}


	function get_promo_code($promo_code, $event_id)
	{
		$this->db->where('event_id', $event_id);
		$query = $this->db->get('event');
		foreach ($query->result() as $row) {
			$event_date = $row->date;
		}

		$this->db->select('discount.*,activity.name as activity_name');
		$this->db->where('promo_code', $promo_code);
		$this->db->join('discount_to_activity', 'discount_to_activity.discount_id = discount.discount_id');
		$this->db->join('activity', 'activity.activity_id = discount_to_activity.activity_id');
		$this->db->limit(1);
		$query = $this->db->get('discount');
		$return_code = "";

		foreach ($query->result() as $row) {
//echo '<br>exp='.$row->exp_date	;
//echo '<br>event='.$event_date	;

			if ($event_date >= $row->exp_date) {
				$return_code = "EXPI";
			} elseif (!$row->is_rule_active) {
				$return_code = "USED";
			} else {
				$return_code = "OK";
			}
		}
		return $return_code;
	}

	function x_get_promo_code($promo_code)
	{
		$this->db->select('discount.*,activity.name as activity_name');
		$this->db->where('promo_code', $promo_code);
		$this->db->join('discount_to_activity', 'discount_to_activity.discount_id = discount.discount_id');
		$this->db->join('activity', 'activity.activity_id = discount_to_activity.activity_id');
		$query = $this->db->get('discount');
		return $query->row();
	}

	function add_record($data)
	{
		$this->db->insert('discount', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('discount_id', $this->uri->segment(3));
		$this->db->update('discount', $data);
	}

	function update_all_records($data)
	{
		$this->db->update('discount', $data);
	}

	function delete_record()
	{
		$this->db->where('discount_id', $this->uri->segment(3));
		$this->db->delete('discount');
	}

	function get_weekdays($discount_id)
	{
		$this->db->where('discount_id', $discount_id);
		$query = $this->db->get('discount');
		foreach ($query->result() as $row) {
			return $row->weekdays;
		}
	}

	function import_event_dates($activity = 0)
	{
//		if ( !copy("/wamp/www/tt/groupon_codes.csv", "/tmp/groupon_codes.csv") )
//		if ( !copy("/home/users/web/b1458/moo.terramarinfo/sunnydays/groupon_codes.csv", "/tmp/groupon_codes.csv") )
//					{$data['messages'] = "Could not copy CSV file to temporary directory ready for importing."; 
//					die();}
//$server_dir = LOCAL_SERVER_DIR.'event_dates.csv';
//$server_dir = TEST_SERVER_DIR.'event_dates.csv';
		$server_dir = PROD_SERVER_DIR . 'event_dates.csv';
		$err_code = 0;
		$data = array();

		$query = $this->db->query("DROP TABLE IF EXISTS event_save; ");
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS event_save LIKE event; ");
		$query = $this->db->query("INSERT IGNORE INTO  event_save select * FROM event ;");

		$query = $this->db->query("DROP TABLE IF EXISTS event_work; ");
		$query = $this->db->query("CREATE TABLE event_work LIKE event; ");
		$query = $this->db->query("ALTER TABLE event_work CHANGE event_id event_id INT(10) UNSIGNED NOT NULL; ");
		$query = $this->db->query("ALTER TABLE event_work DROP PRIMARY KEY; ");


		$query = $this->db->query(
			"LOAD DATA LOCAL INFILE ? REPLACE INTO TABLE event_work 
		FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' 
		(activity_id, location_id, capacity_max, duration, date, time )", array($server_dir));

		if ($query) {
			echo "All items imported successfully.";
			$data['messages'] = array('name' => "All items imported successfully.");
		} else {
			$data['messages'] = array('name' => "Import failed.");
			echo "Import failed.";

		}
		$available = 0;
		$query = $this->db->get('event_work');
		foreach ($query->result() as $row) {
			$available = $row->capacity_max;
			break;
		}
//		echo $data['messages'];

//		$this->db->where('is_rule_active', JUST_IMPORTED);
		$data1 = array(
			'available' => $available,
			'attending' => JUST_IMPORTED, // just for import, will be set back to zero in the end
		);
		$this->db->update('event_work', $data1);

		$query = $this->db->query(
			"INSERT IGNORE INTO  event select * FROM event_work ;"); //copy back to event


		if ($query) {
			$data['messages'] = array('name' => "All items added successfully to event. (Phase I)");
			echo "All items added successfully to event. (Phase I)<br>";
		} else {
			$data['messages'] = array('name' => "Add to event failed. (Phase I)<br>");
			echo "Add to event failed. (Phase I)<br>";
		}

		$this->db->where('attending', JUST_IMPORTED);
		$data1 = array(
			'attending' => 0,
		);
		$this->db->update('event', $data1); // in the end change the flag from newly copied to active
//		unlink ($server_dir);
		return TRUE;
	}

	function import_groupon_discount($activity, $activity_count)
	{
		$server_dir = PROD_SERVER_DIR . 'groupon_codes.csv';
		$data = array();
		$query = $this->db->query("DROP TABLE IF EXISTS discount_work; ");
		$query = $this->db->query("DROP TABLE IF EXISTS discount_to_activity_work; ");
		$query = $this->db->query("CREATE TABLE discount_work LIKE discount; ");
		$query = $this->db->query("ALTER TABLE discount_work CHANGE discount_id discount_id INT(10) UNSIGNED NOT NULL; ");
		$query = $this->db->query("ALTER TABLE discount_work DROP PRIMARY KEY; ");

		$query = $this->db->query("CREATE TABLE discount_to_activity_work LIKE discount_to_activity; ");


		$query = $this->db->query(
			"LOAD DATA LOW_PRIORITY INFILE ? REPLACE INTO TABLE discount_work 
		FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' 
		(promo_code, name, exp_date, is_rule_active, amount)", array($server_dir));

		if ($query) {
			$data['messages'] = array('name' => "All items imported successfully.");
		} else {
			$data['messages'] = array('name' => "Import failed.");
			return "Import into discount_work failed!";
		}


		$this->db->where('is_rule_active', JUST_IMPORTED);
		$data1 = array(
			//		'amount' => 100,
			'amount_type' => 'P',
			'type' => 1,
			'weekdays' => 1111111,
			'is_single_use' => 1,
			'is_imported' => 1,
			'is_global_discount' => 0,
			'amount_type' => DISCOUNT_FIXED_AMOUNT,
			'is_automatic_apply' => 1,
		);
		$this->db->update('discount_work', $data1);

		$query = $this->db->query(
			"INSERT IGNORE INTO  discount select * FROM discount_work ;"); //copy back to discount

		$this->db->where('is_rule_active', JUST_IMPORTED);
		$query = $this->db->get('discount');
		foreach ($query->result_array() as $row) {
			$discount[] = $row['discount_id'];
		}
		if (!isset($discount)) {
			return  "Nothing imported! Did you try to import same codes again?";
		};

		for ($i = 0; $i < count($discount); $i++) {
			for ($j = 0; $j < count($activity); $j++) {
				$data = array('discount_id' => $discount[$i], 'activity_id' => $activity[$j]);
				$this->db->insert('discount_to_activity_work', $data);
			}
		}


		if ($query) {
			$data['messages'] = array('name' => "All items added successfully to discount_to_activity_work. (Phase I)");
		} else {
			$data['messages'] = array('name' => "Add to discount_to_activity_work failed. (Phase I)<br>");
		}

		$this->db->where('is_rule_active', JUST_IMPORTED);
		$data1 = array(
			'is_rule_active' => DISCOUNT_ACTIVE,
		);
		$this->db->update('discount', $data1); // in the end change the flag from newly copied to active
		$query = $this->db->query(
			"REPLACE INTO  discount_to_activity select * FROM discount_to_activity_work ;"); //copy back to discount
		return "Looks very good!";
	}

	function set_all_discounts_to_single_use()
	{
		$data1 = array(
			'is_single_use' => 1,
		);
		return $this->db->update('discount', $data1);
	}

	function fix_null_date()
	{
		$this->db->where('exp_date', '0000-00-00');
		$data1 = array(
			'exp_date' => '2014-06-30'
		);

		return $this->db->update('discount', $data1);
	}
}