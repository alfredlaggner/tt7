<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Common_Auth_Controller
{

	public function index()
	{
		if (!$this->ion_auth->logged_in())
			redirect('auth', 'refresh');
		else
			redirect('dashboard', 'refresh');

	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */