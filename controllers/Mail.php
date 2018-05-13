<?php

class Mail extends Common_Auth_Controller
{
	function index($read_mail = TRUE)  // set to true when done testing
	{
		$data['title'] = 'Mail';
		$data['title_action'] = 'Manage Mail';
		$data['top_note'] = 'Check for new mail';
		$data['bottom_note'] = '';


		// Date to start search
// How far back in time do you want to search for unread messages - one month = 0 , two weeks = 1, one week = 2, three days = 3,
// one day = 4, six hours = 5 or one hour = 6 e.g.--> $m_t = 6;
		$m_t = 0;
		$m_gunixtp = array(2592000, 1209600, 604800, 259200, 86400, 21600, 3600, 0);
//		$m_gdmy = date('d-M-Y', time() - $m_gunixtp[$m_t]); 
//		$m_search ='UNSEEN SINCE ' . $m_gdmy;
		$m_gdmy = date('d-M-Y', time() - $m_gunixtp[$m_t]);
		$m_search = 'ON ' . $m_gdmy;

		$data['top_note'] = $m_search;
		if ($read_mail)
			$this->mail_model->get_mail($m_search);
		$data['records'] = $this->mail_model->get_records();
		$this->load->view('mail/mail_over_view', $data);

	}

	function mail_view()
	{
		$data['title'] = 'Mail';
		$data['title_action'] = 'Edit Mail';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['customers'] = $this->customer_contact_model->get_active_customers();
		$data['records'] = $this->mail_model->get_record();
		$this->load->view('mail/mail_view', $data);
//		$this->index("no_read");
	}

	function update()
	{
		$data = array(
			'seen' => '1',
			'customer_id' => $this->input->post('customer_id'),
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index(FALSE);
		} elseif ($this->input->post('assign_customer') == "Assign Customer") {
			$this->mail_model->update_record($data);
			// add customer contact
			$data = array(
				'customer_id' => $this->input->post('customer_id'),
				'note' => $this->input->post('subject'),
				'entered_at' => date(TIME_FORMAT),
				'type_id' => '3',
				'mail_id' => $this->input->post('mail_id')
			);

			$this->customer_contact_model->add_record($data);
			$this->index(FALSE);
		} else {
			$this->index(FALSE);
		};
	}

	function delete()
	{
		$this->mail_model->delete_record();
//		$data['records'] = $this->mail_model->get_records();
//		$this->load->view('mail/mail_over_view', $data);

		$this->index(FALSE);
	}

	function location_create()
	{
		$data['title'] = 'New Location';
		$data['title_action'] = 'Create Location';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$this->load->view('location/location_create_view', $data);
	}


//	function test_mail()
//	{
//		/* try to connect */
//		$hostname = '{imap.terra-mar.info:143/novalidate-cert}INBOX';
//		$username = 'acupuncture@pvpetcare.net';
//		$password = 'jahai999';
//		$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to mail: ' . imap_last_error());
//		
//		/* grab emails */
//		$emails = imap_search($inbox,'ALL');
//		
//		/* if emails are returned, cycle through each... */
//		if($emails) {
//		  
//		  /* begin output var */
//		  $output = '';
//		  
//		  /* put the newest emails on top */
//		  rsort($emails);
//		  
//		  /* for every email... */
//		  foreach($emails as $email_number) {
//			
//			/* get information specific to this email */
//			$overview = imap_fetch_overview($inbox,$email_number,0);
//			$message = imap_fetchbody($inbox,$email_number,2);
//			
//			/* output the email header information */
//			$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
//			$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
//			$output.= '<span class="from">'.$overview[0]->from.'</span>';
//			$output.= '<span class="date">on '.$overview[0]->date.'</span>';
//			$output.= '</div>';
//			
//			/* output the email body */
//			$output.= '<div class="body">'.$message.'</div>';
//		  }
//		  
//		  echo $output;
//}
// else
// echo "Nix da";
//
///* close the connection */
//imap_close($inbox);
//}
	function create()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);

		$this->style_model->add_record($data);
		redirect('style');
	}

}
// Connect to a local pop3 server
/* connect to gmail */
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//$username = 'alfred.laggner@gmail.com';
//$password = 'Ilm2dogs12$';
//$hostname = 'imap.terra-mar.info';


//$hostname = 'imap.terra-mar.info';
//$username = 'acupuncture@pvpetcare.net';
//$password = 'jahai999';
//$mailbox = new fMailbox('imap', $hostname, $username, $password);	
//$messages = $mailbox->listMessages($limit=10);
//if(isset($messages))
//{
//	foreach($messages as $message) 
//	{
//		echo $message['received'];
//		echo $message['subject'];
//		echo '<br>';
//		$uid = $message['uid'];
//		$content = $mailbox->fetchMessage($uid,TRUE);
//		echo $content['text'];
//		echo '<br>';
//		echo '<br>';
//		
//	}
//}

