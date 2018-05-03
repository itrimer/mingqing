<?php
class Villager_model extends CI_Model {
	private $table_name = "mq_villager";
	private $view_name = "v_villager";
	private $villager_id = "";
	private $villager_name;

	function __construct()
	{
		parent::__construct();
	}

	function get($villager_id) {
		$this->db->where ( 'villager_id', $villager_id );
		$query = $this->db->get ( $this->view_name );
		if ($query->num_rows () == 1) {
			return $query->row_array();
		} else {
			return FALSE;
		}
	}
	function get_all() {
		$query = $this->db->order_by ( 'village_id', 'desc' );
		$query = $this->db->order_by ( 'villager_name', 'desc' );
		$query = $this->db->get ( $this->table_name );
		return $query->result_array();
	}

	function get_count($params) {
		$query = $this->db->where ( $params );
		return $query->count_all_results($this->table_name);
	}

	function get_villagers($params) {
		$query = $this->db->order_by ( 'village_id', 'desc' );
		$query = $this->db->order_by ( 'villager_name', 'desc' );
		$this->db->where ( $params );
		$query = $this->db->get ( $this->table_name );
		if ($query->num_rows () >= 1) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}
	
	function get_house_holder($village_id, $house_no) {
		$params = array('village_id' => $village_id, 'house_no' => $house_no, 'relation_ship'=>'1');
		$villagers = $this->get_villagers($params);
		if($villagers){
			return $villagers[0];
		} 
		return false;
	}
	
	function get_families($house_holder_id) {
		$this->db->where('house_holder_id', $house_holder_id); 
		$this->db->where('villager_id !=', $house_holder_id);
		$query = $this->db->get ( $this->view_name );
		return $query->result_array();
	}
	
	function edit($act, $data, $upload_data = array(), $dict_map = array()){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		$CI->load->model('excep_task_model');
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
		
		foreach ($upload_data as $key => $row){
			$data[$key] = 'images/upload/' . $row['file_name'];
		}

		if(!$data['villager_name'] ){
			return '姓名不能为空';
		}
		if(!$data['house_no'] ){
			return '门牌号不能为空';
		}
		if(!$data['village_id'] ){
			return '村庄不能为空';
		}
		if(!$data['relation_ship'] ){
			return '与户主关系不能为空';
		}
		
		$data['update_date'] = $now;
		$data['update_user_id'] = $user_id;
		if('insert' == $act){
			if ($data['identity_card']){
				if($this->get_count ( array ('identity_card' => $data ['identity_card']) ) > 0) {
					return $data ['villager_name'] . '在村庄中已经存在';
				}
				if(strlen($data['identity_card']) >= 14){
					$birth_day = substr($data['identity_card'], 6, 8);
					$year = substr($birth_day, 0, 4);
					$month = substr($birth_day, 4, 2);
					$day = substr($birth_day, 6, 2);
					$birth_day = $year.'-'.$month.'-'.$day;
					$data['birth_day'] = $birth_day;
				}
				
				if(!isset($data['sex']) || !$data['sex']) {
					$sec_value = substr($data['identity_card'], strlen($data['identity_card'])-2, 1);
					if(MOD($sec_value,2) == 1){
						$data['sex'] = '10';//男
					} else {
						$data['sex'] = '20';//女
					}
				}
			}
			
			//户主id
			if($data['relation_ship'] && '1' != $data['relation_ship']){
				$house_holder = $this->get_house_holder($data['village_id'], $data['house_no']);
				$data = $this->auto_family($house_holder, $data);
			}
			if(!isset($data['health_code']) || !$data['health_code']){
				$data['health_code'] = '10';
			}
			if(!isset($data['economy_code']) || !$data['economy_code']){
				$data['economy_code'] = '10';
			}
			if(!isset($data['harmony_code']) || !$data['harmony_code']){
				$data['harmony_code'] = '10';
			}
			$data['create_date'] = $now;
			$data['create_user_id'] = $user_id;
			$this->db->insert($this->table_name, $data);
			
			if ($this->db->affected_rows () > 0) {
				$villager_id = $this->db->insert_id();
				
				if('1' == $data['relation_ship'] && isset($data['economy_code']) && $data['economy_code'] != 10){
					$task_data['exception_time'] = $now;
					$task_data['exception_condition'] = $dict_map['economy_code'][$data['economy_code']];
					$CI->excep_task_model->add_exception_task($villager_id, 'economy_code',
						$data['economy_code'], null, $task_data, $user_id);
				}
				
				if('1' == $data['relation_ship'] && isset($data['harmony_code']) && $data['harmony_code'] != 10){
					$task_data['exception_time'] = $now;
					$task_data['exception_condition'] = $dict_map['harmony_code'][$data['harmony_code']];
					$CI->excep_task_model->add_exception_task($villager_id, 'harmony_code',
							$data['harmony_code'], null, $task_data, $user_id);
				}
				
				if('1' == $data['relation_ship'] && isset($data['health_code']) && $data['health_code'] != 10){
					$task_data['exception_time'] = $now;
					$task_data['exception_condition'] = $dict_map['health_code'][$data['health_code']];
					$CI->excep_task_model->add_exception_task($villager_id, 'health_code',
							$data['health_code'], null, $task_data, $user_id);
				}
				
				$CI->operation_record_model->insert ($user_id, $this->table_name, 
					$villager_id, '新增村民信息', $now, $data['villager_name']);
				return "OK";
			} else {
				return "保存失败";
			}
		} else {
			//户主id
			if($data['relation_ship'] && '1' != $data['relation_ship']){
				$house_holder = $this->get_house_holder($data['village_id'], $data['house_no']);
				$data = $this->auto_family($house_holder, $data);
			}
			
			$this->db->where('villager_id', $data['villager_id']);
			$this->db->update($this->table_name, $data);
			
			if ($this->db->affected_rows () > 0) {
				$CI->operation_record_model->insert ($user_id, $this->table_name, 
					$data['villager_id'], '修改村民信息', $now, $data['villager_name']);
				return "OK";
			} else {
				return "保存失败";
			}
		}
	}
	
