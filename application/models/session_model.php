<?php
class Session_model extends CI_Model {
	private $table_name = "mq_session_record";
	private $max_online_num = 2;
	
	function __construct()
	{
		parent::__construct();
	}
	function get($record_id) {
		$this->db->where ( 'record_id', $record_id );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return FALSE;
		}
	}
	
	function get_online_num($user_id) {
		$sql = "select count(1) row_num from $this->table_name 
				 where status = 1 and user_id = $user_id";
		$query = $this->db->query($sql);
		if ($query->num_rows () == 1) {
			return $query->row ()->row_num;
		} else {
			return 0;
		}
	}
	
	function get_oldest_login($user_id, $session_id) {
		$sql = "select * from (select a.*, 1 q from $this->table_name a where status = 1 
				and user_id = $user_id and session_id = '$session_id'
				union all 
				select a.*, 2 q from $this->table_name a where status = 1 
				and user_id = $user_id) a order by q, login_time limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return 0;
		}
	}
	
	function delete_oldest_login($user_id, $session_id) {
		$row = $this->get_oldest_login ( $user_id, $session_id);
		if ($row) {
			return $this->clear_to_offline ( $row->record_id );
		}
		return FALSE;
	}
	
	function clear_to_offline($record_id) {
		$data['status'] = 0;
		$this->db->where('record_id', $record_id);
		$this->db->update($this->table_name, $data);
		return $this->db->affected_rows ();
	}
	
	function insert($user_id, $session_id, $login_ip){
		if ($this->get_online_num ( $user_id ) >= $this->max_online_num) {
			$this->delete_oldest_login ( $user_id, $session_id );
		}
		
		$now = date ( 'Y-m-d H:i:s' );
		
		$data ['user_id'] = $user_id;
		$data ['session_id'] = $session_id;
		$data ['login_ip'] = $login_ip;
		$data ['login_time'] = $now;
		$data ['status'] = 1;
		
		$this->db->insert ( $this->table_name, $data );
		return $this->db->affected_rows () > 0 ? "OK" : '保存失败';
	}
	
	function delete($record_id) {
		$this->db->where ( 'record_id', $record_id );
		$query = $this->db->delete ( $this->table_name );
		if($this->db->affected_rows () > 0){
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
	function valid_login($user_id, $session_id, $login_ip) {
		$sql = "select count(1) row_num from $this->table_name where status = 1
			and user_id = $user_id and session_id = '$session_id' and login_ip = '$login_ip'";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			return $query->row ()->row_num;
		} else {
			return 0;
		}
	}
	
	function delete_login($user_id, $session_id, $login_ip) {
		$this->db->delete ( $this->table_name, array (
				'status' => 1,
				'user_id' => $user_id,
				'session_id' => $session_id,
				'login_ip' => $login_ip 
		) );
		
		if ($this->db->affected_rows() > 0) {
			return 'OK';
		} else {
			return false;
		}
	}
	
}
