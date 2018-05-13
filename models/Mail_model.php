<?php

class Mail_model extends CI_Model
{

	function get_mail($subset)
	{
		$this->config->load('mail');
		$username = $this->config->item('username'); //"alfred.laggner@gmail.com";
		$password = $this->config->item('password'); //"Ilm2dogs12$";
		$hostname = $this->config->item('hostname');  //"{imap.gmail.com:993/imap/ssl}INBOX";

//	echo	$username ; //"alfred.laggner@gmail.com";
//	echo	$password ; //"Ilm2dogs12$";
//	echo	$hostname ;  //"{imap.gmail.com:993/imap/ssl}INBOX";

//		$hostname = '{imap.terra-mar.info:143/novalidate-cert}INBOX';
//		$username = 'acupuncture@pvpetcare.net';
//		$password = 'jahai999';
		$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail: ' . imap_last_error());

//	$imap = $inbox;
//     $n_msgs = imap_num_msg($imap);
//  /****** adding this line: ******/
//     imap_headers($imap);
//  /***************************/
//     $s = microtime(true);
//     for ($i=0; $i<$n_msgs; $i++) {
//          $header = imap_header($imap, $i);
//		  echo $header->fromaddress . '<br>';
//     }
//     $e = microtime(true);
//     echo ($e - $s);
//     imap_close($imap);		
//	 
//	 

		/* grab emails */
		$emails = imap_search($inbox, $subset);

		/* if emails are returned, cycle through each... */
		if ($emails) {

			/* begin output var */
			$output = '';

			/* put the newest emails on top */
			rsort($emails);

			/* for every email... */
			foreach ($emails as $email) {

				/* get information specific to this email */
//$overview = imap_headerinfo($inbox, $email);
				$overview = imap_fetch_overview($inbox, $email, 0);
				$message = imap_fetchbody($inbox, $email, 2);
				$data = array();
				$data['seen'] = $overview[0]->seen ? 'read' : 'unread';
				$data['subject'] = $overview[0]->subject;
				$data['from'] = $overview[0]->from;
				$date = new DateTime($overview[0]->date);
//echo $date->format('Y-m-d') . '<br>';			
				$data['date_time'] = $date->format('Y-m-d H:i:s');
				$data['body'] = $this->decode_headers($message);
				$this->db->replace('mail', $data);
			}
			imap_close($inbox);
			return (TRUE);
		} else {
			echo "Nix da";
			imap_close($inbox);
			return (FALSE);
		}

		imap_close($inbox);
		return;
	}

	function decode_headers($cabecalho)
	{
		while (preg_match('/^(.*)=\?([^?]*)\?(Q|B)\?(.*)$/Ui', $cabecalho)) {
			$cabecalho = preg_replace("/(\t|\r|\n)/", "", $cabecalho);
			$cabecalho = preg_replace("/\?(Q|B)\?=/Ui", "?\\1? =", $cabecalho);

			$partes_cabecalho = explode("?=", $cabecalho);

			$resultado = "";
			foreach ($partes_cabecalho as $texto) {
				$texto = preg_replace("/\?(Q|B)\?\s=/Ui", "?\\1?=", $texto);
				$texto = preg_replace("/\?(Q|B)\?/Ui", "=?\\1=?", $texto);

				if (preg_match('/^(.*)=\?([^?]*)=\?(Q|B)=\?(.*)$/Ui', $texto)) {
					$partes_texto = explode("=?", $texto);

					$parte = descodificar_parte($partes_texto[0], $partes_texto[1]);
					$parte .= descodificar_parte($partes_texto[3], $partes_texto[2]);
				} else {
					$parte = $texto;
				}

				if (strtoupper($partes_texto[1]) == "UTF-8") {
					$parte = utf8_decode($parte);
				}
				$resultado .= $parte;
			}
			$cabecalho = $resultado;
		}

		return trim($cabecalho);
	}

	function get_records()
	{
		$this->db->order_by('date_time', 'asc');
		$query = $this->db->get('mail');
		return $query->result();
	}

	function get_record()
	{
		$this->db->where('mail_id', $this->uri->segment(3));
		$query = $this->db->get('mail');
		return $query->result();
	}

	function add_record($data)
	{
		$this->db->insert('mail', $data);
		return;
	}

	function replace_record($data)
	{
		$this->db->replace('mail', $data);
		return;
	}

