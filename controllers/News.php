<?

//class news extends CI_Controller 
class News extends Common_Auth_Controller
{

	function index()
	{
		$data = array();
		$this->load->model('news_model');
		if ($query = $this->news_model->get_records()) {
			$data['title'] = 'News Management';
			$data['title_action'] = 'newss Overview';
			$data['title_action'] = 'newss Overview';
			$data['top_note'] = 'Design and manage newss.';
			$data['bottom_note'] = 'Set up your newss';
			$data['breadcrumb'] = '';
			$data['records'] = $query;
			$this->load->view('news/news_over_view', $data);
		} else {
			$this->news_create();
		}
	}

	function news_view($news_id)
	{
		$data['title'] = 'news Management';
		$data['title_action'] = 'Edit: ';
		$data['breadcrumb'] = '';
		$data['divisions'] = $this->division_model->get_records();
		$data['news_groups'] = $this->news_group_model->get_records();
		$data['records'] = $this->news_model->get_record($news_id);
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Set up your newss';
		$this->load->view('news/news_view', $data);
	}

	function news_create()
	{
		$data['title'] = 'New news';
		$data['title_action'] = 'Create news';
		$data['news_groups'] = $this->news_group_model->get_records();
		$data['divisions'] = $this->division_model->get_records();
		$data['regions'] = $this->region_model->get_records();
		$data['accounts'] = $this->account_model->get_records();
		$data['bottom_note'] = 'Insert new news';
		$this->load->view('news/news_create_view', $data);
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
			'news_group_id' => $this->input->post('news_group_id'),
			'division_id' => $this->input->post('division_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'equipment_id' => $this->input->post('equipment_id'),
		);
		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('create') == "Create") {
			$this->news_model->add_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function update($news_id = 0)
	{

		$data = array(
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'order' => $this->input->post('order'),
			'description_long' => $this->input->post('description_long'),
			'description_short' => $this->input->post('description_short'),
			'description_detailled' => $this->input->post('description_detailled'),
			'slogan' => $this->input->post('slogan'),
			'news_group_id' => $this->input->post('news_group_id'),
			'division_id' => $this->input->post('division_id'),
			'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
			'is_active' => isset($_POST['is_active']) ? 1 : 0,
			'account_id' => $this->input->post('account_id'),
			'equipment_id' => $this->input->post('equipment_id'),
		);

		if ($this->input->post('cancel') == "Cancel") {
			$this->index();
		} elseif ($this->input->post('update') == "Update") {
			$this->news_model->update_record($data);
			$this->news_view($news_id);
		} elseif ($this->input->post('return') == "Save & Return") {
			$this->news_model->update_record($data);
			$this->index();
		} else {
			$this->index();
		};
	}

	function delete()
	{
		$this->news_model->delete_record();
		$this->index();
	}

	//assign regions
	function assign_regions($news_id)
	{
		$data['title'] = 'news Management';
		$data['title_action'] = 'Assign Regions';
		$data['breadcrumb'] = '';
		$data['records'] = $this->news_model->get_record($news_id);
		$data['news_id'] = $news_id;
		$data['region_names'] = $this->region_model->get_region_name($news_id);
		$data['news_region'] = $this->news_model->get_news_to_region_records($news_id);
		$data['regions'] = $this->region_model->get_records();
		$data['region_count'] = $this->region_model->count_all();
		$this->load->view('news/news_to_region', $data);
	}

	function add_region_to_news($news_id, $region_count)
	{
		if ($this->input->post('assign_region') == "Assign Regions") {
			$this->news_to_region_model->delete_news_records($news_id);
			$this->news_to_region_model->add_record($news_id, $region_count);
			$this->assign_regions($news_id);
		} elseif ($this->input->post('return') == "Assign & Return") {
			$this->news_to_region_model->delete_news_records($news_id);
			$this->news_to_region_model->add_record($news_id, $region_count);
			$is_calendar = ($this->session->userdata('from_calendar') or $this->input->post('from_calendar'));
			$this->index($news_id);
		} elseif ($this->input->post('cancel') == "Cancel") {
			$this->index($news_id);
		} else {
			$this->index($news_id);
		}
	}

}
