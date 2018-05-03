<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'department';
	}

	public function index()
	{
		$init_param = array();
		if ($this->need_check_department()) {
			$init_param ['department_id'] = $this->login_department_id;
		}
		$data = parent::init_search($this->page_type, 'mq_department', array (
				'department_name' => array('compare_type'=>'like')
			),  array ('page_url'=>'/admin/department/index?',
					'order_by' => array(
					'1' => "department_name",
					'2' => "department_id",
					'default'=>'department_name')
			), $init_param);
		
		$this->load->view('admin/department/department_manager.php', $data);
	}
	
	public function edit($id)
	{
		$this->load->model('department_model');
		$row = $this->department_model->get($id);
		if (!$row) {
			echo parent::write_json('数据不存在或被删除');
			return;
		}
	
		$data['act'] = 'update';
		$data['page_title'] = '编辑部门';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/department/department_edit.php', $data, true);
		
		echo $buffer;
	}
	public function add()
	{
		$data['page_title'] = '新增部门';
		$data['act'] = 'insert';
		$data['row'] = $this->get_post_data();
		$buffer = $this->load->view('admin/department/department_edit.php', $data, true);
		
		echo $buffer;
	}
	
	public function save()
	{
		$this->load->model('department_model');
		$edit_back = $this->department_model->edit($this->get_post_data());
		
		echo parent::write_json($edit_back);
	}
	
	private function get_post_data(){
		$data['department_id'] = $this->input->post('department_id');
		$data['department_name'] = $this->input->post('department_name');
		$data['desc'] = $this->input->post('desc');
		return $data;
	}
	
	public function delete($id)
	{
		$this->load->model('department_model');
		$edit_back = $this->department_model->delete($id);

		echo parent::write_json($edit_back);
// 		redirect ( base_url ( '/admin/department/' ) );
	}
	
}

/* End of file department.php */
/* Location: ./application/controllers/admin/department.php */