<?php
class Operation_record_model extends CI_Model {
	private $table_name = "mq_operation_record";
	private $record_id = "";
	private $related_id;
	private $related_type;
	private $user_id;//登录用户名
	private $operation_name;//操作名称
	private $operation_date;
	private $description;
	
	function __construct()
	{
		parent::__construct();
	}
	function insert($user_id, $related_type, $related_id, $operation_name, 
			$operation_date, $description = null) {
		$data['user_id'] = $user_id;
		$data['related_id'] = $related_id;
		$data['related_type'] = $related_type;
		$data['operation_name'] = $operation_name;
		$data['operation_date'] = $operation_date;
		$data['description'] = $description;
	
		$this->db->insert($this->table_name, $data);
		return $this->db->affected_rows();//返回一行数
	}
}
