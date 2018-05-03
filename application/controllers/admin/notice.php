<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'notice';
	}

	public function index()
	{
		$init_param['department_id >'] = 0;
		if ($this->need_check_department()) {
			$init_param ['department_id'] = $this->login_department_id;
		}
		$data = parent::init_search($this->page_type, 'v_notice', array (
				'notice_title' => array('compare_type'=>'like'),
				'department_id' => array('compare_type'=>'equal')
		),  array ('page_url'=>'/admin/notice/?',
				'order_by' => array(
					'1' => "create_date",
					'2' => "notice_id",
					'default'=>'create_date')
		), $init_param);
		
		$this->load->model('view_notice_model');
		foreach($data['query'] as $key => $row) {
			$read_count = $this->view_notice_model->get_count($this->login_user_id, $row['notice_id']);
			$data['query'][$key]['is_read'] = $read_count> 0 ? '1' : '0';
		}

		$data['dep_map'] = $this->get_auth_departments(true);
		
		$this->load->helper('html');
		$this->load->view('admin/notice/notice_manager.php', $data);
	}
	
	/**
	 * 系统通知
	 */
	public function system_notice()
	{
		$data = parent::init_search('system_notice', 'v_notice', array (
				'notice_title' => array('compare_type'=>'like')
		),  array ('page_url'=>'/admin/notice/system_notice?',
				'order_by' => array(
						'1' => "create_date",
						'2' => "notice_id",
						'default'=>'create_date')
		), array('department_id' => 0));
		
		$this->load->model('view_notice_model');
		foreach($data['query'] as $key => $row) {
			$read_count = $this->view_notice_model->get_count($this->login_user_id, $row['notice_id']);
			$data ['query'] [$key] ['is_read'] = $read_count > 0 ? '1' : '0';
		}
		
		$this->load->helper('html');
		$this->load->view('admin/notice/sys_notice_manager.php', $data);
	}
	
	public function edit($id)
	{
		$this->load->model('notice_model');
		$row = $this->notice_model->get($id);
		if (!$row) {
			redirect ( base_url ( '/admin/notice/' ) );
			return;
		}
				
		$data['departments'] = $this->get_auth_departments();
		
		$data['act'] = 'update';
		$data['page_title'] = '编辑通知';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/notice/notice_edit.php', $data, true);
		
		echo $buffer;
	}
	public function add()
	{
		$data['departments'] = $this->get_auth_departments();
		
		$data['page_title'] = '新增通知';
		$data['act'] = 'insert';
		$data['row'] = $this->get_post_data();
		$buffer = $this->load->view('admin/notice/notice_edit.php', $data, true);
		
		echo $buffer;
	}
	
	public function save()
	{
		$this->load->model('notice_model');
		$edit_back = $this->notice_model->edit($this->get_post_data());

		echo parent::write_json($edit_back);
	}
	
	private function get_post_data(){
		$data['notice_id'] = $this->input->post('notice_id');
		$data['notice_title'] = $this->input->post('notice_title');
		$data['content'] = $this->input->post('content');
		$data['department_id'] = $this->input->post('department_id');
		return $data;
	}
	
	public function view($id)
	{
		$this->load->model('notice_model');
		$row = $this->notice_model->get($id);
		if (!$row) {
			redirect ( base_url ( '/admin/notice/' ) );
			return;
		}
	
		$this->load->model('view_notice_model');
		$this->view_notice_model->view($row['create_user_id'], $row['notice_id']);
		
		$data['page_title'] = '查看';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/notice/notice_view.php', $data, true);
		
		echo $buffer;
	}
	
	public function delete($id)
	{
		$this->load->model('notice_model');
		$edit_back = $this->notice_model->delete($id);
		
		echo parent::write_json($edit_back);
	}
	
	public function sys_delete($id)
	{
		$this->load->model('notice_model');
		$edit_back = $this->notice_model->delete($id);
	
		echo parent::write_json($edit_back);
	}
	
	public function sys_edit($id)
	{
		$this->load->model('notice_model');
		$row = $this->notice_model->get($id);
		if (!$row) {
			echo parent::write_json('该数据不存在或被删除!');
			return;
		}
	
		$data['act'] = 'update';
		$data['page_title'] = '编辑系统通知';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/notice/sys_notice_edit.php', $data, true);
	
		echo $buffer;
	}
	public function sys_add()
	{
		$data['page_title'] = '新增系统通知';
		$data['act'] = 'insert';
		$data['row'] = $this->get_post_data();
		$buffer = $this->load->view('admin/notice/sys_notice_edit.php', $data, true);
	
		echo $buffer;
	}
	
	public function sys_save()
	{
		$this->load->model('notice_model');
		$edit_back = $this->notice_model->edit($this->get_post_data());
	
		echo parent::write_json($edit_back);
	}
	
}

/* End of file notice.php */
/* Location: ./application/controllers/admin/notice.php */