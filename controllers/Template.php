<?php

class Template extends Common_Auth_Controller
{
	function index($activity_id = 0)
	{
		$data = array();

//echo 'xxxx=' . $activity_id;

		if ($query = $this->template_model->get_records()) {
			$manage_templates = array('manage_template' => TRUE);
			$this->session->set_userdata($manage_templates);
			$this->session->set_userdata('is_choose', '0');

			$data['title'] = 'eMail Templates';
			$data['title_action'] = 'Choose templates for an activity';
			$data['top_note'] = 'Select "All" if you are not sure';
			$data['activities'] = $this->activity_model->get_records();
			$data['records'] = $query;

			$data['activity_id'] = $activity_id;
			$this->load->view('templates/template_select_activity', $data);
		} else {

			$this->template_create();
		}
	}

	function template_over_view($activity_id = 0)
	{
		if (!$activity_id) $activity_id = $this->input->post('activity_id');


		if ($query = $this->template_model->get_records($activity_id)) {
			$data = array();
			$data['title'] = 'eMail Templates';
			$data['title_action'] = 'Manage  eMail Templates';
			$data['is_from_manage_templates'] = $this->session->userdata('manage_template');
			$data['top_note'] = $this->activity_model->get_activity_name($activity_id) ? $this->activity_model->get_activity_name($activity_id) : "All Activities";
			//		$data['activities'] = $this->activity_model->get_records();
			$data['records'] = $query;
			$data['activity_id'] = $activity_id;
			$data['activity_code'] = $this->activity_model->get_activity_code($activity_id);

			$this->load->view('templates/template_over_view', $data);
		} else {

			$this->template_create($activity_id);
		}

	}

	function return_to_activity_select($activity_id = 0)
	{

		$this->index($activity_id);
	}

	function xadd_attachments_to_templates($template_id, $attachment_count, $activity_id = 0)
	{
		if ($this->input->post('assign_attachments') == "Attach to emails") {
			$this->template_to_attachment_model->delete_template_records($template_id);
			$this->template_to_attachment_model->add_record($template_id, $attachment_count);
			$this->template_over_view($activity_id);
		} elseif ($this->input->post('add_attachment') == "Add new to list") {
			redirect('attachment/attachment_create_view/' . $template_id . '/' . $activity_id, 'refresh');

			// $this->attachment_create_view($template_id);
		} else {
			$this->template_over_view($activity_id);
		}
	}


	function template_view($template_id)
	{
		$data['title'] = 'eMail Template';
		$data['title_action'] = 'Edit template';
		$data['records'] = $this->template_model->get_record();
		$data['template_id'] = $template_id;
		$data['activities'] = $this->activity_model->get_records();
		$data['place_holders_text'] = $this->template_model->get_place_holders_text();
		$data['attachments'] = $this->attachment_model->get_records();
		$data['attachment_count'] = $this->attachment_model->count_all();
		$data['template_attachments'] = $this->template_to_attachment_model->get_template_to_attachment_records($template_id);
		$this->load->view('templates/template_view', $data);
	}

	function template_edit($template_id)
	{
		$data['title'] = 'eMail Template';
		$data['title_action'] = 'Modify template for this mailing';
		$data['records'] = $this->template_model->get_record_sample();
		$data['regions'] = $this->region_model->get_records();
		$data['template_id'] = $template_id;
		$data['attachments'] = $this->attachment_model->get_records();
		$data['attachment_count'] = $this->attachment_model->count_all();
		$data['template_attachments'] = $this->template_to_attachment_model->get_template_to_attachment_records($template_id);
		$this->load->view('templates/template_edit', $data);
	}

	function print_r2($val)
	{
		echo '<pre>';
		print_r($val);
		echo '</pre>';
	}

