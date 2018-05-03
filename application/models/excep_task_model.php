<?php
class Excep_task_model extends CI_Model {
	private $table_name = "mq_exception_task";
	private $view_name = "v_exception_task";
	
	function __construct() {
		parent::__construct();
	}
	function get($task_id) {
		$this->db->where ( 'task_id', $task_id );
		$query = $this->db->get ( $this->view_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	
	function get_count($param = array()) {
		if($param)
			$this->db->where ($param );
		return $this->db->count_all_results ( $this->table_name );
	}
	
	function gets($param = array()) {
		if($param)
			$this->db->where ($param );
		$query = $this->db->get ( $this->view_name );
		return $query->result_array();
	}
	

	/**
	 * 登记异常
	 * @return string
	 */
	function add_exception_task($villager_id, $exception_type, $exception_code, 
			$exception_code_text, $data, $login_user_id){
		$now = date ( 'Y-m-d H:i:s' );
	
		$data ['villager_id'] = $villager_id;
		$data['exception_type'] = $exception_type;
		$data['exception_code'] = $exception_code;
		$data['exception_code_text'] = $exception_code_text;
		$data['record_time'] = $now;
		$data['record_user_id'] = $login_user_id;
		$data ['update_user_id'] = $login_user_id;//处理人
		$data ['update_time'] = $now;//处理时间
		$data['handle_status'] = 10;//登记完成
		$this->db->insert ( $this->table_name, $data);
	
		if($this->db->affected_rows () > 0){
			$task_id = $this->db->insert_id();
			
			$villager_data['record_time'] = $now;
			$villager_data['record_user_id'] = $login_user_id;
			$this->db->where('villager_id', $villager_id);
			$this->db->update ( 'mq_villager', $villager_data );
			
			$CI =& get_instance();
			$CI->load->model('handle_record_model');
			$CI->handle_record_model->insert_record ( $task_id, '登记异常', 
					$data ['exception_condition'], $login_user_id, null );
			
			return "OK";
		} else {
			return '保存失败';
		}
	}
	
	/**
	 * 安排处理
	 * @return string
	 */
	function assign_exception_task($task_id, $handle_user_id, $remark, $handle_type){
		$task = $this->get($task_id);
		if(!$task){
			return '该异常不存在或被删除';
		}
		
		if($task['handle_status'] == 20){
			return '该异常已经安排处理，不需要重复处理';
		}
		if($task['handle_status'] == 50){
			return '该异常已经终结，不需要重复处理';
		}
		
		$now = date ( 'Y-m-d H:i:s' );
		$login_user_id = $this->session->userdata('user_id');
		
		$data ['assign_user_id'] = $login_user_id;
		$data ['assign_time'] = $now;
		$data ['assign_remark'] = $remark;
		$data ['handle_type'] = $handle_type;
		$data ['handle_status'] = 20;
		$data ['update_user_id'] = $login_user_id;//处理人
		$data ['update_time'] = $now;//处理时间
		$data ['receive_user_id'] = $handle_user_id;
		
		$this->db->where('task_id', $task_id);
		$this->db->update ( $this->table_name, $data );
	
		if($this->db->affected_rows () > 0){
			$CI =& get_instance();
			$CI->load->model('handle_record_model');
			$CI->handle_record_model->insert_record($task_id,
					'安排处理异常', $remark, $login_user_id, $handle_user_id);
				
			return "OK";
		} else {
			return '保存失败';
		}
	}
	
	/**
	 * 挂起
	 * @return string
	 */
	function suspend_exception_task($task_id, $remark){
		$task = $this->get($task_id);
		if(!$task){
			return '该异常不存在或被删除';
		}
	
		if($task['handle_status'] == 20){
			return '该异常已经安排处理，不需要重复处理';
		}
		if($task['handle_status'] == 50){
			return '该异常已经终结，不需要重复处理';
		}
		if($task['handle_status'] == 40){
			return '该异常已经挂机，不需要重复处理';
		}
		
		$now = date ( 'Y-m-d H:i:s' );
		$login_user_id = $this->session->userdata('user_id');
	
		$data ['update_user_id'] = $login_user_id;//处理人
		$data ['update_time'] = $now;//处理时间
		$data ['exception_result'] = $remark;
		$data ['handle_status'] = 40;
	
		$this->db->where('task_id', $task_id);
		$this->db->update ( $this->table_name, $data );
	
		if($this->db->affected_rows () > 0){
			$CI =& get_instance();
			$CI->load->model('handle_record_model');
			$CI->handle_record_model->insert_record($task_id,
					'挂起', $remark, $login_user_id, null);
	
			return "OK";
		} else {
			return '保存失败';
		}
	}
	
	/**
	 * 挂起
	 * @return string
	 */
	function finish_exception_task($task_id, $remark){
		$task = $this->get($task_id);
		if(!$task){
			return '该异常不存在或被删除';
		}
	
		if($task['handle_status'] != 30 && $task['handle_status'] != 40){
			return '该异常未处理完成，不能完结';
		}
		
		if($task['handle_status'] == 50){
			return '该异常已经终结，不需要重复处理';
		}
		
		$now = date ( 'Y-m-d H:i:s' );
		$login_user_id = $this->session->userdata('user_id');
	
		$data ['handle_status'] = 50;
		$data ['exception_result'] = $remark;
		$data ['update_user_id'] = $login_user_id;//处理人
		$data ['update_time'] = $now;//处理时间
		$data ['finish_user_id'] = $login_user_id;//终结人
		$data ['finish_time'] = $now;//结束时间
		$data ['receive_user_id'] = $task['handle_user_id'];//结束人
		
		$this->db->where('task_id', $task_id);
		$this->db->update ( $this->table_name, $data );
	
		if($this->db->affected_rows () > 0){
			if($task['exception_type'] == 'economy_code'){
				$villager_data['economy_code'] = 10;
				$villager_data['economy_code_text'] = null;
			} else if($task['exception_type'] == 'harmony_code'){
				$villager_data['harmony_code'] = 10;
				$villager_data['harmony_code_text'] = null;
			} else if($task['exception_type'] == 'health_code'){
				$villager_data['health_code'] = 10;
				$villager_data['health_code_text'] = null;
			}
			$villager_data['record_time'] = '';
			$villager_data['record_user_id'] = '';
			$this->db->where('villager_id', $task['villager_id']);
			$this->db->update ( 'mq_villager', $villager_data );
			
			$CI =& get_instance();
			$CI->load->model('handle_record_model');
			$CI->handle_record_model->insert_record($task_id,
					'终结', $remark, $login_user_id, $task['record_user_id']);
	
			return "OK";
		} else {
			return '保存失败';
		}
	}
	
	
	function insert($villager_id, $handle_user_id, $remark, $handle_type, $data){
		$now = date ( 'Y-m-d H:i:s' );
		$login_user_id = $this->session->userdata('user_id');
		
		$data ['assign_user_id'] = $login_user_id;
		$data ['assign_time'] = $now;
		$data ['assign_remark'] = $remark;
		$data ['villager_id'] = $villager_id;
		$data ['handle_user_id'] = $handle_user_id;
		$data ['handle_type'] = $handle_type;
		$data ['handle_status'] = 10;
		
		$this->db->insert ( $this->table_name, $data );

		$villager_data ['handle_status'] = 10;
		$this->db->where ( 'villager_id', $villager_id );
		$this->db->update ( 'mq_villager', $villager_data );
		
		return $this->db->affected_rows () > 0 ? "OK" : '保存失败';
	}
	
	function delete($task_id) {
		$this->db->where ( 'task_id', $task_id );
		$query = $this->db->delete ( $this->table_name );
		if($this->db->affected_rows () > 0){
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
	function sub_handle_task($task_id, $process, $result, $suggest){
		$row = $this->get($task_id);
		if(!$row){
			return "数据不存在或被删除";
		}
		if($row['handle_status'] == 50){
			return "异常已经处理完成，不允许处理";
		}
		if($row['handle_status'] != 20){
			return "不是等待处理状态，不允许处理";
		}
		$now = date ( 'Y-m-d H:i:s' );
		$login_user_id = $this->session->userdata('user_id');
		
		if($login_user_id != $row['receive_user_id']){
			return "你不是相应处理人， 不允许处理";
		}
	
		$data ['handle_user_id'] = $login_user_id;
		$data ['handle_time'] = $now;
		$data ['handle_result'] = $result;
		$data ['handle_status'] = 30;
		$this->db->where ( 'task_id', $task_id );
		$this->db->update ( $this->table_name, $data );
		if($this->db->affected_rows () > 0){
			$CI =& get_instance();
			$CI->load->model('handle_record_model');
			$CI->handle_record_model->insert_record($task_id,
					'处理完成', $result, $login_user_id, null);

			return "OK";
		} else {
			return '保存失败';
		}
	}
}
