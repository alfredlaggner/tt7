<?php

class Activity_related_model extends CI_Model
{

	function get_records($activity_id = 0)
	{
		if ($activity_id) $this->db->where('activity_id', $activity_id);

		$this->db->order_by('activity_id', 'asc');
		$query = $this->db->get('activity_related');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('activity_related_id', $this->uri->segment(3));
		$query = $this->db->get('activity_related');
		return $query->result();
	}

	function add_record($activity_id, $activity_count)
	{
		for ($i = 1; $i <= $activity_count; $i++) {
			$checked = 'activity_related_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$activity_related_id = 'activity_related_id' . $i;
				$activity_related_id_val = $this->input->post($activity_related_id);

//echo "activity_related_id =	" .	$activity_related_id . "<br>";
//echo "activity_related_id_val =	" .	$activity_related_id_val . "<br>";

				$this->db->query("REPLACE INTO activity_related (activity_id, activity_related_id) VALUES ('$activity_id','$activity_related_id_val')");
			};
		};
		return;
	}


	function xadd_record($activity_id)
	{
		$this->db->order_by('activity_id', 'asc');
		$query = $this->db->get('activity');
		$i = 1;
		foreach ($query->result() As $row) {
			if (isset($_POST['activity_related_id' . $i])) {
				echo '<br>' . $row->name;
				echo '<br>i= ' . $i;
				echo '<br>activity_id= ' . $row->activity_id;
				$data = array(
					'activity_related_id' => $row->activity_id,
					'activity_id' => $activity_id);
				$this->db->insert('activity_related', $data);
			};
			$i++;
		}
		return;
	}


	function xxxadd_record($data)
	{
		$this->db->insert('activity_related', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('activity_related_id', $this->uri->segment(3));
		$this->db->update('activity_related', $data);
	}

	function delete_record($activity_id)
	{

		$this->db->where('activity_id', $activity_id);
		$this->db->delete('activity_related');
	}

}