	function send_reminder_emails()
	{

		$customer_data = $this->template_model->send_reminder_emails();
//print_r2($customer_data); die();
		echo 'Reminder emails being sent....';
		$count = 1;
		foreach ($customer_data as $row) {
			// $this->print_r2($row); die();

			echo 'Email number ' . $count . ' sending to: ' . $row->first_name . ' ' . $row->last_name . ' ' . $row->email . ' Event: ' . $row->activity_name . ' on: ' . $row->event_date . '<br>';

			$this->email->from('alfred.laggner@gmail.com', 'Name');
			$this->email->to('treatment@acupuncture-ensenada.com');

//					$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
//					$this->email->to('alfred.laggner@gmail.com'); 
//					$this->email->to($row->email); 
			//			$this->email->cc('info@treksandtracks.com');

			//	print_r($this->template_model->substitute_text($row->subject, $row->customer_id, $row->event_id));
//echo $row->ledger_activity_id . '<br>';
//echo $row->location_id . '<br>';
			$this->email->subject($this->template_model->substitute_text($row->subject, $row->customer_id, $row->event_id));
			$this->email->message($this->template_model->substitute_text($row->body, $row->customer_id, $row->event_id));

			$this->template_to_attachment_model->put_attachments($row->template_id);

			if ($this->email->send()) {
				//		if (TRUE) {
				//			echo 'Your e-mail has been sent! <br>';

				$data = array();
				$data = array(
					'customer_id' => $row->customer_id,
					'date_time' => date(TIME_FORMAT),
					'to' => $row->email,
					'subject' => $this->template_model->substitute_text($row->subject, $row->customer_id, $row->event_id),
					'body' => $this->template_model->substitute_text($row->body, $row->customer_id, $row->event_id),
					'purpose' => $row->name,
					'is_incoming' => FALSE,
					'is_automated' => TRUE,
				);
				$this->mail_model->add_record($data);
				$data = array(
					'is_automated_sent' => TRUE,
					'is_automated_sent_at' => date(TIME_FORMAT),
					'template_id' => $row->template_id,
				);
				$this->ledger_model->update_record($row->ledger_id, $data);

			} else {
				// echo $this->email->print_debugger(array('headers'));
			}
			$count++;
		}

		$this->email->clear(true);
		echo '<br>' . $count - 1 . ' emails sent!';
		die();
	}

	function template_create($activity_id = 0)
	{
		$data['title'] = 'New template';
		$data['title_action'] = 'Create template for ' . $this->activity_model->get_activity_name($activity_id);
		$data['regions'] = $this->region_model->get_records();
		$data['activity_id'] = $activity_id;
		$data['place_holders_text'] = $this->template_model->get_place_holders_text();
		$this->load->view('templates/template_create', $data);
	}

	function create()
	{
		if ($this->input->post('submit') == "Save") {
			$data = array(
				'name' => $this->input->post('name'),
				'activity_id' => $this->input->post('activity_id'),
				'subject' => $this->input->post('subject'),
				'is_active' => isset($_POST['is_active']) ? 1 : 0,
				'is_automated' => isset($_POST['is_automated']) ? 1 : 0,
				'is_confirmation' => isset($_POST['is_confirmation']) ? 1 : 0,
				'send_interval' => $this->input->post('send_interval'),
				'body' => $this->input->post('body'),
			);

			$this->template_model->add_record($data);
		}

		$this->index($this->input->post('activity_id'));
	}

	function update($template_id = 0, $activity_id = 0)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'subject' => $this->input->post('subject'),
			'body' => $this->input->post('body'),
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'is_automated' => isset($_POST['is_automated']) ? 1 : 0,
			'is_confirmation' => isset($_POST['is_confirmation']) ? 1 : 0,
			'send_interval' => $this->input->post('send_interval'),
		);

		if ($this->input->post('delete') == "Delete") {
			$this->template_model->delete_record();
		} elseif (($this->input->post('submit') == "Update")) {
			$this->template_model->update_record($data);
		}

		$this->template_over_view($activity_id);
	}

	function delete()
	{
		$this->template_model->delete_record();
		$this->template_over_view();
	}

}
