<?php class Send_reminders extends CI_Controller
{
	function index()
	{
		$customer_data = $this->template_model->send_reminder_emails();
		$count = 0;
		foreach ($customer_data as $row) {

			echo 'email sent to: ' . $row->first_name . ' ' . $row->last_name . ' ' . $row->email . '<br>';

			$this->email->from('info@treksandtracks.com', 'Treks and Tracks LLC');
			$this->email->to('alfred.laggner@gmail.com');
			$this->email->subject($this->template_model->substitute_text($row->subject, $row->customer_id, $row->event_id));
			$this->email->message($this->template_model->substitute_text($row->body, $row->customer_id, $row->event_id));

			$this->template_to_attachment_model->put_attachments($row->template_id);

			if ($this->email->send()) {
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
// for test purposes turn off 	

				$data = array(
					'is_automated_sent' => TRUE,
					'is_automated_sent_at' => date(TIME_FORMAT),
					'template_id' => $row->template_id,
				);
				$this->ledger_model->update_record($row->ledger_id, $data);
//echo "i got here";
//echo $row->ledger_id . '<br>';
			} else {
				// echo $this->email->print_debugger(array('headers'));
			}
			$count++;
		}

		$this->email->clear(true);
		echo $count . ' emails sent!';
		die();
	}


}
