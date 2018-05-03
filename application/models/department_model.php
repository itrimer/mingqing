<?php
class Department_model extends CI_Model {
	private $table_name = "mq_department";
	private $department_id;
	private $department_name;
	private $parent_id;
	
	function __construct()
	{
		parent::__construct();
	}
	function get($department_id) {
		$this->db->where ( 'department_id', $department_id );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function get_all($params = array()) {
		if($params){
			$this->db->where($params);
		}
		$query = $this->db->get ( $this->table_name );
		return $query->result_array();
	}
	
	function dep_map($params = array()) {
		$map = array();
		$departments = $this->get_all($params);
		foreach ($departments as $key => $row){
			$map[$row['department_id']] = $row['department_name'];
		}
		return $map;
	}
	
	function edit($data){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$act = $this->input->post("act");
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		if(!$data['department_name']){
			return '部门名称不允许为空';
		}
	
		$data['desc'] = $this->input->post('desc');
		
		if('insert' == $act){
			$this->db->insert($this->table_name, $data);
			
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->db->insert_id(), '新增部门', $now, $data['department_name']);
		} else {
			$this->db->where('department_id', $this->input->post('department_id'));
			$this->db->update($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->input->post('department_id'),
					'编辑部门', $now, $data['department_name']);
		}
		return $this->db->affected_rows()>0?"OK":"发生异常";//返回一行数
	}
	
	function delete($department_id) {
		$CI =& get_instance();
		
		$user_total_query = $this->db->query("SELECT COUNT(*) as row_num FROM `mq_user` where department_id=$department_id");
		$user_total_row = $user_total_query->row();
		if($user_total_row->row_num > 0) {
			return "部门内有职工， 不能删除";
		}
		
		$row = $this->get ( $department_id );
		if(!$row) {
			return '该部门不存在或被删除';
		}
		$this->db->where ( 'department_id', $department_id );
		$query = $this->db->delete ( $this->table_name );
		if ($this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$login_user_id = $this->session->userdata('user_id');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$department_id, '删除部门', $now, $row['department_name']);

			return 'OK';
		} else {
			return FALSE;
		}
	}
	
}
