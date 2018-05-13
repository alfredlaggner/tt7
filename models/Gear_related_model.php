<?php

class Gear_related_model extends CI_Model
{

	function get_records($gear_id = 0)
	{
		if ($gear_id) $this->db->where('gear_id', $gear_id);

		$this->db->order_by('gear_id', 'asc');
		$query = $this->db->get('gear_related');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('gear_related_id', $this->uri->segment(3));
		$query = $this->db->get('gear_related');
		return $query->result();
	}

	function add_record($gear_id, $gear_count)
	{
		for ($i = 1; $i <= $gear_count; $i++) {
			$checked = 'gear_related_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$gear_related_id = 'gear_related_id' . $i;
				$gear_related_id_val = $this->input->post($gear_related_id);

//echo "gear_related_id =	" .	$gear_related_id . "<br>";
//echo "gear_related_id_val =	" .	$gear_related_id_val . "<br>";

				$this->db->query("REPLACE INTO gear_related (gear_id, gear_related_id) VALUES ('$gear_id','$gear_related_id_val')");
			};
		};
		return;
	}


	function xadd_record($gear_id)
	{
		$this->db->order_by('gear_id', 'asc');
		$query = $this->db->get('gear');
		$i = 1;
		foreach ($query->result() As $row) {
			if (isset($_POST['gear_related_id' . $i])) {
				echo '<br>' . $row->name;
				echo '<br>i= ' . $i;
				echo '<br>gear_id= ' . $row->gear_id;
				$data = array(
					'gear_related_id' => $row->gear_id,
					'gear_id' => $gear_id);
				$this->db->insert('gear_related', $data);
			};
			$i++;
		}
		return;
	}


	function xxxadd_record($data)
	{
		$this->db->insert('gear_related', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('gear_related_id', $this->uri->segment(3));
		$this->db->update('gear_related', $data);
	}

	function delete_record($gear_id)
	{

		$this->db->where('gear_id', $gear_id);
		$this->db->delete('gear_related');
	}

	function get_related_gears($gear_id)
	{
		$this->db->select('
			gear_related.*,
			gear.*, 
			gear_pictures.*, 
			gear_group.name AS gear_group_name
			');
		$this->db->where('gear_related.gear_id', $gear_id);
		$this->db->join('gear', 'gear.gear_id=gear_related.gear_related_id');
		$this->db->join('gear_group', 'gear.gear_group_id=gear_group.gear_group_id');
		$this->db->join('gear_pictures', 'gear_pictures.gear_id = gear.gear_id', 'left');
		$this->db->group_by('gear.gear_id'); //new	
		$query = $this->db->get('gear_related');
		return $query->result();

	}


}