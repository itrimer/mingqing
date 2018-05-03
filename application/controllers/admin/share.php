<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class share extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'share_me';
	}

	public function index()
	{
		$init_param['related_user_id'] = $this->login_user_id;
		
		$data = parent::init_search($this->page_type, 'v_share', array (
				'share_name' => array('compare_type'=>'like'),
				'path' => array('compare_type'=>'equal', 'field_name'=>'parent_id', 'force_not_null'=>'1', 'default_value'=>'0')
			),  array ('page_url'=>'/admin/share/index?',
				'order_by' => array(
					'1' => "create_date",
					'2' => "share_name",
					'3' => 'update_date',
					'default'=>'is_directory')
			), $init_param);
		
		if(!$data['path']){
			$data['path'] = 0;
		}
		$this->load->model('share_model');
		$tree_array = array_reverse($this->share_model->package_tree(array(), $data['path']),true);
		$data['tree_array'] = $tree_array;
		
		$this->load->view('admin/share/share_manager.php', $data);
	}

	/**
	 * 共享
	 */
	public function shares()
	{
		$init_param['is_shared'] = 1;
		if ($this->need_check_village()) {
			$init_param ['village_id'] = $this->login_village_id;
		}
		if ($this->need_check_department()) {
			$init_param ['department_id'] = $this->login_department_id;
		}
		
		$data = parent::init_search('share_other', 'v_share', array (
				'share_name' => array('compare_type'=>'like')
			),  array ('page_url'=>'/admin/share/shares?',
				'order_by' => array(
					'1' => "create_date",
					'2' => "share_name",
					'3' => 'update_date',
					'default'=>'create_date')
			), $init_param);
	
		$this->load->view('admin/share/shares_manager.php', $data);
	}

	public function mkdir()
	{
		$this->add(1);
	}
	public function upload()
	{
		$this->add(0);
	}
	
	public function add($is_directory)
	{
		$row = $this->get_post_data();
		$row['is_directory'] = $is_directory;
		$data['page_title'] = $is_directory == 1?'新建文件夹':'上传文件';
		$data['act'] = 'insert';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/share/share_edit.php', $data, true);
		
		echo $buffer;
	}

	public function edit($share_id)
	{
		$this->load->model('share_model');
		$share = $this->share_model->get($share_id);
		if ( !$share ) {
			echo parent::write_json('数据不存在或被删除');
			return;
		}
	
		$data['act'] = 'update';
		$data['page_title'] = '重命名';
		$data['row'] = $share;
		$buffer = $this->load->view('admin/share/share_edit.php', $data, true);
		
		echo $buffer;
	}
	
	private function get_post_data(){
		$data['share_id'] = $this->input->post('share_id');
		$data['share_name'] = $this->input->post('share_name');
		$data['parent_id'] = $this->input->post('parent_id');
		if(!$data['parent_id'])
			$data['parent_id'] = $this->input->get('parent_id');
	
		return $data;
	}
	
	public function save()
	{
		$upload_data = array();
		if(isset($_FILES ['file']) && $_FILES ['file'] && $_FILES ['file']['name']){
			$this->load->library('upload');
			$this->upload->do_upload('file');
			
			$upload_err = $this->upload->display_errors('<p>', '</p>');
			if($upload_err && count($upload_err) > 0){
				echo parent::write_json($upload_err);
				return;
			}
			
			$upload_data = $this->upload->data();
		}
		
		$parent_id = $this->input->post('parent_id');
		$is_directory = $this->input->post('is_directory');
		
		if(!$parent_id) $parent_id = 0;
		if(!$is_directory) $is_directory = 0;
		$this->load->model('share_model');
		$edit_back = $this->share_model->edit($parent_id, $is_directory, $upload_data);
		
		echo parent::write_json($edit_back);
	}
	
	public function delete($id)
	{
		$this->load->model('share_model');
		$edit_back = $this->share_model->delete($id);

		echo parent::write_json($edit_back);
	}
	
	public function download($id)
	{
		$this->load->model('share_model');
		$row = $this->share_model->get($id);
		if(!$row){
			echo parent::write_json("文件不存在或被删除！");
			return;
		}
		
		if($row['is_directory'] == 1){
			echo parent::write_json("不能下载整个目录");
			return;
		}
		
		if($row['is_shared'] != 1 && $row['related_user_id'] != $this->login_user_id){
			echo parent::write_json("不是你的文件，未分享不能盗链！");
			return;
		}
		
		if ($this->need_check_village()) {
			if($row['village_id'] && $row['village_id'] != $this->login_village_id){
				echo parent::write_json("你没有权限下载其他村庄文件！");
				return;
			}
		}
		if ($this->need_check_department()) {
			if($row['department_id'] && $row['department_id'] != $this->login_department_id){
				echo parent::write_json("你没权限下载其他部门文件！");
				return;
			}
		}
		
		$data = file_get_contents($row['related_path']);
		$share_name = $row['share_name'];
		$ext = $row['file_ext'];
		if(!$ext){
			$ext = ".txt";
		}
		
		$this->load->helper('download');
		force_download($share_name.$ext, $data);
	}
	
	public function share_file($id)
	{
		$this->load->model('share_model');
		$edit_back = $this->share_model->share($id, 1);
	
		echo parent::write_json($edit_back);
	}
	
	public function cancel_share($id)
	{
		$this->load->model('share_model');
		$edit_back = $this->share_model->share($id, 0);
	
		echo parent::write_json($edit_back);
	}
	
}

/* End of file share.php */
/* Location: ./application/controllers/admin/share.php */