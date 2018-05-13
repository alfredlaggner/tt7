<?php

class Relay_response extends Common_Auth_Controller
{
	function index()
	{
//	echo "I am in";	
		// Flag if this is an ARB transaction. Set to false by default.
		$redirect_url = site_url() . "tt/class_detail/9"; // Where the user will end up.
		$arb = false;
		$valid = false;
		$hash_value = ''; // This needs to be configured in the Merchant Interface

		// Store the posted values in an associative array
		$fields = array();

		foreach ($_POST as $name => $value) {
			// Create our associative array
			$fields[$name] = $value;

			// If we see a special field flag this as an ARB transaction
//		if ($name == 'x_subscription_id')
//			{
//			$arb = true;
//			}
//		}

			// Check Validation
			//$hash = md5($hash_value.$fields['x_trans_id'].$fields['x_amount']);
			//if($hash == $fields['x_MD5_Hash'])
			//{
			//$valid = true;
			//}

			// If it is an ARB transaction, do something with it
//		$arb = true;
//		if ($arb == true && $valid)
//		{
//			if($fields['x_response_code'] == 1)
//				{
//					echo "success";
//				
//				}
//				else
//				{
//					// Denied
//					echo "failure";
//				
//				}
//		}
		}
		print_r($fields);
		die();
		$this->session->set_userdata($fields);
		if ($fields['x_response_code'] == 1)
			$redirect_url = site_url() . "tt/cc_success"; // Where the user will end up.
		else
			$redirect_url = site_url() . "tt/classes"; // Where the user will end up.

		echo $this->getRelayResponseSnippet($redirect_url);

	}

	function getRelayResponseSnippet($redirect_url)
	{
		return "<html><head><script language=\"javascript\">
                <!--
                window.location=\"{$redirect_url}\";
                //-->
                </script>
                </head><body><noscript><meta http-equiv=\"refresh\" content=\"1;url={$redirect_url}\"></noscript></body></html>";
	}

}