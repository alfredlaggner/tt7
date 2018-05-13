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

	public function index()
	{
		$this->main();
	}

	// ------------------------------------------------------------------------

	/////////////////////////////////////////////////////////////////////////////

	function ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php

		$this->xajax->configure("requestURI", base_url() . 'index.php/testajax/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . '/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('say_hello', $this, 'say_hello'));

		$this->xajax->processRequest();
	}

	function say_hello()
	{

		$objResponse = new xajaxResponse();

		$objResponse->Assign("ajax_div", "innerHTML", "Just saying hello from XAJAX.");

		return $objResponse;
	}


}

?>