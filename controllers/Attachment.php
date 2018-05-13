<?php

class Attachment extends Common_Auth_Controller
{
	function index($template_id, $activity_id = 0)
	{
		$data = array();

		$data['title'] = 'Attachments';
		$data['title_action'] = 'Manage attachments';
		$data['top_note'] = 'List of your attachments';
		$data['breadcrumb'] = '';
		$data['place_holders_text'] = $this->template_model->get_place_holders_text();
		$data['records'] = $this->template_model->get_record($template_id);
		$data['template_id'] = $template_id;
		$data['activity_id'] = $activity_id;
		$data['attachments'] = $this->attachment_model->get_records();
		$data['attachment_count'] = $this->attachment_model->count_all();
		$data['template_attachments'] = $this->template_to_attachment_model->get_template_to_attachment_records($template_id);
		$this->parser->parse('attachment/attachment_over_view', $data);
	}

	function add_attachments_to_templates($template_id, $attachment_count, $activity_id = 0)
	{
		if ($this->input->post('assign_attachments') == "Attatch to emails") {
			$this->template_to_attachment_model->delete_template_records($template_id);
			$this->template_to_attachment_model->add_record($template_id, $attachment_count);
			$this->index($template_id, $activity_id);
		} elseif ($this->input->post('add_attachment') == "Add new to list") {
			$this->attachment_create_view($template_id, $activity_id);
			$this->index($template_id, $activity_id);
		} elseif ($this->input->post('cancel_attachments') == "Return to emails") {
			redirect('template/template_over_view/' . $activity_id);
		} else {
			redirect('template/template_over_view/' . $activity_id);
		}
	}


	function attachment_view($attachment_id, $template_id)
	{
		$data['title'] = 'attachment';
		$data['title_action'] = 'Edit attachment';
		$data['breadcrumb'] = '';
		$data['template_id'] = $template_id;
		$data['records'] = $this->attachment_model->get_record();
		$this->load->view('attachment/attachment_view', $data);
	}

	function attachment_create_view($template_id, $activity_id)
	{
		$data['title'] = 'New attachment';
		$data['title_action'] = 'Create attachment';
		$data['breadcrumb'] = '';
		$data['template_id'] = $template_id;

		$data['attachment_files'] = get_filenames(FCPATH . 'attachment_files/');
		//	print_r2( $data['attachment_files']);die();
		$this->load->view('attachment/attachment_create_view', $data);
	}

	function attachment_create()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('file_name', 'File Name', 'required');
		$this->form_validation->set_rules('file_name', 'File Name', 'callback_file_name_check');
		if ($this->form_validation->run() == FALSE) {
			$this->attachment_create_view($this->input->post('template_id'), $this->input->post('activity_id'));
		} else {
			$data = array(
				'attachment_name' => $this->input->post('attachment_name'),
				'file_name' => $this->input->post('file_name'),
			);

			$this->attachment_model->add_record($data);
			$this->index($this->input->post('template_id'), $this->input->post('activity_id'));
		}
	}

	function attachment_update($attachment_id, $template_id, $activity_id = 0)
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('file_name', 'File Name', 'required');
		$this->form_validation->set_rules('file_name', 'File Name', 'callback_file_name_check');
		if ($this->form_validation->run() == FALSE) {
			$this->attachment_view($this->input->post('template_id'));
		} else {
			$data = array(
				'attachment_name' => $this->input->post('attachment_name'),
				'file_name' => $this->input->post('file_name'),
			);

			if ($this->input->post('delete') == "Delete") {
				$this->attachment_model->delete_record($attachment_id);
			} else {
				$this->attachment_model->update_record($attachment_id, $data);
			}

//redirect('template/template_edit/' . $this->input->post('template_id'), 'refresh');
			$this->index($this->input->post('template_id'), $this->input->post('activity_id'));
		}
	}

	public function file_name_check($fn)
	{
		$filename = FCPATH . "attachment_files/" . $fn;

		if (file_exists($filename)) {
			$this->form_validation->set_message('file_name_check', '%s does exist');
			return TRUE;
		} else {
			$this->form_validation->set_message('file_name_check', '%s ' . "'" . $filename . "'" . ' does not exist');
			return FALSE;
		}
	}

	function attachment_delete($attachment_id, $template_id, $activity_id = 0)
	{
		$this->attachment_model->delete_record();
		//redirect('template/template_edit/' . $template_id, 'refresh');
		$this->index($template_id, $activity_id);
		//  $this->template_edit($template_id);
	}

	function upload_attachments()
	{
		$data['title'] = 'Attachments';
		$data['title_action'] = 'Manage attachments';
		$data['top_note'] = 'List of your attachments';
		//     $data['error'] = array('error' => ' ');
		$data['error'] = ' ';
		$this->load->view('attachment/attachment_upload', $data);
	}

	function do_upload()
	{
		$data['title'] = 'Attachments';
		$data['title_action'] = 'Manage attachments';
		$data['top_note'] = 'List of your attachments';
		$data['error'] = '';


		$config['upload_path'] = './attachment_files/';
		$config['allowed_types'] = 'txt|pdf|docx';
		$config['max_size'] = '500';


		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();

			$this->load->view('attachment/attachment_upload', $data);
		} else {
			$data['error'] = '';
			$data['upload_data'] = $this->upload->data();

			$this->load->view('attachment/attachment_success', $data);
		}
	}

}
