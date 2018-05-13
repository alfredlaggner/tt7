<?php

class Attachment extends Common_Auth_Controller
{
	function index()
	{
		$data = array();

		if ($query = $this->attachment_model->get_records()) {
			$data['title'] = 'Attachments';
			$data['title_action'] = 'Manage attachments';
			$data['top_note'] = 'List of your attachments';
			$data['breadcrumb'] = '';
			$data['records'] = $query;
			$this->parser->parse('attachment/attachment_over_view', $data);
		} else {

			$this->attachment_create();
		}
	}

	function attachment_view()
	{
		$data['title'] = 'attachment';
		$data['title_action'] = 'Edit attachment';
		$data['breadcrumb'] = '';
		$data['records'] = $this->attachment_model->get_record();
		$this->load->view('attachment/attachment_view', $data);
	}

	function attachment_create()
	{
		$data['title'] = 'New attachment';
		$data['title_action'] = 'Add attachment file';
		$data['breadcrumb'] = '';
		$this->load->view('attachment/attachment_create_view', $data);
	}

	function create()
	{
		$data = array(
			'attachment_name' => $this->input->post('attachment_name'),
			'file_name' => $this->input->post('file_name'),
		);

		$this->attachment_model->add_record($data);
		$this->index();
	}

	function update()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('file_name', 'File Name', 'required');
		$this->form_validation->set_rules('file_name', 'File Name', 'callback_file_name_check');
		if ($this->form_validation->run() == FALSE) {
			$this->attachment_view();
		} else {
			$data = array(
				'attachment_name' => $this->input->post('attachment_name'),
				'file_name' => $this->input->post('file_name'),
			);

			if ($this->input->post('delete') == "Delete") {
				$this->attachment_model->delete_record();
			} else {
				$this->attachment_model->update_record($data);
			}
			$this->index();
		}
	}

	public function file_name_check($fn)
	{
		$filename = "attachment_files/" . $fn;
		if (file_exists($filename)) {
			$this->form_validation->set_message('file_name_check', '%s does exist');
			return TRUE;
		} else {
			$this->form_validation->set_message('file_name_check', '%s ' . "'" . $fn . "'" . ' does not exist');
			return FALSE;
		}
	}

	function delete()
	{
		$this->attachment_model->delete_record();
		$this->index();
	}

}
