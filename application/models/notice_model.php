<?php
class Notice_model extends CI_Model {
	private $table_name = "mq_notice";
	private $view_name = "v_notice";
	private $notice_id = "";

	function __construct()
	{
		parent::__construct();
	}
	function get($notice_id) {
		$this->db->where ( 'notice_id', $notice_id );
		$query = $this->db->get ( $this->view_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function get_all() {
		$query = $this->db->get ( $this->table_name );
		return $query->result_array();
	}
	
	function edit($data){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$act = $this->input->post("act");
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		$data['update_date'] = $now;
		
		if('insert' == $act){
			$data['create_user_id'] = $login_user_id;
			$data['create_date'] = $now;
			$this->db->insert($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->db->insert_id(), '新增通知', $now, $data['notice_title']);
		} else {
			$this->db->where('notice_id', $this->input->post('notice_id'));
			$this->db->update($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->input->post('notice_id'), '修改通知', $now, $data['notice_title']);
		}
		return $this->db->affected_rows()>0?"OK":'保存失败';//返回一行数
	}
	
	function delete($notice_id) {
		$CI =& get_instance();
	
		$row = $this->get ( $notice_id );
		if(!$row) {
			return '该通知不存在或被删除';
		}
		$this->db->where ( 'notice_id', $notice_id );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$login_user_id = $this->session->userdata('user_id');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$notice_id, '删除通知', $now, $row['notice_title']);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
}
