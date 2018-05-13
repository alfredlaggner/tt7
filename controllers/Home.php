<?php

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('facebook');
	}


	function Home()
	{
		//	parent::Controller();
		$this->load->helper('facebook');
	}

	function index()
	{
		$this->load->view('example');
	}
//        function Facebooktest(){
//                parent::Controller();
//                $this->load->model('facebook_model');
//        }

//        function index(){
//                $this->load->model('facebook_model');
//                $this->load->view('facebooktest/index');
//        }
//
//        function test1(){
//                $this->load->model('facebook_model');
//                $data = array();
//                $data['user'] = $this->facebook_model->getUser();
//                $this->load->view('facebooktest/mystuff',$data);
//        }
//      function test2(){
//                $this->load->model('facebook_model');
//                $data = array();
//                $data['friends'] = $this->facebook_model->getFriends();
//                $this->load->view('facebooktest/test2',$data);
//       }
}