<?

//class Activity extends CI_Controller 
class Activity extends Common_Auth_Controller
{

	function index()
	{
		$data = array();

		if ($query = $this->activity_model->get_records()) {
			$data['title'] = 'Activity Management';
			$data['title_action'] = 'Activities Overview';
			$data['title_action'] = 'Activities Overview';
			$data['top_note'] = 'Design and manage all classes and other activities.';
			$data['bottom_note'] = 'Set up your activities and manage event dates';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['records'] = $query;
			$this->load->view('activity/activity_over_view', $data);
		} else {
			$this->activity_create();
		}
	}

	function events($activity_id)
	{
		$data = array();

		{
			$data['title'] = 'Activity Management';
			$data['title_action'] = 'Schedule Activities';
			$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
			$data['regions'] = $this->region_model->get_records();
			$data['records'] = $this->activity_model->get_record($activity_id);
			$data['dates'] = $this->event_model->get_records($activity_id);

			$this->load->view('activity/events_view', $data);
		}
	}

	function activity_view($activity_id)
	{
		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Edit: ';
		$data['breadcrumb'] = '<a href="#" title="Home">Home</a> > <a href="#" title="Dashboard">Dashboard</a> >';
		$data['styles'] = $this->style_model->get_records();
		$data['physical_levels'] = $this->physical_level_model->get_records();
		$data['service_levels'] = $this->service_level_model->get_records();
		$data['inquiry_messages'] = $this->inquiry_message_model->get_records();
		$data['confirmation_messages'] = $this->confirmation_message_model->get_records();
		$data['booking_messages'] = $this->booking_message_model->get_records();
		$data['rate_plans'] = $this->rate_plan_model->get_records();
		$data['tax_plans'] = $this->tax_plan_model->get_records();
		$data['divisions'] = $this->division_model->get_records();
		$data['locations'] = $this->location_model->get_records();
		$data['regions'] = $this->region_model->get_records();
		$data['equipments'] = $this->equipment_model->get_records();
		$data['records'] = $this->activity_model->get_record($activity_id);
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Set up your activities';
		$this->load->view('activity/activity_view', $data);
	}

	function activity_create()
	{
		$data['title'] = 'New Activity';
		$data['title_action'] = 'Create Activity';
		$data['styles'] = $this->style_model->get_records();
		$data['physical_levels'] = $this->physical_level_model->get_records();
		$data['service_levels'] = $this->service_level_model->get_records();
		$data['inquiry_messages'] = $this->inquiry_message_model->get_records();
		$data['confirmation_messages'] = $this->confirmation_message_model->get_records();
		$data['booking_messages'] = $this->booking_message_model->get_records();
		$data['rate_plans'] = $this->rate_plan_model->get_records();
		$data['tax_plans'] = $this->tax_plan_model->get_records();
		$data['divisions'] = $this->division_model->get_records();
		$data['locations'] = $this->location_model->get_records();
		$data['regions'] = $this->region_model->get_records();
		$data['equipments'] = $this->equipment_model->get_records();
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Insert a new acitivty activities';
		$this->load->view('activity/activity_create_view', $data);
	}

