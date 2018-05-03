<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Village extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'village';
	}

	public function index()
	{
		$init_param = array();
		if ($this->need_check_village()) {
			$init_param ['village_id'] = $this->login_village_id;
		}
		
		$data = parent::init_search($this->page_type, 'mq_village', array (
				'village_name' => array('compare_type'=>'like'),
				'popedom_id' => array('compare_type'=>'equal')
		),  array ('page_url'=>'/admin/village/?',
				'order_by' => array(
				'1' => "village_name",
				'2' => "village_id",
				'default'=>'village_name')
		), $init_param);

		$this->load->helper('url');
		$this->load->model('popedom_model');
		$data['popedom_map'] = $this->popedom_model->popedom_map();
		
		$this->load->view('admin/village/village_manager.php', $data);
	}
	
	public function edit($id)
	{
		$query = $this->db->get_where('mq_village', array('village_id' => $id));
		if ($query->num_rows() == 0) {
			redirect ( base_url ( '/admin/village/' ) );
			return;
		}
	
		$data['act'] = 'update';
		$data['page_title'] = '编辑村庄';
		$data['row'] = $query->row_array();
		$buffer = $this->load->view('admin/village/village_edit.php', $data, true);
		
		echo $buffer;
	}
	public function add()
	{
		$row = $this->get_post_data();
		$data['page_title'] = '新增村庄';
		$data['act'] = 'insert';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/village/village_edit.php', $data, true);
		
		echo $buffer;
	}
	
	public function save()
	{
		$this->load->model('village_model');
		$edit_back = $this->village_model->edit();

		echo parent::write_json($edit_back);
		
// 		redirect ( base_url ( '/admin/village/' ) );
	}
	
	private function get_post_data(){
		$data['village_id'] = $this->input->post('village_id');
		$data['village_name'] = $this->input->post('village_name');
		$data['address'] = $this->input->post('address');
		return $data;
	}
	
	public function delete($id)
	{
		$this->load->model('village_model');
		$edit_back = $this->village_model->delete($id);
		
		echo parent::write_json($edit_back);
		
// 		redirect ( base_url ( '/admin/village/' ) );
	}
	
}

/* End of file village.php */
/* Location: ./application/controllers/admin/village.php */