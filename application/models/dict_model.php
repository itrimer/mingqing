<?php
class Dict_model extends CI_Model {
	private $table_name = "mq_dict";
	private $dict_type = "";
	private $dict_code;
	private $dict_value;
	private $remark;
	

	function __construct()
	{
		parent::__construct();
	}
	function get($dict_type, $dict_code) {
		$this->db->where ( array('dict_type'=>$dict_type, 'dict_code'=>$dict_code));
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return FALSE;
		}
	}
	function get_all($dict_type = '') {
		if($dict_type){
			$this->db->where ('dict_type', $dict_type);
		}
		$this->db->order_by("seq", "asc");
		$query = $this->db->get ( $this->table_name );
		return $query->result_array ();
	}
	
	function code_map($dict_type) {
		$arr = $this->get_all($dict_type);
		$map = array();
		foreach  ($arr as $row){
			$map[$row['dict_code']] = $row['dict_value'];
		}
		return $map;
	}
	function all_code_map() {
		$arr = $this->get_all();
		
		$map = array();
    	foreach  ($arr as $row){
	    	if(!isset($map[$row['dict_type']])){
	    		$map[$row['dict_type']] = array($row['dict_code'] => $row['dict_value']);
	    	} else {
    			$arr_in = $map[$row['dict_type']];
    			$arr_in[$row['dict_code']] = $row['dict_value'];
    			$map[$row['dict_type']] = $arr_in;
    		}
    	}
		return $map;
	}
	
	
}
