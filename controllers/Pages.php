<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->library('javascript');
		$this->cache_minutes = 0;
	}

	function _head($title = "")
	{
		$data['title'] = $title;
		$data['regions'] = $this->tt_model->get_Regions();
		$data['region_id'] = $this->session->userdata('region_id');
		$data['region'] = $this->tt_model->get_region_name($this->session->userdata('region_id'));
		$this->load->view('tt/head', $data);
	}

	// All Pages
	function guides()
	{
		$this->output->cache($this->cache_minutes);
		$data['title'] = "Our Guides -Trecks and Tracks";
		$this->_head("Our Giudes");
		$this->load->view('tt/guides', $data);
		$this->load->view('tt/footer');

	}

}


/* End of file project.php */
/* Location: ./application/controllers/welcome.php */