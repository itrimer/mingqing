<?php
class Handle_record_model extends CI_Model {
	private $table_name = "mq_handle_record";
	private $view_name = "v_handle_record";

	function __construct()
	{
		parent::__construct();
	}
	function get($record_id) {
		$this->db->where ( 'record_id', $record_id );
		$query = $this->db->get ( $this->view_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	
	function gets_by_task($task_id) {
		$this->db->where ( 'task_id', $task_id );
		$this->db->order_by('operation_time', 'asc');
		$query = $this->db->get ( $this->view_name );
		return $query->result_array ();
	}
	function insert_record($task_id, $operation_name, $operation_remark, $record_user_id, $receive_user_id) {
		$now = date ( 'Y-m-d H:i:s' );
		
		$data ['task_id'] = $task_id;
		$data ['record_user_id'] = $record_user_id;
		$data ['receive_user_id'] = $receive_user_id;
		$data ['operation_name'] = $operation_name;
		$data ['operation_remark'] = $operation_remark;
		$data ['operation_time'] = $now;
		$this->db->insert ( $this->table_name, $data );
		
		if ($this->db->affected_rows () == 1) {
			return 'OK';
		} else {
			return '操作失败';
		}
	}
}