	function auto_family($house_holder, $data){
		if(!$house_holder){
			return $data;
		}
		$data['house_holder_id'] = $house_holder['villager_id'];//户主
		if(isset($data['relation_ship']) && '3' == $data['relation_ship'] ){
			if($house_holder['sex'] == 10){
				$data['father_id'] = $house_holder['villager_id'];//父亲
			}
			if($house_holder['sex'] == 20){
				$data['mother_id'] = $house_holder['villager_id'];//母亲
			}
		}
		if(isset($data['relation_ship']) && '2' == $data['relation_ship'] ){//配偶
			$data['spouse_id'] = $house_holder['villager_id'];//配偶
			$data['marital_status'] = 20;//已婚
			
			if(isset($data['villager_id']) && (!isset($house_holder['spouse_id']) || $house_holder['spouse_id'] != $data['villager_id'])){
				$house_holder['spouse_id'] = $data['villager_id'];//户主的配偶
				$house_holder['marital_status'] = 20;//已婚
			}
		}
		return $data;
	}
	
	function do_record_exception($villager_id, $exception_type, $exception_code,
			$exception_code_text, $task_data, $upload_data){
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
		
		$villager = $this->get($villager_id);
		if(!$villager) {
			return '数据不存在或被删除！';
		}
		
		if($villager['relation_ship'] != '1') {
			return '只能通过户主去登记异常';
		}

		foreach ($upload_data as $key => $row){
			$data[$key] = 'images/upload/' . $row['file_name'];
		}

		$this->db->trans_start();
		$exception_img = null;
		if($exception_type == 'harmony_code'){
			if($villager['harmony_code'] != 10){
				return '和谐指标已经是为异常状态，不需要重复登记！';
			}
			
			$data['harmony_code'] = $exception_code;
			$data['harmony_code_text'] = $exception_code_text;
			if(isset($data['harmony_img']))
				$exception_img = $data['harmony_img'];
		} else if($exception_type == 'economy_code'){
			if($villager['economy_code'] != 10){
				return '经济指标已经是为异常状态，不需要重复登记！';
			}
			$data['economy_code'] = $exception_code;
			$data['economy_code_text'] = $exception_code_text;
			if(isset($data['economy_img']))
				$exception_img = $data['economy_img'];
		} else if($exception_type == 'health_code'){
			if($villager['health_code'] != 10){
				return '健康指标已经是为异常状态，不需要重复登记！';
			}
			$data['health_code'] = $exception_code;
			$data['health_code_text'] = $exception_code_text;
			if(isset($data['health_img']))
				$exception_img = $data['health_img'];
		}
		
		$this->db->where ( 'villager_id', $villager_id );
		$this->db->update ( $this->table_name, $data );
		if ($this->db->affected_rows () > 0) {
			if($exception_img)
				$task_data['exception_img'] = $exception_img;
			
			$CI =& get_instance();
			$CI->load->model('excep_task_model');
			$CI->excep_task_model->add_exception_task($villager_id, $exception_type,
					$exception_code, $exception_code_text, $task_data, $user_id);
			//结束事务
			$this->db->trans_complete();
				
			return 'OK';
		} else {
			//结束事务
			$this->db->trans_complete();
			return '登记异常失败';
		}
	}

