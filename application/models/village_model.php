<?php
class Village_model extends CI_Model {
	private $table_name = "mq_village";
	private $village_id = "";
	private $village_name;
	private $address;

	function __construct()
	{
		parent::__construct();
	}
	function get($village_id) {
		$this->db->where ( 'village_id', $village_id );
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
	
	function village_map($where = array()) {
		$map = array();
		$villages = $this->get_all($where);
		foreach ($villages as $key => $row){
			$map[$row['village_id']] = $row['village_name'];
		}
		return $map;
	}
	
	
	function edit(){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$act = $this->input->post("act");
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		$data['village_name'] = $this->input->post('village_name');
		$data['address'] = $this->input->post('address');
	
		if('insert' == $act){
			$this->db->insert($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->db->insert_id(), '新增村庄', $now, $data['village_name']);
		} else {
			$this->db->where('village_id', $this->input->post('village_id'));
			$this->db->update($this->table_name, $data);
			$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->input->post('village_id'), '修改村庄', $now, $data['village_name']);
		}
		return $this->db->affected_rows()>0?"OK":'保存失败';//返回一行数
	}
	
	function delete($village_id) {
		$CI =& get_instance();
	
		$related_total_query = $this->db->query("SELECT COUNT(*) as row_num FROM `mq_villager` where village_id=$village_id");
		$related_total_row = $related_total_query->row();
		if($related_total_row->row_num > 0) {
			return "村庄内有村民， 不能删除";
		}
	
		$row = $this->get ( $village_id );
		if(!$row) {
			return '该村庄不存在或被删除';
		}
		$this->db->where ( 'village_id', $village_id );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$login_user_id = $this->session->userdata('user_id');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$village_id, '删除村庄', $now, $row->village_name);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
	function set_popedom($popedom_id, $village_ids){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		$data['popedom_id'] = '';
		$this->db->where('popedom_id', $popedom_id);
		$this->db->update($this->table_name, $data);
		
		$data['popedom_id'] = $popedom_id;
		$this->db->where_in('village_id', $village_ids);
		$this->db->update($this->table_name, $data);
		
		return $this->db->affected_rows();//返回一行数
	}
	
	
}
