<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'user';
	}

	public function index()
	{
		$init_param = array();
		if ($this->need_check_department()) {
			$init_param ['department_id'] = $this->login_department_id;
		}
		if ($this->need_check_village()) {
			$init_param ['village_id'] = $this->login_village_id;
		}
		
		$data = parent::init_search($this->page_type, 'v_user', array (
				'user_name' => array('compare_type'=>'like'),
				'full_name' => array('compare_type'=>'like'),
				'department_id' => array('compare_type'=>'equal'),
				'status' => array('compare_type'=>'equal')
		),  array ('page_url'=>'/admin/user/index?',
				'order_by' => array(
					'1' => "last_login",
					'2' => "status",
					'default'=>'last_login')
		), $init_param);
		
		$this->load->view('admin/user/user_manager.php', $data);
	}
	
	public function edit($id)
	{
		$query = $this->db->get_where('mq_user', array('user_id' => $id));
		if ($query->num_rows() == 0) {
			redirect ( base_url ( '/admin/user/' ) );
			return;
		}
		
		$data['departments'] = $this->get_auth_departments();
		$data['villages'] = $this->get_auth_villages();
		
		$this->load->model('dict_model');
		$data['user_type_map'] = $this->dict_model->code_map('user_type');

		$role_param = array();
		if($this->login_role_id != 1){
			$role_param['role_id !='] = 1;
		}
		$this->load->model('Menu_role_model');
		$data['roles'] = $this->Menu_role_model->get_roles($role_param);
				
		$data['act'] = 'update';
		$data['page_title'] = '编辑员工';
		$data['row'] =  $query->row_array();;
		$buffer = $this->load->view('admin/user/user_edit.php', $data, true);
		
		echo $buffer;
	}
	public function add()
	{
		$row = $this->get_post_data();
		
		$data['departments'] = $this->get_auth_departments();
		$data['villages'] = $this->get_auth_villages();
		
		
		$this->load->model('dict_model');
		$data['user_type_map'] = $this->dict_model->code_map('user_type');

		$role_param = array();
		if($this->login_role_id != 1){
			$role_param['role_id !='] = 1;
		}
		$this->load->model('Menu_role_model');
		$data['roles'] = $this->Menu_role_model->get_roles($role_param);
		
		$data['page_title'] = '新增用户';
		$data['act'] = 'insert';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/user/user_edit.php', $data, true);

		echo $buffer;
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('full_name','姓名','trim|required|max_length[20]');
		$this->form_validation->set_rules('mobile','手机号','trim|required');
		$this->form_validation->set_rules('department_id','部门','required');
		$this->form_validation->set_rules('role_id','角色','required');
		if("insert" == $this->input->post('act')){
			$this->form_validation->set_rules('user_name','用户名','trim|required|min_length[3]|max_length[20]');//username要4个到12个字符之间
			$this->form_validation->set_rules('password','密码','trim|required|min_length[5]|max_length[20]');//password要8个到12个字符之间
			$this->form_validation->set_rules('re_password','确认密码','required|matches[password]');//两次密码输入必需一致
		}
		if($this->form_validation->run() == false){
			$e = validation_errors();
			$e = "{\"code\": \"" . ("OK" == $e?"success":$e) . "\"}";
			$e = str_replace("\n", "", $e);
			echo $e;
			return;
		}
		
		$this->load->model('user_model');
		$edit_back = $this->user_model->edit();
		
		echo parent::write_json($edit_back);
	}
	
	public function lock($id)
	{
		$this->load->model('user_model');
		$edit_back = $this->user_model->lock_user($id, 5);
	
		echo parent::write_json($edit_back);
	}

	public function unlock($id)
	{
		$this->load->model('user_model');
		$edit_back = $this->user_model->lock_user($id, 10);
	
		echo parent::write_json($edit_back);
	}
	
	public function reset_password($id)
	{
		$this->load->model('user_model');
		$user = $this->user_model->get($id);
		
		$data['row'] = $user;
		$data['page_title'] = '重置密码';
		
		$buffer = $this->load->view('admin/user/reset_password.php', $data, true);
		echo $buffer;
	}
	public function do_reset_password()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('password','新密码','trim|required|min_length[5]|max_length[20]');//password要8个到12个字符之间
		$this->form_validation->set_rules('re_password','确认密码','required|matches[password]');//两次密码输入必需一致
		if($this->form_validation->run() == false){
			$e = validation_errors();
			$e = "{\"code\": \"" . ("OK" == $e?"success":$e) . "\"}";
			$e = str_replace("\n", "", $e);
			echo $e;
			return;
		}
	
		$this->load->model('user_model');
		$edit_back = $this->user_model->do_reset_password();
	
		echo parent::write_json($edit_back);
	}
	
	private function get_post_data(){
		$data['user_id'] = $this->input->post('user_id');
		$data['user_name'] = $this->input->post('user_name');
		$data['password'] = $this->input->post('password');
		$data['full_name'] = $this->input->post('full_name');
		$data['department_id'] = $this->input->post('department_id');
		$data['role_id'] = $this->input->post('role_id');
		$data['status'] = $this->input->post('status');
		$data['work_phone'] = $this->input->post('work_phone');
		$data['mobile'] = $this->input->post('mobile');
		$data['home_phone'] = $this->input->post('home_phone');
		$data['village_id'] = $this->input->post('village_id');
		return $data;
	}
	
	public function export() {
		$this->load->library('excel');
	
		$query = $this->db->get('mq_user');
	
		$this->excel->filename = 'abc123';
		$this->excel->make_from_db($query);
		
		$this->load->library('excel/reader');
	}
	
	public function import() {
		$this->load->library('excel/reader');
		$reader = new Reader(); // 实例化解析类Spreadsheet_Excel_Reader
		$reader->setOutputEncoding("utf-8");     // 设置编码方式
		$reader->read("{$_FILES['File1']['tmp_name']}");
		$ver_data = $reader->sheets[0]['cells'];
		var_dump($ver_data);
	}
	
	public function delete($id)
	{
		if($id == $this->login_user_id){
			echo parent::write_json('你不能删除自己的账号');
			return;
		}
		$this->load->model('user_model');
		$row = $this->user_model->get($id);
		if(!$row) {
			echo parent::write_json('该数据不存在或被删除');
			return;
		}
		
		if($row['role_id'] < $this->login_role_id){
			echo parent::write_json('你无权限删除'.$row['user_name'].'的账号');
			return;
		}
		
		if ($this->need_check_village()) {
			if($row['village_id'] && $row['village_id'] != $this->login_village_id){
				echo parent::write_json("你没有权限删除其他村庄用户！");
				return;
			}
		}
		if ($this->need_check_department()) {
			if($row['department_id'] && $row['department_id'] != $this->login_department_id){
				echo parent::write_json("你没权限删除其他部门文用户！");
				return;
			}
		}
		
		$edit_back = $this->user_model->delete($row, $this->login_user_id);
	
		echo parent::write_json($edit_back);
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */