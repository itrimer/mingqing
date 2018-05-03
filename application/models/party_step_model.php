<?php
class Party_step_model extends CI_Model {
	private $table_name = "mq_party_step";
	private $step_id = "";
	

	function __construct()
	{
		parent::__construct();
	}
	function get($step_id) {
		$this->db->where ( array('step_id'=>$step_id));
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function gets_by_villager_id($villager_id) {
		$this->db->where ( array('villager_id'=>$villager_id));
		$this->db->order_by('step_index', 'asc');
		$query = $this->db->get ( $this->table_name );
		return $query->result_array ();
	}
	
	function villager_steps($villager_id) {
		$rows =  $this->gets_by_villager_id($villager_id);
		$row_map = array();
		foreach ($rows as $key => $row){
			$row_map[$row["step_index"]] = $row;
		}
		return $row_map;
	}
	
	
	function insert_or_update($villager_id, $step_index, $user_id) {
		$data['villager_id'] = $villager_id;
		$data['step_index'] = $step_index;
		$this->db->where($data);
		$this->db->update($this->table_name, $data);
		if ( $this->db->affected_rows () == 1) {
			return 'OK';
		} else {
			$now = date('Y-m-d H:i:s');
			$data['record_user_id'] = $user_id;
			$data['record_time'] = $now;
				
			$this->db->insert($this->table_name, $data);
			return 'OK';
		}
	}
}
