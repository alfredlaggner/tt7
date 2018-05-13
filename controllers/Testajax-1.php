<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Site Controller Class
 *
 * @package    Default
 * @author    Josh Tomaino
 */
class Testajax extends CI_Controller
{
	/**
	 *  Array containing all the error messages generated by the controller
	 *
	 * @var    array
	 *
	 * @access private
	 */
	var $error;

	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access    public
	 */
	public function __construct()
	{
		log_message('info', 'Initialized Site controller');

		parent::__construct();

		// load ajax first
		$this->ajax();
	}

	function ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php

		$this->xajax->configure("requestURI", base_url() . 'index.php/testajax-1/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . '/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('test_function', &$this, 'test_function'));

		$this->xajax->processRequest();
	}


	function test_function($number)
	{
		$objResponse = new xajaxResponse();
		$objResponse->Assign("SomeElementId", "innerHTML", "Xajax is working. Lets add: " . ($number + 3));
		return $objResponse;
	}

	function index()
	{
		$template['xajax_js'] = $this->xajax->printJavascript();

		$template['content'] = '<div id="SomeElementId"></div><input type="button" value="test" onclick="xajax_test_function(2);">';

		$this->load->view('template/index', $template);

	}


}

?>