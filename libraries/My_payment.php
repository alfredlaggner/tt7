<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Authorize.net Payment Module
|--------------------------------------------------------------------------
|
| Just add the following config to your application/config/config.php file
|
| $config['at_login']	= "xxxxxxxxxx"; //your login
| $config['at_password']	= "xxxxxxxxxxxx"; //your transaction key
| $config['at_test']	= 1; //Set to 0 for live transactions
| $config['at_debug']	= 1; //Set to 0 for live transactions
| $config['at_site'] = 'https://test.authorize.net/gateway/transact.dll'; //comment for live trans
| //$config['at_site'] = 'https://secure.authorize.net/gateway/transact.dll'; //uncomment for live trans
|
|	Call it by doing this:
|
|		$this->load->library('my_payment');
|		$params->cc = '1293081309812039812039' ;//etc... you get the idea
|		
|		$result = $this->my_payment->authorize($params);
|		print_r($result); //response codes from authorize.net
|
|
|
*/

class My_payment
{

	public function Authorize($params)
	{
		$CI =& get_instance();

		$x_Login = $CI->config->item('at_login');
		$x_Password = $CI->config->item('at_password');

		$DEBUGGING = $CI->config->item('at_debug');
		$TESTING = $CI->config->item('at_test');
		$ERROR_RETRIES = 2;

		$auth_net_url = $CI->config->item('at_site');

		$authnet_values = array
		(
			"x_login" => $x_Login,
			"x_version" => "3.1",
			"x_delim_char" => "|",
			"x_delim_data" => "TRUE",
			"x_type" => "AUTH_CAPTURE",
			"x_method" => "CC",
			"x_tran_key" => $x_Password,
			"x_relay_response" => "FALSE",
			"x_card_num" => $params->cc,
			"x_exp_date" => $params->exp,
			"x_description" => $params->desc,
			"x_amount" => $params->amount,
			"x_first_name" => $params->firstName,
			"x_last_name" => $params->lastName,
			"x_address" => $params->address,
			"x_city" => $params->city,
			"x_state" => $params->state,
			"x_zip" => $params->zip,
			"CustomerBirthMonth" => $params->customerMonth,
			"CustomerBirthDay" => $params->customerDay,
			"CustomerBirthYear" => $params->customerYear,
			"SpecialCode" => $params->specialCode,
		);

		$fields = "";
		foreach ($authnet_values as $key => $value) $fields .= "$key=" . urlencode($value) . "&";

		$ch = curl_init($auth_net_url);

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim($fields, "& "));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$result = curl_exec($ch);

		curl_close($ch);

		return $result;

	}
}
/* End of file My_payment.php */
/* Location: ./system/application/libraries/My_payment.php */