<?php
class Share_model extends CI_Model {
	private $table_name = "mq_share";
	private $view_name = "v_share";
	private $share_id;
	private $share_name;
	private $related_path;
	private $absolute_path;
	private $file_name;
	private $create_date;
	private $update_date;
	private $related_user_id;
	private $is_shared;
	private $share_date;
	

	function __construct()
	{
		parent::__construct();
	}
	function get($share_id) {
		$this->db->where ( 'share_id', $share_id );
		$query = $this->db->get ( $this->view_name );
		if ($query->num_rows () == 1) {
			return $query->row_array ();
		} else {
			return FALSE;
		}
	}
	function get_all() {
		$query = $this->db->get ( $this->table_name );
		return $query->result_array();
	}
	
	function edit($parent_id, $is_directory, $upload_data){
		$CI =& get_instance();
		$CI->load->model('operation_record_model');
		
		$act = $this->input->post("act");
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
		
		$data['share_name'] = $this->input->post('share_name');
		$data['update_date'] = $now;
		if($upload_data){
			$data['file_path'] = $upload_data['full_path'];
			$data['related_path'] = 'images/upload/' . $upload_data['file_name'];
			$data['file_name'] = $upload_data['file_name'];
			$data['file_size'] = $upload_data['file_size'];
			$data['file_ext'] = $upload_data['file_ext'];
			$data['file_type'] = $upload_data['file_type'];
		}
		
		if('insert' == $act){
			$data['parent_id'] = $parent_id;
			$data['is_directory'] = $is_directory;
			$data['related_user_id'] = $login_user_id;
			$data['create_date'] = $now;
			$this->db->insert($this->table_name, $data);
			
			if($this->db->affected_rows()>0){
				$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->db->insert_id(), '新增共享', $now, $data['share_name']);

				return "OK";
			} else {
				return '保存失败';
			}
		} else {
			$row = $this->get ( $this->input->post('share_id') );
			if(!$row) {
				return '该共享不存在或被删除';
			}
			if($login_user_id != $row['related_user_id']){
				return '您不是该文件的所有者，不允许操作！';
			}
			
			$this->db->where('share_id', $this->input->post('share_id'));
			$this->db->update($this->table_name, $data);
			if($this->db->affected_rows()>0){
				$CI->operation_record_model->insert ($login_user_id, $this->table_name, 
					$this->input->post('share_id'), '重命名', $now, $data['share_name']);

				return "OK";
			} else {
				return '重命名失败';
			}
		}
	}
	
	function delete($share_id) {
		$CI =& get_instance();
	
		$row = $this->get ( $share_id );
		if(!$row) {
			return '该共享不存在或被删除';
		}
		
		if($row['is_directory'] == 1){
			//有子文件或目录，则不能删除
		}
		
		$login_user_id = $this->session->userdata('user_id');
		if($login_user_id != $row['related_user_id']){
			return '您不是该文件的所有者，不允许操作！';
		}
		
		$this->db->where ( 'share_id', $share_id );
		$query = $this->db->delete ( $this->table_name );
		if ( $this->db->affected_rows () == 1) {
			$now = date('Y-m-d H:i:s');
			$login_user_id = $this->session->userdata('user_id');
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$share_id, '删除共享', $now, $row['share_name']);
	
			return 'OK';
		} else {
			return FALSE;
		}
	}
	
	function share($share_id, $is_shared) {
		$CI =& get_instance();
	
		$row = $this->get ( $share_id );
		if(!$row) {
			return '该文件不存在或被删除';
		}
		if($row['is_directory'] == 1){
			return '不能共享文件夹';
		}
		
		$login_user_id = $this->session->userdata('user_id');
		if($login_user_id != $row->related_user_id){
			return '您不是该文件的所有者，不允许操作！';
		}
		
		$now = date('Y-m-d H:i:s');
		if($is_shared == 1){
			if($row->is_shared == 1) {
				return '该文件已经共享，不需要重复';
			}
			$data['share_date'] = $now;
		} else {
			if($row['is_shared'] === '0') {
				return '该文件未共享，不需要取消共享';
			}
			$data['share_date'] = null;
		}
		$data['is_shared'] = $is_shared;
		$this->db->where('share_id', $share_id);
		$this->db->update($this->table_name, $data);
		if ( $this->db->affected_rows () == 1) {
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
					$share_id, $is_shared == 1?'共享文件':'取消共享', $now, $row['share_name']);
	
			return 'OK';
		} else {
			return '操作失败';
		}
	}
	
	function package_tree($data, $share_dir_id){
		if(!$share_dir_id){
			return $data;
		}
		$row = $this->get ( $share_dir_id );
		if(!$row){
			return $data;
		}
		array_push($data, $row);
		if($row['parent_id'] != 0){
			$data = $this->package_tree($data, $row['parent_id']);
		}
		return $data;
	}
	
	function mkdir($parent_id, $dir_ame, $login_user_id){
		$now = date('Y-m-d H:i:s');
		$login_user_id = $this->session->userdata('user_id');
	
		$data['share_name'] = $dir_ame;
		$data['related_user_id'] = $login_user_id;
		$data['create_date'] = $now;
		$data['update_date'] = $now;
		$data['parent_id'] = $parent_id;
		$data['is_directory'] = 1;
		$this->db->insert($this->table_name, $data);
		if ( $this->db->affected_rows () > 0) {
			$CI =& get_instance();
			$CI->load->model('operation_record_model');
			$CI->operation_record_model->insert ($login_user_id, $this->table_name,
				$this->db->insert_id(), '新建文件夹', $now, $data['share_name']);
			
			return "OK";
		} else {
			return "保存失败";
		}
	}
	
}
