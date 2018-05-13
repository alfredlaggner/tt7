<?

class Discount extends Common_Auth_Controller
{

	function index($is_imported = 0)
	{
		$data = array();

		if ($query = $this->discount_model->get_records($is_imported)) {
			$data['title'] = 'Discount Management';
			$data['title_action'] = 'Discount Groups';
			$data['breadcrumb'] = '';
			$data['records'] = $query;
			$data['discount_types'] = $this->discount_type_model->get_records();
			$this->load->view('discount/discount_groups_view', $data);
		} else {
			$this->discount_create();
		}
	}

	function group_discount_show($is_imported = 0, $group_name = '')
	{
		$data = array();

		$data['title'] = 'Discount Management';
		$data['title_action'] = 'Discounts of ' . ltrim(str_replace("%20", " ", $group_name));
		$data['breadcrumb'] = '';
		$data['discount_count'] = $this->discount_model->get_group_count($is_imported, $group_name);
		$data['records'] = $this->discount_model->get_group_records($is_imported, $group_name);
		$data['discount_types'] = $this->discount_type_model->get_records();
		$this->load->view('discount/discount_over_view', $data);
	}

	function discount_used()
	{
		$this->discount_model->used_codes_count();
//		$this->discount_model->used_codes_count('SJ KIDSCAMP 2 USES GRPN MAY 2013');
//		$data['discount_types']=$this->discount_model->used_codes_count('voucher price for climbing');
//		$this->load->view('discount/discounts_used',$data);

		die();
	}

	function discount_view($discount_id)
	{
		$data['title'] = 'Discount Management';
		$data['title_action'] = 'Edit discount';
		$data['breadcrumb'] = '';
		$data['records'] = $this->discount_model->get_record($discount_id);
		$data['return_name'] = 'return';
		$data['cancel_name'] = 'cancel';
		$data['discount_plan_name'] = 'Discounts';
		$data['discount_types'] = $this->discount_type_model->get_records();
		$data['weekdays'] = $this->rate_price_model->weekend_days($this->discount_model->get_weekdays($discount_id));
		$this->load->view('discount/discount_view', $data);
	}

	function discount_create()
	{
		$data['title'] = 'New discount';
		$data['title_action'] = 'Create discount';
		$data['discount_plan_name'] = 'Discounts';
		$data['discount_types'] = $this->discount_type_model->get_records();
		$data['weekdays'] = $this->rate_price_model->weekend_days('1111111');
		$this->load->view('discount/discount_create_view', $data);
	}

	function create()
	{
		$weekday = '';
		for ($i = 1; $i <= 7; $i++) {
			$day = 'day' . $i;
			$weekday .= isset($_POST[$day]) ? '1' : '0';
		};

		$data = array(
			'promo_code' => strtoupper($this->input->post('promo_code')),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'amount' => $this->input->post('amount'),
			'amount_type' => $this->input->post('amount_type'),
			'type' => $this->input->post('type'),
			'weekdays' => $weekday,
			'res_party_size_from' => $this->input->post('res_party_size_from'),
			'res_party_size_to' => $this->input->post('res_party_size_to'),
			'exp_date' => $this->input->post('exp_date'),
			'departure_date_start' => $this->input->post('departure_date_start'),
			'departure_date_end' => $this->input->post('departure_date_end'),
			'auto_join_group' => $this->input->post('auto_join_group'),
			'is_rule_active' => isset($_POST['is_rule_active']) ? 1 : 0,
			'is_single_use' => isset($_POST['is_single_use']) ? 1 : 0,
			'is_global_discount' => isset($_POST['is_global_discount']) ? 1 : 0,
			'is_automatic_apply' => isset($_POST['is_automatic_apply']) ? 1 : 0,
			'is_imported' => isset($_POST['is_imported']) ? 1 : 0,
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->group_discount_show();
		} elseif ($this->input->post('create') == "Create") {
			$this->discount_model->add_record($data);
			$this->group_discount_show();
		} else {
			$this->group_discount_show();
		};
	}

