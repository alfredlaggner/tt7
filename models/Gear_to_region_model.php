<?php

class Gear_to_region_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('gear_to_region');
		return $query->result();
	}

	function get_gear_to_region_records($gear_id)
	{
		$this->db->select('*');
		$this->db->from('gear_to_region');
		$this->db->where('gear_id', $gear_id);
		$this->db->join('region', 'region.region_id = gear_to_region.region_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_region_records($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('region');
		return $query->result();
	}

	function get_region_string($gear_id)
	{
		$regions_string = '';
		$this->db->select('*');
		$this->db->from('gear_to_region');
		$this->db->where('gear_id', $gear_id);
		$this->db->join('region', 'region.region_id = gear_to_region.region_id');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$regions_string .= $row->initials . ' ';
		}
		if (!$regions_string)
			$regions_string = "n/a";
		else
			substr($regions_string, 0, -2);

		return $regions_string;
	}


	function get_record($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$query = $this->db->get('gear_to_region');
		return $query->result();
	}

	function add_record($gear_id, $region_count)
	{
		for ($i = 1; $i <= $region_count; $i++) {
			$checked = 'region_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$region_id = 'region_id' . $i;
				$region_id_val = $this->input->post($region_id);

//echo "region_id =	" .	$region_id . "<br>";
//echo "region_id_val =	" .	$region_id_val . "<br>";

				$this->db->query("REPLACE INTO gear_to_region (gear_id, region_id) VALUES ('$gear_id','$region_id_val')");
			};
		};
		return;
	}

	function update_record($data)
	{
		$this->db->where('gear_id', $this->uri->segment(3));
		$this->db->update('gear_to_region', $data);
	}

	function delete_record($gear_id, $region_id)
	{
		$this->db->where('gear_id', $gear_id);
		$this->db->where('region_id', $region_id);
		$this->db->delete('gear_to_region');
	}

	function delete_region_records($region_id)
	{
		$this->db->where('region_id', $region_id);
		$this->db->delete('gear_to_region');
	}

	function delete_event_records($gear_id)
	{
		$this->db->where('gear_id', $gear_id);
		$this->db->delete('gear_to_region');
	}
}