	function do_deal_exception($data, $handle_type){
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
	
		$villager = $this->get($data['villager_id']);
		if(!$villager) {
			return '数据不存在或被删除！';
		}
		if($villager['harmony_code'] == '10' &&
			$villager['health_code'] == '10' &&
			$villager['economy_code'] == '10'){
			return '该民情无异常情况，不需要处理！';
		}
		
		if(!$data['handle_type']){
			return '请选择异常流向！';
		}
		
		if('90' == $handle_type){
			$data['harmony_code'] = '10';
			$data['health_code'] = '10';
			$data['economy_code'] = '10';
			$data['handle_status'] = '50';
		}  

		$data['update_date'] = $now;
		$data['update_user_id'] = $user_id;
		$this->db->where('villager_id', $data['villager_id']);
		$this->db->update($this->table_name, $data);
	
		if($this->db->affected_rows()>0){
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$this->load->helper('text');
							
			$CI->operation_record_model->insert ($user_id, $this->table_name,
					$data['villager_id'], '选择异常流向', $now, $data['exception_result']);
			return 'OK';
		} else {
			return "保存失败";
		}
	}

	function save_feedback($data){
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
	
		$data_row = $this->get($data['villager_id']);
		if(!$data_row) {
			return '数据不存在或被删除！';
		}
	
		$data['update_date'] = $now;
		$data['update_user_id'] = $user_id;
		$this->db->where('villager_id', $data['villager_id']);
		$this->db->update($this->table_name, $data);
	
		if($this->db->affected_rows()>0){
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$this->load->helper('text');
							
			$CI->operation_record_model->insert ($user_id, $this->table_name,
					$data['villager_id'], '跟踪回访', $now, $data['exception_feedback']);
			return 'OK';
		} else {
			return "保存失败";
		}
	}
	
	function suspend($villager_id){
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');
		
		$row = $this->get($villager_id);
		if(!$row) {
			return '数据不存在或被删除！';
		}
		if($row['handle_status'] == 40) {
			return '已是挂起状态，不允许重复！';
		}			
		$data['handle_time'] = $now;
		$data['handle_status'] = 40;
		$this->db->where('villager_id', $villager_id);
		$this->db->update($this->table_name, $data);
		if ($this->db->affected_rows () > 0) {
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($user_id, $this->table_name,
				$villager_id, '挂起', $now, $data['villager_name']);
			
			return 'OK';
		} else {
			return "保存失败";
		}
	}

	function save_families($data){
		$row = $this->get ( $data['villager_id'] );
		if (! $row) {
			return '数据不存在或被删除 ！';
		}
		$house_holder_id = $data['house_holder_id'];//户主
		if(!$house_holder_id) {
			$house_holder_id = $row['house_holder_id'];
		}
		if($house_holder_id){
			$house_holder = $this->get ( $house_holder_id );
			if(!isset($data['relation_ship'])){
				$data['relation_ship'] = $row['relation_ship'];
			}
			if($house_holder){
				$data = $this->auto_family($house_holder, $data);
			}
		}
		
		$now = date('Y-m-d H:i:s');
		$user_id = $this->session->userdata('user_id');

		$info = implode(',', $data);
		
		$data['update_date'] = $now;
		$data['update_user_id'] = $user_id;
		
		$this->db->where('villager_id', $data['villager_id']);
		$this->db->update($this->table_name, $data);
		
		if($this->db->affected_rows() > 0){
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($user_id, $this->table_name,
					$this->input->post('villager_id'), '设置家庭关系', $now, $info);
			return "OK";
		} else {
			return "操作失败！";
		}
	}
	
	function delete($villager_id, $login_user_id){
		$villager = $this->get($villager_id);
		if(!$villager) {
			return '数据不存在或被删除！';
		}
	
		$CI =& get_instance();
		$CI->load->model('excep_task_model');
		$err_count = $CI->excep_task_model->get_count(array('villager_id'=> $villager_id));
		if($err_count > 0) {
			return $villager['villager_name'].'有异常信息，不能删除';
		}
		if($villager['relation_ship'] == 1){
			$family_count = $this->get_count(array('house_holder_id'=> $villager_id));
			if($family_count > 0) {
				return $villager['villager_name'].'有多个家庭成员，不能删除';
			}
		}
		
		$this->db->where ( 'villager_id', $villager_id );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$villager_id, '删除村民信息', $now, $villager['village_id'].','.$villager['villager_name']);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
}