	function update()
	{

		$weekday = '';
		for ($i = 1; $i <= 7; $i++) {
			$day = 'day' . $i;
			$weekday .= isset($_POST[$day]) ? '1' : '0';
		};

		$data = array(
			'promo_code' => strtoupper($this->input->post('promo_code')),
			'name' => $this->input->post('name'),
			'amount' => $this->input->post('amount'),
			'description' => $this->input->post('description'),
			'amount_type' => $this->input->post('amount_type'),
			'type' => $this->input->post('type'),
			'weekdays' => $weekday,
			'res_party_size_from' => $this->input->post('res_party_size_from'),
			'res_party_size_to' => $this->input->post('res_party_size_to'),
			'exp_date' => $this->input->post('exp_date'),
			'departure_date_start' => $this->input->post('departure_date_start'),
			'departure_date_end' => $this->input->post('departure_date_end'),
			'auto_join_group' => $this->input->post('auto_join_group'),
			'is_rule_active' => isset($_POST['is_rule_active']) ? 1 : 0,
			'is_single_use' => isset($_POST['is_single_use']) ? 1 : 0,
			'is_global_discount' => isset($_POST['is_global_discount']) ? 1 : 0,
			'is_automatic_apply' => isset($_POST['is_automatic_apply']) ? 1 : 0,
			'is_imported' => isset($_POST['is_imported']) ? 1 : 0,
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->group_discount_show();
		} elseif ($this->input->post('update') == "Update") {
			$this->discount_model->update_record($data);
			$this->discount_view($this->input->post('discount_id'));
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->discount_model->update_record($data);
			$this->group_discount_show();
		} elseif ($this->input->post('return_dash') == "Save & Return") {
			$this->discount_model->update_record($data);
			redirect('dashboard#discount');
		} elseif ($this->input->post('cancel_dash') == "Cancel") {
			redirect('dashboard#discount');
		} else {
			$this->group_discount_show();
		};
	}

	function discount_delete()
	{
		$this->discount_model->delete_record();
		$this->group_discount_show();
	}

	function group_discount_copy($discount_name)
	{
		$this->discount_model->group_copy($discount_name);
		$this->index(1);
	}

	function group_discount_delete($discount_name)
	{
		$this->discount_model->group_delete($discount_name);
		$this->index(1);
	}

	function xassign_activities($discount_id)
	{
		$data['title'] = 'Discount Management';
		$data['title_action'] = 'Assign Discount';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['discount_types'] = $this->discount_type_model->get_records();
		$data['records'] = $this->discount_model->get_record($discount_id);
		$data['return_name'] = 'return';
		$data['cancel_name'] = 'cancel';
		$data['activities'] = $this->activity_model->get_records();
		$data['discount_id'] = $discount_id;
		$data['discount_activities'] = $this->discount_to_activity_model->get_discount_to_activity_records($discount_id);
		$data['activity_count'] = $this->activity_model->count_all();
		$this->load->view('discount/discount_to_activities', $data);
	}

	function add_discount_to_activities($discount_id, $activity_count)
	{
		if ($this->input->post('assign') == "Assign") {
			$this->discount_to_activity_model->delete_discount_records($discount_id);
			$this->discount_to_activity_model->add_record($discount_id, $activity_count);
			$this->assign_activities($discount_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->discount_to_activity_model->delete_discount_records($discount_id);
			$this->discount_to_activity_model->add_record($discount_id, $activity_count);
			$this->group_discount_show();
		} elseif ($this->input->post('return_dash') == "Assign & Return") {
			$this->discount_to_activity_model->delete_discount_records($discount_id);
			$this->discount_to_activity_model->add_record($discount_id, $activity_count);
			redirect('dashboard#discount');
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->group_discount_show();
		} elseif ($this->input->post('cancel_dash') == "Cancel") {
			redirect('dashboard#discount');
		} else {
			$this->group_discount_show();
		}
	}


//single_use_change 12-14-2012

	function set_all_discounts_to_single_use()
	{
		if ($data = $this->discount_model->set_all_discounts_to_single_use())
			echo "All discounts set to single use";
		else
			echo "Something went wrong";
	}

	function upload()
	{
		$data['error'] = ' ';
		$this->load->view('discount/discount_upload_file', array('error' => ' '));
	}

	public function do_upload()
	{
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'csv|gif|jpg|png';
		$config['max_size'] = '15000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);


		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('discount/discount_upload_file', $error);
		} else {
			$data['activities'] = $this->activity_model->get_records();
			$this->load->view('discount/discount_upload', $data);

		}
	}

	function import_codes($activity = 0)
	{
		$activity = $this->input->post('activity');

		$data['success_message'] = $this->discount_model->import_groupon_discount($activity, count($activity));
		//die("<br>Upload finished");
		$this->load->view('discount/discount_upload_success', $data);

	}

	function delete_tax_plan_to_tax($discount_id, $activity_id)
	{
		$this->discount_to_activity_model->delete_record($discount_id, $activity_id);
		$this->assign_activities($discount_id);
	}


	function fix_null_date()
	{
		if ($this->discount_model->fix_null_date()) echo "fix sucessful"; else echo "fix failed";
		die();
	}

	function xupdate_all_records()
	{
		$data = array(
			'is_imported' => TRUE,
		);

		$this->discount_model->update_all_records($data);
		return TRUE;
	}
}
