<?php
class View_notice_model extends CI_Model {
	private $table_name = "mq_view_notice";
	private $id = "";

	function __construct()
	{
		parent::__construct();
	}
	function get($id) {
		$this->db->where ( 'id', $id );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function get_count($user_id, $notice_id) {
		$data['user_id'] = $user_id;
		$data['notice_id'] = $notice_id;
		$this->db->where($data);
		$item_total = $this->db->count_all_results($this->table_name);
		return $item_total;
	}
	
	function view($user_id, $notice_id){
		$now = date('Y-m-d H:i:s');
		
		$data['user_id'] = $user_id;
		$data['notice_id'] = $notice_id;
		$data['read_time'] = $now;
		$this->db->insert($this->table_name, $data);
		return $this->db->affected_rows()>0?"OK":'保存失败';//返回一行数
	}
	
}
