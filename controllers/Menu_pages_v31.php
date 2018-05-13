<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_pages_v3 extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->_ajax();
		$this->header_data = '';
		$this->data['header'] = $this->load->view('tt_v3/blocks/header', $this->header_data, TRUE);
		$this->data['footer'] = $this->load->view('tt_v3/blocks/footer', $this->header_data, TRUE);
		//      $this->data['robots'] = 'noindex,nofollow';
		//     $this->data['css'] = $this->config->item('css');
	}

	function _ajax()
	{
		$this->load->library('xajax_core/xajax');    # libraries/xajax/Xajax.php
		$this->xajax->configure("requestURI", base_url() . 'index.php/tt_v3/');    # index.php/controller/
		$this->xajax->configure("javascript URI", base_url() . 'js_tt/');        # loc of xajax_js/

		$this->xajax->register(XAJAX_FUNCTION, array('form_contact', &$this, 'form_contact'));
		$this->xajax->register(XAJAX_FUNCTION, array('verify_promo_code', &$this, 'verify_promo_code'));
		$this->xajax->register(XAJAX_FUNCTION, array('getProducts', &$this, 'getProducts'));
		$this->xajax->processRequest();
	}

	function _head($title = "")
	{
		$data['title'] = $title;
		$this->load->view('tt_v3/blocks/head', $data);
	}

	function about_us()
	{

		$this->data['region_id'] = $this->session->userdata('region_id');
		$this->data['region'] = $this->tt_model->get_region_name($this->data['region_id']);
		$this->data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $this->data, true);
		$this->_head("About Us - Treks and Tracks");
		$this->load->view('tt_v3/pages/about_view', $this->data);

	}

	function whytt()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Why - Treks and Tracks");
		$this->load->view('tt_v3/pages/whytt_view', $data);

	}

	function guides()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['records'] = $this->employee_model->get_guides();


		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Guides - Treks and Tracks");
		$this->load->view('tt_v3/pages/guides_view', $data);

	}

	function environment()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Environment - Treks and Tracks");
		$this->load->view('tt_v3/pages/environment_view', $data);

	}

	function terms()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Terms - Treks and Tracks");
		$this->load->view('tt_v3/pages/terms_view', $data);

	}

	function testimonials()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Testimonials - Treks and Tracks");
		$this->load->view('tt_v3/pages/testimonials', $data);

	}

	function voucher()
	{
		$data['header'] = $this->load->view('tt_v3/blocks/header', $data, TRUE);
		$data['footer'] = $this->load->view('tt_v3/blocks/footer', $data, TRUE);
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($data['region_id']);
		$data['region_name'] = $this->load->view('tt_v3/blocks/top_bar', $data, true);
		$this->_head("Voucher - Treks and Tracks");
		$this->load->view('tt_v3/pages/voucher_view', $data);

	}


}


/* End of file tt.php */
/* Location: ./application/controllers/tt.php */