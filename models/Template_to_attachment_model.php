<?php

class Template_to_attachment_model extends CI_Model
{

	function get_records()
	{
		$query = $this->db->get('template_to_attachment');
		return $query->result();
	}

	function get_template_to_attachment_records($template_id)
	{
		$this->db->select('*');
		$this->db->from('template_to_attachment');
		$this->db->where('template_id', $template_id);
		$this->db->join('attachment', 'attachment.attachment_id = template_to_attachment.attachment_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_attachment_records($template_id)
	{
		$this->db->where('template_id', $template_id);
		$query = $this->db->get('attachment');
		return $query->result();
	}

	function put_attachments($template_id)
	{
		$this->db->select('*');
		$this->db->from('template_to_attachment');
		$this->db->where('template_id', $template_id);
		$this->db->join('attachment', 'attachment.attachment_id = template_to_attachment.attachment_id');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$file_name = "attachment_files/" . $row->file_name;
			$this->email->attach($file_name);
		}
		return true;
	}


	function get_record($template_id)
	{
		$this->db->where('template_id', $template_id);
		$query = $this->db->get('template_to_attachment');
		return $query->result();
	}

	function add_record($template_id, $attachment_count)
	{
		for ($i = 1; $i <= $attachment_count; $i++) {
			$checked = 'attachment_add' . $i;
//echo "checked =	" .	$checked . "<br>";
//echo "clicked =	" .	isset($_POST[$checked]) . "<br>";
			if (isset($_POST[$checked])) {
				$attachment_id = 'attachment_id' . $i;
				$attachment_id_val = $this->input->post($attachment_id);

//echo "attachment_id =	" .	$attachment_id . "<br>";
//echo "attachment_id_val =	" .	$attachment_id_val . "<br>";

				$this->db->query("REPLACE INTO template_to_attachment (template_id, attachment_id) VALUES ('$template_id','$attachment_id_val')");
			};
		};
		return;
	}

	function update_record($data)
	{
		$this->db->where('template_id', $this->uri->segment(3));
		$this->db->update('template_to_attachment', $data);
	}

	function delete_record($template_id, $attachment_id)
	{
		$this->db->where('template_id', $template_id);
		$this->db->where('attachment_id', $attachment_id);
		$this->db->delete('template_to_attachment');
	}

	function delete_attachment_records($attachment_id)
	{
		$this->db->where('attachment_id', $attachment_id);
		$this->db->delete('template_to_attachment');
	}

	function delete_template_records($template_id)
	{
		$this->db->where('template_id', $template_id);
		$this->db->delete('template_to_attachment');
	}
}