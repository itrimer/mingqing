<?php
class Menu_role_model extends CI_Model {
	private $table_name_menu = "mq_menu";
	private $table_name_role = "mq_role";
	private $role_auth_name = "v_role_auth";
	private $user_auth_view_name = "v_user_auth";
	private $notice_id = "";

	function __construct()
	{
		parent::__construct();
	}
	
	function get_menu($menu_id) {
		$this->db->where ( 'menu_id', $menu_id );
		$query = $this->db->get ( $this->table_name_menu );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}

	/**
	 * is_button = 20  页面
	 * is_button = 10 按钮
	 */
	function get_menus($param = array()) {
		if($param)
			$this->db->where ( $param );
		$this->db->order_by ( 'seq', 'asc' );
		$query = $this->db->get ( $this->table_name_menu );
		return $query->result_array ();
	}
	
	function get_buttons($menu_id) {
		$this->db->where ( array('parent_id'=> $menu_id, 'is_button'=>10) );
		$this->db->order_by ( 'seq', 'asc' );
		$query = $this->db->get ( $this->table_name_menu );
		
		$sql = $this->db->last_query();//产生sql
		
		return $query->result_array ();
	}
	
	function get_roles($param = array()) {
		if($param)
			$this->db->where ( $param );
		$query = $this->db->get ( $this->table_name_role );
		return $query->result_array ();
	}
	
	function get_role_menus($role_id) {
		$this->db->where ( 'role_id', $role_id );
		$this->db->order_by ( 'seq', 'asc' );
		$query = $this->db->get ( 'v_role_auth' );
		return $query->result_array ();
	}
	
	function get_role($role_id) {
		$this->db->where ( 'role_id', $role_id );
		$query = $this->db->get ( $this->table_name_role );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	
	/**
	 * 
	 * @param unknown $user_id
	 * @param unknown $page_url
	 * @param unknown $menu_type : 10 button, 20 page
	 */
	function get_user_auth($user_id, $parent_id, $page_url, $menu_type) {
		$this->db->where ( 'user_id', $user_id );
		if($parent_id){
			$this->db->where ( 'parent_id', $parent_id );
		}
		if($menu_type){
			$this->db->where ( 'is_button', $menu_type );
		}
		if($page_url){
			$this->db->where ( 'page_url', $page_url );
		}
		$this->db->order_by ( 'seq', 'asc' );
		$query = $this->db->get ( 'v_user_auth' );
		return $query->result_array();
	}
	
	function check_user_auth($user_id, $page_url) {
		$sql = "call p_check_auth($user_id, '$page_url', @code)";
		
		$this->db->query($sql);
		$result = $this->db->query("select @code as code");
		$logincode = $result->row();
		$code = $logincode->code;
		return $code;
	}
	
	function save_role_auth($role_id, $menu_ids = array()) {
		$role = $this->get_role($role_id);
		if (!$role) {
			return '该角色不存在或被删除！';
		}
		
		//开始事务
		$this->db->trans_start();
		$this->db->where('role_id', $role_id);
		$this->db->delete ( 'mq_auth' );
		
		$insert_auth = array();
		foreach ($menu_ids as $key => $menu_id){
			$insert_auth[$key] = array('role_id'=>$role_id, 'menu_id'=>$menu_id);
		}
		
		$this->db->insert_batch ( 'mq_auth', $insert_auth ); // 插入多条
		//结束事务
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			return '保存权限失败';
		} else {
			return 'OK';
		}
	}
	
	function save_menu($is_button = 20){
		$CI =& get_instance();
		$act = $this->input->post("act");
		$CI->load->model('operation_record_model');
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
	
		$data['menu_name'] = $this->input->post('menu_name');
		$data['page_url'] = $this->input->post('page_url');
	
		if('insert' == $act){
			$data['create_time'] = $now;
			$data['create_user_id'] = $login_user_id;
			$data['is_button'] = $is_button;//页面
			if($is_button == 20){
				$data['parent_id'] = 0;
			}
	
			$this->db->insert($this->table_name_menu, $data);
			if($this->db->affected_rows() > 0){
				$CI->operation_record_model->insert ($login_user_id, $this->table_name_menu,
						$this->db->insert_id(), '新增菜单', $now, $data['menu_name'].$data['page_url']);
				return 'OK';
			} else {
				return '保存失败';
			}
		} else {
			$this->db->where('menu_id', $this->input->post('menu_id'));
			$this->db->update($this->table_name_menu, $data);
				
			if($this->db->affected_rows() > 0){
				$CI->operation_record_model->insert ($login_user_id, $this->table_name_menu,
						$this->input->post('menu_id'), '修改菜单', $now, $data['menu_name'].$data['page_url']);
				return 'OK';
			} else {
				return '保存失败'.$this->input->post('menu_id');
			}
		}
	}
}