	function create()
	{
		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'description_detailled' => $this->input->post('description_detailled'),
			'slogan' => $this->input->post('slogan'),
			'they_learn' => $this->input->post('they_learn'),
			'to_expect' => $this->input->post('to_expect'),
			'they_bring' => $this->input->post('they_bring'),
			'we_provide' => $this->input->post('we_provide'),
			'style_id' => $this->input->post('style_id'),
			'division_id' => $this->input->post('division_id'),
			'service_level_id' => $this->input->post('service_level_id'),
			'physical_level_id' => $this->input->post('physical_level_id'),
			'duration' => $this->input->post('duration'),
			'duration_text' => $this->input->post('duration_text'),
			'capacity_min' => $this->input->post('capacity_min'),
			'capacity_max' => $this->input->post('capacity_max'),
			'inquiry_message_id' => $this->input->post('inquiry_message_id'),
			'confirmation_message_id' => $this->input->post('confirmation_message_id'),
			'rate_plan_id' => $this->input->post('rate_plan_id'),
			'tax_plan_id' => $this->input->post('tax_plan_id'),
			'age_min' => $this->input->post('age_min'),
			'age_max' => $this->input->post('age_max'),
			'deposit_plan_individual_id' => $this->input->post('deposit_plan_individual_id'),
			'deposit_plan_group_id' => $this->input->post('deposit_plan_group_id'),
			'cancel_plan_individual_id' => $this->input->post('cancel_plan_individual_id'),
			'cancel_plan_group_id' => $this->input->post('cancel_plan_group_id'),
			'booking_message_id' => $this->input->post('booking_message_id'),
			'is_please_call' => isset($_POST['is_please_call']) ? 1 : 0,
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'is_questionaire' => isset($_POST['is_questionaire']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'wholesale_amount' => $this->input->post('wholesale_amount'),
			'wholesale_cut' => $this->input->post('wholesale_cut'),
			'wholesale_cut_type' => $this->input->post('wholesale_cut_type'),
			'equipment_id' => $this->input->post('equipment_id'),
			'region_id' => $this->input->post('region_id'),
			'order' => $this->input->post('order'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('create') == "Create") {
			$this->activity_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function update($activity_id = 0)
	{

		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'description_detailled' => $this->input->post('description_detailled'),
			'slogan' => $this->input->post('slogan'),
			'they_learn' => $this->input->post('they_learn'),
			'to_expect' => $this->input->post('to_expect'),
			'they_bring' => $this->input->post('they_bring'),
			'we_provide' => $this->input->post('we_provide'),
			'style_id' => $this->input->post('style_id'),
			'division_id' => $this->input->post('division_id'),
			'service_level_id' => $this->input->post('service_level_id'),
			'physical_level_id' => $this->input->post('physical_level_id'),
			'duration' => $this->input->post('duration'),
			'duration_text' => $this->input->post('duration_text'),
			'capacity_min' => $this->input->post('capacity_min'),
			'capacity_max' => $this->input->post('capacity_max'),
			'inquiry_message_id' => $this->input->post('inquiry_message_id'),
			'confirmation_message_id' => $this->input->post('confirmation_message_id'),
			'rate_plan_id' => $this->input->post('rate_plan_id'),
			'tax_plan_id' => $this->input->post('tax_plan_id'),
			'age_min' => $this->input->post('age_min'),
			'age_max' => $this->input->post('age_max'),
			'deposit_plan_individual_id' => $this->input->post('deposit_plan_individual_id'),
			'deposit_plan_group_id' => $this->input->post('deposit_plan_group_id'),
			'cancel_plan_individual_id' => $this->input->post('cancel_plan_individual_id'),
			'cancel_plan_group_id' => $this->input->post('cancel_plan_group_id'),
			'booking_message_id' => $this->input->post('booking_message_id'),
			'is_please_call' => isset($_POST['is_please_call']) ? 1 : 0,
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'is_questionaire' => isset($_POST['is_questionaire']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'wholesale_amount' => $this->input->post('wholesale_amount'),
			'wholesale_cut' => $this->input->post('wholesale_cut'),
			'wholesale_cut_type' => $this->input->post('wholesale_cut_type'),
			'equipment_id' => $this->input->post('equipment_id'),
			'region_id' => $this->input->post('region_id'),
			'order' => $this->input->post('order'),
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->activity_model->update_record($data);
			$this->activity_view($activity_id);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->activity_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function delete()
	{
		$this->activity_model->delete_record();
		$this->index();
	}

	function test_region()
	{
		$this->event_model->get_by_location_v2();
		die();
	}

	//assign regions
	function assign_regions($activity_id)
	{
		$data['title'] = 'Activity Management';
		$data['title_action'] = 'Assign Regions';
		$data['breadcrumb'] = '';
		$data['records'] = $this->activity_model->get_record($activity_id);
		$data['activity_id'] = $activity_id;
		$data['region_names'] = $this->region_model->get_region_name($activity_id);
		$data['activity_region'] = $this->activity_model->get_activity_to_region_records($activity_id);
		$data['regions'] = $this->region_model->get_records_not_all_records();
		$data['region_count'] = $this->region_model->count_all();
		$this->load->view('activity/activity_to_region', $data);
	}

	function add_region_to_activity($activity_id, $region_count)
	{
		if ($this->input->post('assign_region') == "Assign Regions") {
			$this->activity_to_region_model->delete_activity_records($activity_id);
			$this->activity_to_region_model->add_record($activity_id, $region_count);
			$this->assign_regions($activity_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->activity_to_region_model->delete_activity_records($activity_id);
			$this->activity_to_region_model->add_record($activity_id, $region_count);
			$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
			$this->index($activity_id);
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($activity_id);
		} else {
			$this->index($activity_id);
		}
	}

}
