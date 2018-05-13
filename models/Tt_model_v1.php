<?php

class Tt_model_v1 extends CI_Model
{

	private $q_string;

	function __construct()
	{
		parent::__construct();

	}

	function get_Regions()
	{
		$query = $this->db->get('region');
		return $query->result();

	}

	function get_region_name($region_id)
	{
//echo "region id =" . $region_id;	
		if ($region_id) $this->db->where('region_id', $region_id); else return "all regions";

		$query = $this->db->get('region');
		foreach ($query->result() as $row) {
			return $row->region;
		}

	}

	// get the first picture from each set
	function xget_featured_pictures($is_featured = 0)
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region
		if ($region_id)
			$this->db->where('region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);

		$this->db->select('activity.activity_id, activity.code, activity_pictures.picture');
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->group_by('activity.activity_id'); //new	
		$this->db->order_by('rate_price.effective_date desc'); //new	
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new	
		$query = $this->db->get('activity');
		$pictures = array();
		foreach ($query->result() AS $row) {
			array_push($pictures, base_url() . CLASSES_IMAGE_DIR .
				strtoupper($row->code) . '/' . strtoupper($row->picture));
		}
		return $pictures;

	}

//	function get_all_classes($limit, $offset, $is_featured=0)
	function get_all_classes($style_id, $is_featured)
	{
//		echo "query: ". $isQuery.'<br>';
//		echo "limit: ".$limit.'<br>';
//		echo "offset: ".$offset.'<br>';

		date_default_timezone_set('America/Los_Angeles');

		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region
		if ($region_id)
			$this->db->where('activity_to_region.region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);
		if ($style_id)
			$this->db->where('activity.style_id', $style_id);

		$this->db->where('activity.is_active', TRUE);

		$this->db->select('activity.*, rate_price.price as rate_price_price, activity_pictures.picture');
		if ($region_id)
			$this->db->join('activity_to_region', 'activity_to_region.activity_id = activity.activity_id');

		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->join('style', 'activity.style_id = style.style_id', 'left');
		$this->db->group_by('activity.activity_id'); //new	
		$this->db->order_by('activity.order asc'); //new	
		$this->db->order_by('rate_price.effective_date desc'); //new	
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new	
		$query = $this->db->get('activity');
		//	$query = $this->db->get('activity_to_region');
//print_r($query->result()); die();		
		return $query->result();

	}

	function get_paginated_classes_featured($limit, $offset)
	{

		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later

		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$this->db->where('is_featured', TRUE);
		if ($limit)
			$this->db->limit($limit);
		if ($offset)
			$this->db->offset($offset);

		$query = $this->db->get('activity');

		return $query->result();
	}

	function get_paginated_classes($limit, $offset, $is_featured = 0)
	{

		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later

		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		if ($is_featured)
			$this->db->where('is_featured', $is_featured);
		if ($limit)
			$this->db->limit($limit);
		if ($offset)
			$this->db->offset($offset);

		$query = $this->db->get('activity');

		return $query->result();
	}

	function get_class($activity_id)
	{

		$this->db->select('
			activity.*, 
			activity_pictures.*, 
			style.name AS style_name,
			physical_level.level AS physical_level_level,
			physical_level.name AS physical_level_name,
			service_level.name AS service_level_name,
			rate_price.price 
			');
		$this->db->where('activity.activity_id', $activity_id);
		$this->db->join('style', 'activity.style_id=style.style_id');
		$this->db->join('physical_level', 'activity.physical_level_id = physical_level.physical_level_id');
		$this->db->join('service_level', 'activity.service_level_id = service_level.service_level_id');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->group_by('activity.activity_id'); //new	
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new	
		$query = $this->db->get('activity');
		return $query->result();
	}

	function get_related_activities($activity_id)
	{
		$this->db->select('
			activity_related.*,
			activity.*, 
			activity_pictures.*, 
			style.name AS style_name,
			physical_level.level AS physical_level_level,
			physical_level.name AS physical_level_name,
			service_level.name AS service_level_name,
			rate_price.price 
			');
		$this->db->where('activity_related.activity_id', $activity_id);
		$this->db->join('activity', 'activity.activity_id=activity_related.activity_related_id');
		$this->db->join('style', 'activity.style_id=style.style_id');
		$this->db->join('physical_level', 'activity.physical_level_id = physical_level.physical_level_id');
		$this->db->join('service_level', 'activity.service_level_id = service_level.service_level_id');
		$this->db->join('rate_price', 'rate_price.activity_id = activity.activity_id', 'left'); //new
		$this->db->join('activity_pictures', 'activity_pictures.activity_id = activity.activity_id', 'left');
		$this->db->group_by('activity.activity_id'); //new	
		$this->db->where('rate_price.effective_date <=', date("Y-m-d")); //new	
		$query = $this->db->get('activity_related');
		return $query->result();

	}

	function get_rows()
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$query = $this->db->get('activity');
		return $query->num_rows();

	}

	function get_rows_featured()
	{
		$region_id = 0;
		$region_id = $this->session->userdata('region_id'); // chosen region

		if ($region_id)
			$this->db->where('region_id', $region_id);
		$this->db->where('is_featured', TRUE);
		$query = $this->db->get('activity');
		return $query->num_rows();

	}


////////////////////////////////////////////////////////////////	

	function get_Query_Real_Estates($limit, $offset)
	{
		$Pr_Zo_ID = "0";
		$Pr_T2_ID = "0";
		$Pr_Bed = 0;
		$Pr_Price_L = "0";
		$Pr_Price_H = "10000000";
		$Keyword = "";
		$Pr_Desc = "";


		$Pr_Zo_ID = $this->input->post('Pr_Zo_ID');
		$Pr_T2_ID = $this->input->post('Pr_T2_ID');
		$Pr_Bed = $this->input->post('Pr_Bed');
		$Pr_Price_L = $this->input->post('Pr_Price_L');
		$Pr_Price_H = $this->input->post('Pr_Price_H');
		$Keyword = $this->input->post('Keyword');

		$this->session->set_userdata('Pr_Zo_ID', $Pr_Zo_ID);  // save it for later
		$this->session->set_userdata('Pr_T2_ID', $Pr_T2_ID);  // save it for later
		$this->session->set_userdata('Pr_Bed', $Pr_Bed);  // save it for later
		$this->session->set_userdata('Pr_Price_L', $Pr_Price_L);  // save it for later
		$this->session->set_userdata('Pr_Price_H', $Pr_Price_H);  // save it for later
		$this->session->set_userdata('Keyword', $Keyword);  // save it for later
		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later


		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 1 AND " .
			"$Pr_Price_L <= Pr_Price AND $Pr_Price_H >= Pr_Price AND " .
			"Pr_Vis LIKE 'Y'  ";
		if ($Pr_Bed > 0) {
			$q_string .= "AND Pr_Bed = $Pr_Bed ";
		} else {
		}
		if ($Pr_T2_ID > 0) {
			$q_string .= "AND Pr_T2_ID = $Pr_T2_ID ";
		} else {
		}
		if ($Pr_Zo_ID > 0) {
			$q_string .= "AND Pr_Zo_ID = $Pr_Zo_ID ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= "ORDER BY Pr_Price DESC";

		if ($limit) {
			$q_string .= " LIMIT $limit ";
		}
		if ($offset) {
			$q_string .= " OFFSET $offset ";
		}

		$q = $this->db->query($q_string);
		$num_r = $q->num_rows();

		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data; // data
		}
		$q->free_result();
	}

	function get_Paginated_Real_Estates($limit, $offset)
	{
//			echo "current offset= ".$offset;
		$Pr_Zo_ID = "0";
		$Pr_T2_ID = "0";
		$Pr_Bed = 0;
		$Pr_Price_L = "0";
		$Pr_Price_H = "10000000";
		$Keyword = "";
		$Pr_Desc = "";


		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('offset', $offset);  // save it for later

		$Pr_Zo_ID = $this->session->userdata('Pr_Zo_ID');  // save it for later
		$Pr_T2_ID = $this->session->userdata('Pr_T2_ID');  // save it for later
		$Pr_Bed = $this->session->userdata('Pr_Bed');  // save it for later
		$Pr_Price_L = $this->session->userdata('Pr_Price_L');  // save it for later
		$Pr_Price_H = $this->session->userdata('Pr_Price_H');  // save it for later
		$Keyword = $this->session->userdata('Keyword');  // save it for later


		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 1 AND " .
			"$Pr_Price_L <= Pr_Price AND $Pr_Price_H >= Pr_Price AND " .
			"Pr_Vis LIKE 'Y'  ";
		if ($Pr_Bed > 0) {
			$q_string .= "AND Pr_Bed = $Pr_Bed ";
		} else {
		}
		if ($Pr_T2_ID > 0) {
			$q_string .= "AND Pr_T2_ID = $Pr_T2_ID ";
		} else {
		}
		if ($Pr_Zo_ID > 0) {
			$q_string .= "AND Pr_Zo_ID = $Pr_Zo_ID ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= "ORDER BY Pr_Price DESC";

		if ($limit) {
			$q_string .= " LIMIT $limit ";
		} else {
		};

		if ($offset) {
			$q_string .= " OFFSET $offset ";
		} else {
		};


		$q = $this->db->query($q_string);
		$num_r = $q->num_rows();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}

			$q->free_result();
			return $data;
		}
	}

	function xget_rows()
	{
		$Pr_Zo_ID = $this->session->userdata('Pr_Zo_ID');  // save it for later
		$Pr_T2_ID = $this->session->userdata('Pr_T2_ID');  // save it for later
		$Pr_Bed = $this->session->userdata('Pr_Bed');  // save it for later
		$Pr_Price_L = $this->session->userdata('Pr_Price_L');  // save it for later
		$Pr_Price_H = $this->session->userdata('Pr_Price_H');  // save it for later
		$Keyword = $this->session->userdata('Keyword');  // save it for later

//echo "getting the rows <br>"; 		
//echo "Pr_Zo_ID: ".		$Pr_Zo_ID  .'<br>';
//echo "Pr_T2_ID: ". $Pr_T2_ID .'<br>';
//echo "Pr_Bed: ". $Pr_Bed .'<br>';
//echo "Pr_Price_DL: ". $Pr_Price_DL.'<br>';
//echo "Pr_Price_DH: ". $Pr_Price_DH.'<br>';
//echo "Pr_Price_WL: ". $Pr_Price_WL.'<br>' ;
//echo "Pr_Price_WH: ". $Pr_Price_WH.'<br>' ;
//echo "Pr_Price_ML: ". $Pr_Price_ML.'<br>' ;
//echo "Pr_Price_MH: ". $Pr_Price_MH.'<br>' ;
//echo "Pr_Long_Term: ". $Pr_Long_Term.'<br>' ;
//echo "Keyword: ". $Keyword .'<br>';

		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 1 AND " .
			"$Pr_Price_L <= Pr_Price AND $Pr_Price_H >= Pr_Price AND " .
			"Pr_Vis LIKE 'Y'  ";
		if ($Pr_Bed > 0) {
			$q_string .= "AND Pr_Bed = $Pr_Bed ";
		} else {
		}
		if ($Pr_T2_ID > 0) {
			$q_string .= "AND Pr_T2_ID = $Pr_T2_ID ";
		} else {
		}
		if ($Pr_Zo_ID > 0) {
			$q_string .= "AND Pr_Zo_ID = $Pr_Zo_ID ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= "ORDER BY Pr_Price DESC";

		$q = $this->db->query($q_string);
		return $q->num_rows();
	}

	function get_Zone()
	{
		$this->db->order_by('Zo_Name');
		$query = $this->db->get('Zone');
		return $query->result();
	}

	function get_Type2()
	{
		$this->db->order_by('Ty2_Name');
		$query = $this->db->get('Type2');
		return $query->result();
	}
//		function get_property_name()
//	{
//		$Pr_ID = $this->uri->segment(3);
//		$this->db->where('Pr_ID','$Pr_ID');
//		$query = $this->db->get('Properties');
//		return $query->result();
//	}
	function get_property_profile()
	{
		$Pr_ID = $this->uri->segment(3);
		$q_string = "SELECT * FROM Properties, Zone, Colonias, Cities, Type1, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_Ci_ID = Ci_ID AND " .
			"Pr_Col_ID = Col_ID AND " .
			"Pr_T1_ID = Ty1_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_ID = $Pr_ID";

		$q = $this->db->query($q_string);
		$num_r = $q->num_rows();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}

			$q->free_result();
			return $data;
		}
	}
}
// end of model class