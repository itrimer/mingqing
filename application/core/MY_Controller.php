<?php
class MY_Controller extends CI_Controller {
	public $need_login = false;
	public $page_type = false;
	private $ignore_url_reg = '/^(indexaction\/index|share\/download|login\/login_do|login\/logout)$/A';
	public $has_auth = true;
	public $page_buttons = false;
	public $login_user_id = false;
	public $login_user_status = 1;
	public $login_department_id = false;
	public $login_role_id = false;
	public $login_village_id = false;
	public $menu_id = false;
	
	public function __construct($type = NULL) {
		parent::__construct ();
		$this->check_login ();
	}
	private function check_login() {
		if ($this->need_login) {
			$session_data = $this->session->userdata ( 'username' );
			$this->login_user_id = $this->session->userdata ( 'user_id' );

			if (! $session_data) {
				$this->redirect();
			}
			
			$this->has_auth = $this->checkAuth();
			if (! $this->has_auth) {
				if ($this->is_ajax ()) {
					echo $this->write_json ( '你无权限访问该资源！' );
					exit ();
				}
			}
			
			/*
			$this->load->model('session_model');
			$user_id = $this->session->userdata ( 'user_id' );
			$session_id = $this->session->userdata ( 'login_sess_id' );
			$ip_address = $this->session->userdata ( 'ip_address' );
			$login_num = $this->session_model->valid_login($user_id, $session_id, $ip_address);
			if ($login_num == 0) {
				$this->redirect();
			}
			*/
		}
	}
	private function checkAuth(){
		global $RTR;
		$controller = strtolower ( $RTR->class );
		$method = strtolower ( $RTR->method );
		$page_url = $controller.'/'.$method;
		if($this->ignore($page_url)){
			return true;
		}
		
		$this->load->model('menu_role_model'); 
		$user_auth = $this->menu_role_model->check_user_auth($this->login_user_id, $page_url);
		if($user_auth) {
			$login_info = explode(',', $user_auth);//menu_id, department_id, role_id
			$this->login_department_id = $login_info[1];
			$this->login_role_id = $login_info[2];
			$this->login_village_id = $login_info[3];
			$this->login_user_status = $login_info[4];
			if(!$this->login_user_status){
				return false;//被锁定，不能操作
			}
				
			if($login_info[0] != '999999'){
				$this->menu_id = $login_info[0];
				$this->page_buttons = $this->menu_role_model->get_user_auth($this->login_user_id, $this->menu_id, null, 10);
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function need_check_village(){
		return $this->login_role_id != 1 && $this->login_village_id;
	}
	
	public function need_check_department(){
		return $this->login_role_id != 1 && $this->login_department_id;
	}
	
	public function get_auth_departments($is_map = false) {
		$param = array ();
		if ($this->need_check_department ()) {
			$param ['department_id'] = $this->login_department_id;
		}
		if (! isset ( $this->department_model )) {
			$this->load->model ( 'department_model' );
		}
		if ($is_map) {
			return $this->department_model->dep_map ( $param );
		} else {
			return $this->department_model->get_all ( $param );
		}
	}
	public function get_auth_villages($is_map = false) {
		$param = array ();
		if ($this->need_check_village ()) {
			$param ['village_id'] = $this->login_village_id;
		}
		if (! isset ( $this->village_model )) {
			$this->load->model ( 'village_model' );
		}
		if ($is_map) {
			return $this->village_model->village_map ( $param );
		} else {
			return $this->village_model->get_all ( $param );
		}
	}
	
	private function is_ajax() {
// 		return isset ( $_SERVER ["HTTP_X_REQUESTED_WITH"] ) && strtolower ( $_SERVER ["HTTP_X_REQUESTED_WITH"] ) == "xmlhttprequest";
		return $this->input->is_ajax_request();
	}
	
	private function ignore($page_url){
		return preg_match($this->ignore_url_reg, $page_url);
	}
	
	private function redirect(){
		if ($this->is_ajax ()) {
			echo $this->write_json ( '你还未登录，请先登录' );
		} else {
			redirect ( base_url ( '/admin/login/' ) );
		}
		exit ();
	}
	
	public function write_json($ret){
		$isOk = "OK" == $ret ? "success" : $ret;
		$content = "{\"code\": \"$isOk\"}";
		return $content;
	}

	public function default_page_data($page_type){
		$data['page_type'] = $page_type;
		$data['page_buttons'] = $this->page_buttons;
		$data['has_auth'] = $this->has_auth;
		return $data;
	}
	
	public function init_page_param($page_type, $params){
		$data = $this->default_page_data($page_type);
		$data['page_size'] 	= $this->input->get('page_size');
		if (! $data ['page_size'])
			$data ['page_size'] = 10;
	
		$data['sort'] = $this->input->get('sort');
		$data['sort'] = $data['sort'] ? $data['sort'] : "desc";
	
		$data['start'] = $this->input->get('start');
		if (! $data ['start'] || $data ['start'] <= 0)
			$data ['start'] = 0;
		
		$data['orderby'] 	= $this->input->get('orderby');
		$data['orderby_field'] = $params['order_by'][$data['orderby']?$data['orderby']:'default'];
		return $data;
	}
	
	public function init_search($page_type, $table_name, $search_params,
			$page_params, $pre_where = array()){
		$data = $this->init_page_param($page_type, $page_params);
		
		if($pre_where) {
			$this->db->where($pre_where);
		}
		
		foreach($search_params as $key => $field){
			$data[$key] = $this->input->get($key);
			if(!$data[$key] && isset($field['default_value']) && $field['default_value'] !== false){
				$data[$key] = $field['default_value'];
			}
			
			$field_name = isset($field['field_name']) && $field['field_name']? $field['field_name'] : $key;//数据库字段名
			$force_not_null = isset($field['force_not_null']) && $field['force_not_null'];
			if((!$force_not_null && $data[$key])
			 	|| ($force_not_null && $data[$key] !== '' && $data[$key] !== false)){
				switch ($field['compare_type']) {
					case 'like': $this->db->like($field_name, $data[$key]);break;
					case 'equal': $this->db->where($field_name, $data[$key]);break;
					case 'unequal': $this->db->where($field_name .' !=', $data[$key]);break;
					case 'in': {
						$param_value = $data[$key];
						if($param_value){
							$this->db->where_in($field_name, explode(',', $param_value));break;
						}
					}
				}
			}
		}
		
		//无权限，则不查询数据
		if(!$this->has_auth){
			$data['query'] = array();
			$data['item_total'] = 0;
			
			$this->load->helper('pagination');
			$data ['paginaton_bar'] = '';
			return $data;
		}
		
		$db = clone($this->db);
		$item_total = $this->db->count_all_results($table_name);
// 		$sql = $this->db->last_query();//产生sql
		 
		$this->db = $db;
		
		$this->db->order_by($data['orderby_field'], $data['sort']);
		$this->db->limit($data ['page_size'], $data ['start']);
		$query = $this->db->get($table_name);
		
		$data['query'] = $query->result_array();
		$data['item_total'] = $item_total;
		
		$this->load->helper('pagination');
		$data ['paginaton_bar'] = create_pagination ( $page_params['page_url'].$_SERVER['QUERY_STRING'],
				$data ['item_total'], $data ['page_size'] );
		
		return $data;
	}
	
}