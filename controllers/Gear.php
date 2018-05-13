<?

//class gear extends CI_Controller 
class Gear extends Common_Auth_Controller
{

	function index()
	{
		$data = array();
		$this->load->model('gear_model');
		if ($query = $this->gear_model->get_records()) {
			$data['title'] = 'Gear Management';
			$data['title_action'] = 'Gears Overview';
			$data['title_action'] = 'Gears Overview';
			$data['top_note'] = 'Design and manage Gears.';
			$data['bottom_note'] = 'Set up your Gears';
			$data['breadcrumb'] = '';
			$data['records'] = $query;
			$this->load->view('gear/gear_over_view', $data);
		} else {
			$this->gear_create();
		}
	}

	function gear_view($gear_id)
	{
		$data['title'] = 'Gear Management';
		$data['title_action'] = 'Edit: ';
		$data['breadcrumb'] = '';
		$data['divisions'] = $this->division_model->get_records();
		$data['gear_groups'] = $this->gear_group_model->get_records();
		$data['records'] = $this->gear_model->get_record($gear_id);
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Set up your Gears';
		$this->load->view('gear/gear_view', $data);
	}

	function gear_create()
	{
		$data['title'] = 'New Gear';
		$data['title_action'] = 'Create Gear';
		$data['gear_groups'] = $this->gear_group_model->get_records();
		$data['divisions'] = $this->division_model->get_records();
		$data['regions'] = $this->region_model->get_records();
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Insert new gear';
		$this->load->view('gear/gear_create_view', $data);
	}

	function create()
	{
		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'description_detailled' => $this->input->post('description_detailled'),
			'slogan' => $this->input->post('slogan'),
			'gear_group_id' => $this->input->post('gear_group_id'),
			'division_id' => $this->input->post('division_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'equipment_id' => $this->input->post('equipment_id'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('create') == "Create") {
			$this->gear_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function update($gear_id = 0)
	{

		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'description_detailled' => $this->input->post('description_detailled'),
			'slogan' => $this->input->post('slogan'),
			'gear_group_id' => $this->input->post('gear_group_id'),
			'division_id' => $this->input->post('division_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'equipment_id' => $this->input->post('equipment_id'),
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->gear_model->update_record($data);
			$this->gear_view($gear_id);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->gear_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function delete()
	{
		$this->gear_model->delete_record();
		$this->index();
	}

	//assign regions
	function assign_regions($gear_id)
	{
		$data['title'] = 'Gear Management';
		$data['title_action'] = 'Assign Regions';
		$data['breadcrumb'] = '';
		$data['records'] = $this->gear_model->get_record($gear_id);
		$data['gear_id'] = $gear_id;
		$data['region_names'] = $this->region_model->get_region_name($gear_id);
		$data['gear_region'] = $this->gear_model->get_gear_to_region_records($gear_id);
		$data['regions'] = $this->region_model->get_records();
		$data['region_count'] = $this->region_model->count_all();
		$this->load->view('gear/gear_to_region', $data);
	}

	function add_region_to_gear($gear_id, $region_count)
	{
		if ($this->input->post('assign_region') == "Assign Regions") {
			$this->gear_to_region_model->delete_gear_records($gear_id);
			$this->gear_to_region_model->add_record($gear_id, $region_count);
			$this->assign_regions($gear_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->gear_to_region_model->delete_gear_records($gear_id);
			$this->gear_to_region_model->add_record($gear_id, $region_count);
			$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
			$this->index($gear_id);
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($gear_id);
		} else {
			$this->index($gear_id);
		}
	}

}
