<?php

class Admin_Controller extends CI_Controller
{

	//Class-wide variable to store user object in.
	protected $the_user;

	public function __construct()
	{

		parent::__construct();
		//Check if user is in admin group
		if ($this->ion_auth->is_admin()) {
			//Put User in Class-wide variable
			$data->the_user = $this->ion_auth->get_user();

			//Store user in $data
			$data->the_user = $this->the_user;

			//Load $the_user in all views
			$this->load->vars($data);
		} else {
			redirect('auth/login'); //use redirects instead of loading views for compatibility with MY_Controller libraries
		}
	}
}

class User_Controller extends CI_Controller
{

	protected $the_user;

	public function __construct()
	{

		parent::__construct();

		if ($this->ion_auth->is_group('users')) {
			$data->the_user = $this->ion_auth->get_user();
			$this->the_user = $data->the_user;
			$this->load->vars($data);
		} else {
			redirect('/'); //use redirects instead of loading views for compatibility with MY_Controller libraries
		}
	}
}

class Common_Auth_Controller extends CI_Controller
{

	protected $the_user;

	public function __construct()
	{

		parent::__construct();

		if ($this->ion_auth->logged_in()) {
			//           $data->the_user = $this->ion_auth->get_user();
			//           $this->the_user = $data->the_user;
			//           $this->load->vars($data);
			// //error in localhost only - take off comments in production
		} else {
			redirect('auth/login'); //use redirects instead of loading views for compatibility with MY_Controller libraries
		}
	}

	// from discount.php
	function assign_activities($discount_id, $return_name = 'return', $cancel_name = 'cancel')
	{
		$data['title'] = 'Discount Management';
		$data['title_action'] = 'Assign Discount';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['discount_types'] = $this->discount_type_model->get_records();
		$data['records'] = $this->discount_model->get_record($discount_id);
		$data['return_name'] = $return_name;
		$data['cancel_name'] = $cancel_name;
		$data['activities'] = $this->activity_model->get_records();
		$data['discount_id'] = $discount_id;
		$data['discount_activities'] = $this->discount_to_activity_model->get_discount_to_activity_records($discount_id);
		$data['activity_count'] = $this->activity_model->count_all();
		$this->load->view('discount/discount_to_activities', $data);
	}


}