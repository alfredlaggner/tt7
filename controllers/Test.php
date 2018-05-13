<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_ajax();
	}

	private function _ajax()
	{
		$this->load->library('xajax/xajax');
		$this->xajax->configure("requestURI", base_url() . 'index.php/test/');
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');

		$this->xajax->register(XAJAX_FUNCTION, array('test_function', &$this, 'test_function'));
		$this->xajax->processRequest();
	}

	public function index()
	{
		$this->load->view('template/show_result');

	}

	public function test_function($number)
	{
		$data['result'] = "Xajax is working. Lets add: " . ($number + 3);
		$objResponse = new xajaxResponse();
		$objResponse->Assign('ajax_div', 'innerHTML', $data['result']);
		return $objResponse;
	}
}