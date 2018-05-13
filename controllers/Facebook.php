<?php

class Facebook extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('facebook');

		$facebook = new MY_Facebook();

		$user = $facebook->getUser();

		if ($user) {
			try {
				$user_profile = $facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			}
		}

		if ($user) {
			$logoutUrl = $facebook->getLogoutUrl();
			echo "<a href=\"$logoutUrl\">Logout</a>";
		} else {
			$loginUrl = $facebook->getLoginUrl();
			echo "<a href=\"$loginUrl\">Login with Facebook</a>";
		}


		echo "<pre>";

		var_dump($user);
		var_dump($_SESSION);
	}


}
