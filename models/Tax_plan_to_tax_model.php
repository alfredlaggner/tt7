<?php

class Tax_plan_to_tax_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('tax_plan_to_tax');
		return $query->result();
	}

	function get_tax_plan_to_tax_records($tax_plan_id)
	{
		$this->db->select('*');
		$this->db->from('tax_plan_to_tax');
		$this->db->where('tax_plan_id', $tax_plan_id);
		$this->db->join('tax', 'tax.tax_id = tax_plan_to_tax.tax_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_tax_records($tax_plan_id)
	{
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax');
		return $query->result();
	}


	function get_record($tax_plan_id)
	{
		$this->db->where('tax_plan_id', $tax_plan_id);
		$query = $this->db->get('tax_plan_to_tax');
		return $query->result();
	}

	function add_record($tax_plan_id, $tax_count)
	{
		for ($i = 1; $i <= $tax_count; $i++) {
			$checked = 'tax_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$tax_id = 'tax_id' . $i;
				$tax_id_val = $this->input->post($tax_id);

//echo "tax_id =	" .	$tax_id . "<br>";
//echo "tax_id_val =	" .	$tax_id_val . "<br>";

				$this->db->query("REPLACE INTO tax_plan_to_tax (tax_plan_id, tax_id) VALUES ('$tax_plan_id','$tax_id_val')");
			};
		};
		return;
	}

	function update_record($data)
	{
		$this->db->where('tax_plan_id', $this->uri->segment(3));
		$this->db->update('tax_plan_to_tax', $data);
	}

	function delete_record($tax_plan_id, $tax_id)
	{
		$this->db->where('tax_plan_id', $tax_plan_id);
		$this->db->where('tax_id', $tax_id);
		$this->db->delete('tax_plan_to_tax');
	}

	function delete_tax_records($tax_id)
	{
		$this->db->where('tax_id', $tax_id);
		$this->db->delete('tax_plan_to_tax');
	}

}