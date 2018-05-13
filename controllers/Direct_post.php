<?php

class Direct_post extends Common_Auth_Controller
{
	function index()
	{
		require_once 'anet_php_sdk/AuthorizeNet.php'; // The SDK
		$url = base_url() . "index.php/direct_post";
		$api_login_id = '75DKLjwjEr3s';
		$transaction_key = '5eK46Ptp68xFH94d';
		$md5_setting = '75DKLjwjEr3s'; // Your MD5 Setting
		$amount = "5.99";
		AuthorizeNetDPM::directPostDemo($url, $api_login_id, $transaction_key, $amount, $md5_setting);
	}
}