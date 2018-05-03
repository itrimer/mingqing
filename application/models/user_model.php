<?php
class User_model extends CI_Model {
	private $table_name = "mq_user";
	private $user_id = "";
	private $username;
	private $password;
	private $rule;
	private $ruledetail;
	private $expire;
	private $last_login;

	private $login_salt = 'u_s';//密码加盐
	
	function __construct()
	{
		parent::__construct();
	}

	function check_login($username, $password) {
		$CI =& get_instance();
		
		$query = $this->db->where ( 'user_name', $username )
			->limit ( 1 )->get ( 'mq_user' );
	
		if ($query->num_rows > 0) {
			$row = $query->row_array();
			
			if($row['password'] == md5($this->login_salt . $password)) {
				if($row['status'] != 10) {
					return '该员工被锁定，不能登录';
				}
				
				$data = array('last_login' => date('Y-m-d H:i:s'), 
						'login_ip' => $this->session->userdata('ip_address'));
				$where = array('user_id' => $row['user_id']);
				$this->db->update($this->table_name, $data, $where);

				$session_id = $this->session->userdata('session_id');

				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('full_name', $row['full_name']);
				$this->session->set_userdata('user_id', $row['user_id']);
				$this->session->set_userdata('village_id', $row['village_id']);
				$this->session->set_userdata('login_sess_id', $session_id);
				$this->session->set_userdata('super_admin', $row['super_admin']);
				
				$CI->load->model('operation_record_model');
				
				$CI->operation_record_model->insert ($row ['user_id'], $this->table_name, 
						$row ['user_id'], '登录', $data ['last_login'], $data ['login_ip']);

				$ip_address = $this->session->userdata('ip_address');
				$CI->load->model('session_model');
				$CI->session_model->insert ($row ['user_id'], $session_id, $ip_address);
				
				return 'true';
			} else {
				return '用户名或密码错误.';
			}
		} else {
			return '用户名或密码错误';
		}
	}
	
	function edit(){
		$CI =& get_instance();
		$act = $this->input->post("act");
		$CI->load->model('operation_record_model');
		$now = date('Y-m-d H:i:s');
		
		$data['full_name'] = $this->input->post('full_name');
		$data['department_id'] = $this->input->post('department_id');
		$data['role_id'] = $this->input->post('role_id');
		$data['home_phone'] = $this->input->post('home_phone');
		$data['work_phone'] = $this->input->post('work_phone');
		$data['mobile'] = $this->input->post('mobile');
		$data['village_id'] = $this->input->post('village_id');
		
		if(!$data['full_name']){
			return '未输入用户姓名';
		}
		if(!$data['role_id']){
			return '用户：' . $data['full_name'] . '未分配角色';
		}
		
		if($data['role_id'] == 3 && !$data['village_id']){
			return '用户：' . $data['full_name'] . '未选择村庄';
		}
		if($data['role_id'] == 2 && !$data['department_id']){
			return '用户：' . $data['full_name'] . '未选择部门';
		}
				
		if('insert' == $act){
			$data['user_name'] = $this->input->post('user_name');
			if(!$data['user_name']) {
				return '用户：' . $data['user_name'] . '已经存在';
			}
			if($this->get_by_username($data['user_name']) !== false) {
				return '用户：' . $data['user_name'] . '已经存在';
			}
			
			$data['password'] = md5($this->login_salt . $this->input->post('password'));
			$data['create_date'] = $now;
			$data['status'] = 10;

			$this->db->insert($this->table_name, $data);
			if($this->db->affected_rows() > 0){
				$CI->operation_record_model->insert ($this->session->userdata('user_id'), $this->table_name, 
					$this->db->insert_id(), '新增员工信息', $now, $data['user_name']);
				return 'OK';
			} else {
				return '保存失败';
			}
		} else {
			$this->db->where('user_id', $this->input->post('user_id'));
			$this->db->update($this->table_name, $data);
			
			if($this->db->affected_rows() > 0){
				$CI->operation_record_model->insert ($this->session->userdata('user_id'), $this->table_name, 
					$this->input->post('user_id'), '修改员工信息', $now, $data['full_name']);
				return 'OK';
			} else {
				return '保存失败';
			}
		}
	}
	
	function get($user_id) {
		$this->db->where ( 'user_id', $user_id );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	
	function get_by_username($user_name) {
		$this->db->where ( 'user_name', $user_name );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function lock_user($user_id, $status){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$now = date('Y-m-d H:i:s');
		
		$row = $this->get($user_id);
		if(!$row) {
			return "该用户不存在或被删除！";
		}
		
		if($row['status'] == $status) {
			if($status == 10){
				return "该用户已经是生效状态，不需要解锁！";
			} else {
				return "该用户已经是锁定状态，不需要锁定！";
			}
		}
	
		$data['status'] = $status;
		$this->db->where('user_id', $user_id);
		$this->db->update($this->table_name, $data);
		$CI->operation_record_model->insert ($this->session->userdata('user_id'),
				$this->table_name, $user_id, '5' == $status?"锁定员工":'解锁员工', $now, $status);
	
		return $this->db->affected_rows() > 0 ? "OK" : "操作失败";//返回一行数
	}
	
	function do_reset_password(){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		
		if($this->input->post('password') != $this->input->post('re_password')){
			return "确认密码与密码不一致";
		}

		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		$data['password'] = $this->input->post('password');
		$data['password'] = md5($this->login_salt . $data['password']);
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update($this->table_name, $data);
		$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
				$this->input->post('user_id'), '重置密码', $now);
		
		return $this->db->affected_rows() > 0 ? "OK" : "保存失败";//返回一行数
	}
	
	function gets($data = array()) {
		if ($data)
			$this->db->where ( $data );
		$query = $this->db->get ( $this->table_name );
		return $query->result_array ();
	}
	
	function delete($user, $login_user_id) {
		$this->db->where ( 'user_id', $user['user_id'] );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$user['user_id'], '删除账号', $now, $user['user_name']);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
}
