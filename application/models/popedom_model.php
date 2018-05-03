<?php
class Popedom_model extends CI_Model {
	private $table_name = "mq_popedom";
	private $popedom_id = "";
	private $popedom_name;
	private $remark;

	function __construct()
	{
		parent::__construct();
	}
	function get($popedom_id) {
		$this->db->where ( 'popedom_id', $popedom_id );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function get_all($where = array()) {
		if($where)
			$this->db->where($where);
		$query = $this->db->get ( $this->table_name );
		return $query->result_array();
	}
	
	function popedom_map($where = array()) {
		$map = array();
		$popedoms = $this->get_all($where);
		foreach ($popedoms as $key => $row){
			$map[$row['popedom_id']] = $row['popedom_name'];
		}
		return $map;
	}
	
	
	function edit($data){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$act = $this->input->post("act");
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');

		if(!$data['popedom_name']){
			return "辖区不能为空";
		}
		
		if('insert' == $act){
			$data['village_num'] = 0;
			$this->db->insert($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->db->insert_id(), '新增辖区', $now, $data['popedom_name']);
		} else {
			$this->db->where('popedom_id', $data['popedom_id']);
			$this->db->update($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->input->post('popedom_id'), '修改辖区', $now, $data['popedom_name']);
		}
		return $this->db->affected_rows()>0?"OK":'保存失败';//返回一行数
	}
	
	function delete($popedom_id) {
		$CI =& get_instance();
	
		$related_total_query = $this->db->query("SELECT COUNT(*) as row_num FROM `mq_village` where popedom_id=$popedom_id");
		$related_total_row = $related_total_query->row();
		if($related_total_row->row_num > 0) {
			return "辖区内有村庄， 不能删除";
		}
	
		$row = $this->get ( $popedom_id );
		if(!$row) {
			return '该辖区不存在或被删除';
		}
		$this->db->where ( 'popedom_id', $popedom_id );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$login_user_id = $this->session->userdata('user_id');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$popedom_id, '删除辖区', $now, $row['popedom_name']);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
	function do_add_village($popedom_id, $village_ids){
		$CI =& get_instance();
		$login_user_id = $this->session->userdata('user_id');
		$now = date('Y-m-d H:i:s');
		
		$row = $this->get ( $popedom_id );
		if(!$row) {
			return '该辖区不存在或被删除';
		}
		if(count($village_ids)==0) {
			return '该辖区村庄不能为空';
		}
		
		$CI->load->model('village_model');
		$village_num = $CI->village_model->set_popedom($popedom_id, $village_ids);
		
		$data["village_num"] = count($village_ids);
		$this->db->where('popedom_id', $popedom_id);
		$this->db->update($this->table_name, $data);
		
		$CI->load->model('operation_record_model');
		$CI->operation_record_model->insert ($login_user_id, $this->table_name,
				$popedom_id, '添加村庄', $now, implode(',',$village_ids));
		
		return $this->db->affected_rows()>0?"OK":'保存失败';//返回一行数
		
	}
}
