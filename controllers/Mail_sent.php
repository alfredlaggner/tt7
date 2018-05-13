<?php

class Mail_sent extends Common_Auth_Controller
{
	function index($date_from = 0, $date_to = 0)
	{
		$data['title'] = 'eMails';
		$data['title_action'] = 'Overview of outgoing eMails';
		$data['top_note'] = '';
		$data['bottom_note'] = '';
		$data['admin_head'] = $this->load->view('templates/admin_head', $data, TRUE);
		$data['admin_top_bar'] = $this->load->view('templates/admin_top_bar', $data, TRUE);
		$data['admin_header'] = $this->load->view('templates/admin_header', $data, TRUE);
		$data['admin_footer'] = $this->load->view('templates/admin_footer', $data, TRUE);
		$data['top_note'] = 'Sent mail to customers';

		$data['admin_head'] = $this->load->view('templates/admin_head', $data, TRUE);
		$data['records'] = $this->mail_sent_model->get_records($date_from, $date_to);

		//	print_r2($data['records']);

		$this->load->view('mail/mail_sent_over_view', $data);

	}

	function mail_sent_view()
	{
		$data['title'] = 'Outgoing  eMail';
		$data['title_action'] = 'View outgoing eMail for ';
		$data['breadcrumb'] = '';
		$data['customers'] = $this->customer_contact_model->get_active_customers();
		$data['records'] = $this->mail_sent_model->get_record();


		$this->load->view('mail/mail_sent_view', $data);
	}


	function check_dates()
	{
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$this->index($date_from, $date_to);
	}


	function go_return()
	{
		$this->index();
	}

	function delete()
	{
		$this->mail_sent_model->delete_record();
		$this->index();
	}
}
	