	function update_record($data)
	{
		$this->db->where('mail_id', $this->uri->segment(3));
		$this->db->update('mail', $data);
	}

	function delete_record()
	{
		$this->db->where('mail_id', $this->uri->segment(3));
		$this->db->delete('mail');
	}

	function descodificar_parte($texto, $codificacao)
	{
		if (trim($texto) == "") {
			return "";
		}

		if (ucfirst($codificacao) == "B") {
			$texto = base64_decode($texto);
			$texto = htmlspecialchars($texto);
		} else if (ucfirst($codificacao) == "Q") {
			$texto = str_replace("_", " ", $texto);
			$texto = quoted_printable_decode($texto);
		}
		return $texto;
	}

	function gmail()
	{
		/* Created on: 11/3/2008 By Ron Hickey 6tx.net/gmail_mod 
	   Gmail mod for admin panels or you can edit it and convert html results to XML for personal RSS reader */

// enter gmail username below e.g.--> $m_username = "yourusername";
		$m_username = "alfred.laggner";

// enter gmail password below e.g.--> $m_password = "yourpword";
		$m_password = "Ilm2dogs12$";

// enter the number of unread messages you want to display from mailbox or 
//enter 0 to display all unread messages e.g.--> $m_acs = 0; 
		$m_acs = 15;

// How far back in time do you want to search for unread messages - one month = 0 , two weeks = 1, one week = 2, three days = 3,
// one day = 4, six hours = 5 or one hour = 6 e.g.--> $m_t = 6;
		$m_t = 2;

//----------->Nothing More to edit below
//open mailbox..........please
		$m_mail = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", $m_username . "@gmail.com", $m_password)

// or throw a freakin error............you pig
		or die("ERROR: " . imap_last_error());

// unix time gone by or is it bye.....its certanly not bi.......or is it? ......I dunno fooker 
		$m_gunixtp = array(2592000, 1209600, 604800, 259200, 86400, 21600, 3600);

// Date to start search
		$m_gdmy = date('d-M-Y', time() - $m_gunixtp[$m_t]);

//search mailbox for unread messages since $m_t date 
		$m_search = imap_search($m_mail, 'UNSEEN SINCE ' . $m_gdmy . '');

//If mailbox is empty......Display "No New Messages", else........ You got mail....oh joy
		$m_empty = "";
		if ($m_search < 1) {
			$m_empty = "No New Messages";
		} else {

// Order results starting from newest message
			rsort($m_search);

//if m_acs > 0 then limit results
			if ($m_acs > 0) {
				array_splice($m_search, $m_acs);
			}

//loop it 
			foreach ($m_search as $what_ever) {

//get imap header info for obj thang 
				$obj_thang = imap_headerinfo($m_mail, $what_ever);

//Then spit it out below.........if you dont swallow 
				echo "<body bgcolor=D3D3D3><div align=center><br /><font face=Arial size=2 color=#800000>Message ID# " . $what_ever . "</font>

<table bgcolor=#D3D3D3 width=700 border=1 bordercolor=#000000 cellpadding=0 cellspacing=0>
<tr>
<td><table width=100% border=0>
<tr>
<td><table width=100% border=0>
<tr>
<td bgcolor=#F8F8FF><font face=Arial size=2 color=#800000>Date:</font> <font face=Arial size=2 color=#000000>" . date("F j, Y, g:i a", $obj_thang->udate) . "</font></td>
<td bgcolor=#F8F8FF><font face=Arial size=2 color=#800000>From:</font> <font face=Arial size=2 color=#000000>" . $obj_thang->fromaddress . "</font></td>
<td bgcolor=#F8F8FF><font face=Arial size=2 color=#800000>To:</font> <font face=Arial size=2 color=#000000>" . $obj_thang->toaddress . " </font></td>
</tr>
<tr>
</table>
</td>
</tr><tr><td bgcolor=#F8F8FF><font face=Arial size=2 color=#800000>Subject:</font> <font face=Arial size=2 color=#000000>" . $obj_thang->Subject . "</font></td></tr><tr>
</tr>
</table></td>
</tr>
</table><a href=http://gmail.com target=_blank><font face=Arial size=2 color=#800000>Login to read message</a></font><br /></div></body>";

			}
		}
		echo "<div align=center><font face=Arial size=4 color=#800000><b>" . $m_empty . "</b></font></div>";
//close mailbox bi by bye
		imap_close($m_mail);
	}
}