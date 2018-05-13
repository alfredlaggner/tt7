<?php

class Rentals_model extends CI_Model
{

	private $q_string;

	function __construct()
	{
		parent::__construct();

	}

	function getRentals($limit, $offset)
	{
//		echo "query: ". $isQuery.'<br>';
//		echo "limit: ".$limit.'<br>';
//		echo "offset: ".$offset.'<br>';


		$data = array();
		$Pr_Zo_ID = "0";
		$Pr_T2_ID = "0";
		$Pr_Bed = 0;
		$Pr_Price_DL = "0";
		$Pr_Price_DH = "5000";
		$Pr_Price_WL = "0";
		$Pr_Price_WH = "10000";
		$Pr_Price_ML = "0";
		$Pr_Price_MH = "15000";
		$Pr_Long_Term = "";
		$Keyword = "";
		$Pr_Desc = "";
		$TimeSpan = 2;

		$Pr_T2_ID = $this->uri->segment(3, 0);
		$Pr_Long_Term = $this->uri->segment(3, "");
		if ($Pr_Long_Term == "Y") $TimeSpan = 1;


		$this->session->set_userdata('Pr_Zo_ID', $Pr_Zo_ID);  // save it for later
		$this->session->set_userdata('Pr_T2_ID', $Pr_T2_ID);  // save it for later
		$this->session->set_userdata('Pr_Bed', $Pr_Bed);  // save it for later
		$this->session->set_userdata('Pr_Price_DL', $Pr_Price_DL);  // save it for later
		$this->session->set_userdata('Pr_Price_DH', $Pr_Price_DH);  // save it for later
		$this->session->set_userdata('Pr_Price_WL', $Pr_Price_WL);  // save it for later
		$this->session->set_userdata('Pr_Price_WH', $Pr_Price_WH);  // save it for later
		$this->session->set_userdata('Pr_Price_ML', $Pr_Price_ML);  // save it for later
		$this->session->set_userdata('Pr_Price_MH', $Pr_Price_MH);  // save it for later
		$this->session->set_userdata('Pr_Long_Term', $Pr_Long_Term);  // save it for later
		$this->session->set_userdata('Keyword', $Keyword);  // save it for later
		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('p_offset', $offset);  // save it for later
		$this->session->set_userdata('TimeSpan', $TimeSpan);  // save it for later

		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 2 AND " .
			$Pr_Price_DL . " <= Pr_DH AND " . $Pr_Price_DH . " >= Pr_DH AND " .
			$Pr_Price_WL . " <= Pr_WH AND " . $Pr_Price_WH . ">= Pr_WH AND " .
			$Pr_Price_ML . " <= Pr_MH AND " . $Pr_Price_MH . ">= Pr_MH AND " .
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
		if ($Pr_Long_Term == 'Y') {
			$q_string .= "AND Pr_Long_Term LIKE 'Y' ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= "ORDER BY Pr_WH DESC";

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

	function get_Query_Rentals($limit, $offset)
	{
//		echo "query: ". $isQuery.'<br>';
//		echo "limit: ".$limit.'<br>';
//		echo "offset: ".$offset.'<br>';
		$data = array();
		$Pr_Zo_ID = "0";
		$Pr_T2_ID = "0";
		$Pr_Bed = 0;
		$Pr_Price_DL = "0";
		$Pr_Price_DH = "5000";
		$Pr_Price_WL = "0";
		$Pr_Price_WH = "10000";
		$Pr_Price_ML = "0";
		$Pr_Price_MH = "15000";
		$Pr_Long_Term = "";
		$Keyword = "";


		$Pr_Zo_ID = $this->input->post('Pr_Zo_ID');
		$Pr_T2_ID = $this->input->post('Pr_T2_ID');
		$Pr_Bed = $this->input->post('Pr_Bed');
		$Pr_Price_DL = $this->input->post('Pr_Price_DL');
		$Pr_Price_DH = $this->input->post('Pr_Price_DH');
		$Pr_Price_WL = $this->input->post('Pr_Price_WL');
		$Pr_Price_WH = $this->input->post('Pr_Price_WH');
		$Pr_Price_ML = $this->input->post('Pr_Price_ML');
		$Pr_Price_MH = $this->input->post('Pr_Price_MH');
		$Pr_Long_Term = $this->input->post('Pr_Long_Term');
		$Keyword = $this->input->post('Keyword');
		$o_string = "ORDER BY Pr_WH DESC";
		$TimeSpan = $this->input->post('TimeSpan');
		if ($TimeSpan == 1) {
			$Pr_Price_DL = "0";
			$Pr_Price_DH = "5000";
			$Pr_Price_WL = "0";
			$Pr_Price_WH = "10000";
			$o_string = "ORDER BY Pr_MH DESC";
		}
		if ($TimeSpan == 2) {
			$Pr_Price_DL = "0";
			$Pr_Price_DH = "5000";
			$Pr_Price_ML = "0";
			$Pr_Price_MH = "15000";
			$o_string = "ORDER BY Pr_WH DESC";
		}
		if ($TimeSpan == 3) {
			$Pr_Price_WL = "0";
			$Pr_Price_WH = "10000";
			$Pr_Price_ML = "0";
			$Pr_Price_MH = "15000";
			$o_string = "ORDER BY Pr_DH DESC";
		}
		$this->session->set_userdata('Pr_Zo_ID', $Pr_Zo_ID);  // save it for later
		$this->session->set_userdata('Pr_T2_ID', $Pr_T2_ID);  // save it for later
		$this->session->set_userdata('Pr_Bed', $Pr_Bed);  // save it for later
		$this->session->set_userdata('Pr_Price_DL', $Pr_Price_DL);  // save it for later
		$this->session->set_userdata('Pr_Price_DH', $Pr_Price_DH);  // save it for later
		$this->session->set_userdata('Pr_Price_WL', $Pr_Price_WL);  // save it for later
		$this->session->set_userdata('Pr_Price_WH', $Pr_Price_WH);  // save it for later
		$this->session->set_userdata('Pr_Price_ML', $Pr_Price_ML);  // save it for later
		$this->session->set_userdata('Pr_Price_MH', $Pr_Price_MH);  // save it for later
		$this->session->set_userdata('Pr_Long_Term', $Pr_Long_Term);  // save it for later
		$this->session->set_userdata('Keyword', $Keyword);  // save it for later
		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('p_offset', $offset);  // save it for later
		$this->session->set_userdata('limit', $limit);  // save it for later
		$this->session->set_userdata('TimeSpan', $TimeSpan);  // save it for later

//echo 	"before query in get_query  <br>";		
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
//

		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 2 AND " .
			$Pr_Price_DL . " <= Pr_DH AND " . $Pr_Price_DH . " >= Pr_DH AND " .
			$Pr_Price_WL . " <= Pr_WH AND " . $Pr_Price_WH . ">= Pr_WH AND " .
			$Pr_Price_ML . " <= Pr_MH AND " . $Pr_Price_MH . ">= Pr_MH AND " .
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
		if ($Pr_Long_Term == 'Y') {
			$q_string .= "AND Pr_Long_Term LIKE 'Y' ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= $o_string;

//echo $q_string.'<br>';	

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

	function get_Paginated_Rentals($limit, $offset)
	{
//			echo "current offset= ".$offset;
		$data = array();
		$Pr_Zo_ID = 0;
		$Pr_T2_ID = 0;
		$Pr_Bed = 0;
		$Pr_Price_DL = 0;
		$Pr_Price_DH = 5000;
		$Pr_Price_WL = 0;
		$Pr_Price_WH = 10000;
		$Pr_Price_ML = 0;
		$Pr_Price_MH = 15000;
		$Pr_Long_Term = 0;
		$Keyword = "";
		$o_string = "ORDER BY Pr_WH DESC";


		$this->session->set_userdata('limit', $limit);  // save it for la
		$this->session->set_userdata('p_offset', $offset);  // save it for later
		$Pr_Zo_ID = $this->session->userdata('Pr_Zo_ID');  // save it for later
		$Pr_T2_ID = $this->session->userdata('Pr_T2_ID');  // save it for later
		$Pr_Bed = $this->session->userdata('Pr_Bed');  // save it for later
		$Pr_Price_DL = $this->session->userdata('Pr_Price_DL');  // save it for later
		$Pr_Price_DH = $this->session->userdata('Pr_Price_DH');  // save it for later
		$Pr_Price_WL = $this->session->userdata('Pr_Price_WL');  // save it for later
		$Pr_Price_WH = $this->session->userdata('Pr_Price_WH');  // save it for later
		$Pr_Price_ML = $this->session->userdata('Pr_Price_ML');  // save it for later
		$Pr_Price_MH = $this->session->userdata('Pr_Price_MH');  // save it for later
		$Pr_Long_Term = $this->session->userdata('Pr_Long_Term');  // save it for later
		$Keyword = $this->session->userdata('Keyword');  // save it for later

		if ($Pr_Price_ML > 0 || $Pr_Price_MH < 15000) {
			$o_string = "ORDER BY Pr_MH DESC";
		}
		if ($Pr_Price_WL > 0 || $Pr_Price_WH < 10000) {
			$o_string = "ORDER BY Pr_WH DESC";
		}
		if ($Pr_Price_DL > 0 || $Pr_Price_DH < 5000) {
			$o_string = "ORDER BY Pr_DH DESC";
		}


		$q_string = "SELECT * FROM Properties, Zone, Type2 WHERE " .
			"Pr_Zo_ID = Zo_ID AND " .
			"Pr_T2_ID = Ty2_ID AND " .
			"Pr_T1_ID = 2 AND " .
			$Pr_Price_DL . " <= Pr_DH AND " . $Pr_Price_DH . " >= Pr_DH AND " .
			$Pr_Price_WL . " <= Pr_WH AND " . $Pr_Price_WH . ">= Pr_WH AND " .
			$Pr_Price_ML . " <= Pr_MH AND " . $Pr_Price_MH . ">= Pr_MH AND " .
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
		if ($Pr_Long_Term == 'Y') {
			$q_string .= "AND Pr_Long_Term LIKE 'Y' ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= $o_string;


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

	function get_rows()
	{
		$Pr_Zo_ID = $this->session->userdata('Pr_Zo_ID');  // save it for later
		$Pr_T2_ID = $this->session->userdata('Pr_T2_ID');  // save it for later
		$Pr_Bed = $this->session->userdata('Pr_Bed');  // save it for later
		$Pr_Price_DL = $this->session->userdata('Pr_Price_DL');  // save it for later
		$Pr_Price_DH = $this->session->userdata('Pr_Price_DH');  // save it for later
		$Pr_Price_WL = $this->session->userdata('Pr_Price_WL');  // save it for later
		$Pr_Price_WH = $this->session->userdata('Pr_Price_WH');  // save it for later
		$Pr_Price_ML = $this->session->userdata('Pr_Price_ML');  // save it for later
		$Pr_Price_MH = $this->session->userdata('Pr_Price_MH');  // save it for later
		$Pr_Long_Term = $this->session->userdata('Pr_Long_Term');  // save it for later
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
			"Pr_T1_ID = 2 AND " .
			$Pr_Price_DL . " <= Pr_DH AND " . $Pr_Price_DH . " >= Pr_DH AND " .
			$Pr_Price_WL . " <= Pr_WH AND " . $Pr_Price_WH . ">= Pr_WH AND " .
			$Pr_Price_ML . " <= Pr_MH AND " . $Pr_Price_MH . ">= Pr_MH AND " .
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
		if ($Pr_Long_Term == 'Y') {
			$q_string .= "AND Pr_Long_Term LIKE 'Y' ";
		} else {
		}
		if ($Keyword) {
			$q_string .= "AND (Pr_Desc LIKE '%$Keyword%' OR Pr_Name LIKE '%$Keyword%') ";
		} else {
		}
		$q_string .= "ORDER BY Pr_WH DESC";
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

	function get_article()
	{
		$Ar_ID = $this->uri->segment(3);
		$this->db->where('Ar_ID', $Ar_ID);
		$query = $this->db->get('Articles');
		return $query->result();
	}

	function get_agents()
	{
		$Ag_ID = $this->uri->segment(3);
		$this->db->where('Ag_ID', $Ag_ID);
		$query = $this->db->get('Agents');
		return $query->result();
	}

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

	function get_article_list()
	{
		$q_string = "SELECT * FROM Articles WHERE Ar_ArT_ID = 7 AND Ar_Vis LIKE 'Y' ORDER BY Ar_Date DESC ";

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