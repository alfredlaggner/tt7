<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	function date_time_zone($indate)
	{
		$date = new DateTime($indate, new DateTimeZone('Europe/London'));
		$date->setTimezone(new DateTimeZone('America/Mexico_City'));
		return $date->format(TIME_FORMAT);
	}
}

/* End of file admin_model.php */
/* Location: ./application/models/admin:model.php */