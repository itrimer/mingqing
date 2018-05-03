<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popedom extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'popedom';
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('popedom_model');
		
		$data = parent::init_search($this->page_type, 'mq_popedom', array (
				'popedom_name' => array('compare_type'=>'like')
		),  array ('page_url'=>'/admin/village/?',
				'order_by' => array(
				'1' => "popedom_name",
				'2' => "popedom_id",
				'default'=>'popedom_name')
		) );
		
		$this->load->view('admin/village/popedom_manager.php', $data);
	}
	
	public function edit($id)
	{
		$this->load->model('popedom_model');
		$row = $this->popedom_model->get($id);
		if (!$row) {
			echo parent::write_json("数据不存在或删除");
			return;
		}
	
		$data['act'] = 'update';
		$data['page_title'] = '编辑辖区';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/village/popedom_edit.php', $data, true);
		
		echo $buffer;
	}
	public function add()
	{
		$data['page_title'] = '新增辖区';
		$data['act'] = 'insert';
		$data['row'] = $this->get_post_data();
		$buffer = $this->load->view('admin/village/popedom_edit.php', $data, true);
		
		echo $buffer;
	}
	
	public function save()
	{
		$this->load->model('popedom_model');
		$edit_back = $this->popedom_model->edit($this->get_post_data());

		echo parent::write_json($edit_back);
	}
	
	private function get_post_data(){
		$data['popedom_id'] = $this->input->post('popedom_id');
		$data['popedom_name'] = $this->input->post('popedom_name');
		$data['remark'] = $this->input->post('remark');
		return $data;
	}
	
	public function delete($id)
	{
		$this->load->model('popedom_model');
		$edit_back = $this->popedom_model->delete($id);
		
		echo parent::write_json($edit_back);
	}
	public function add_village($id)
	{
		$this->load->model('popedom_model');
		$row = $this->popedom_model->get($id);
		if (!$row) {
			echo parent::write_json("数据不存在或删除");
			return;
		}

		$this->load->model('village_model');
		$villages = $this->village_model->get_all();
		
		$data['page_title'] = '设置辖区';
		$data['row'] = $row;
		$data['villages'] = $villages;
		$buffer = $this->load->view('admin/village/popedom_add_villages.php', $data, true);
	
		echo $buffer;
	}
	
	public function do_add_villages()
	{
		$popedom_id = $this->input->post('popedom_id');
		$village_ids = $this->input->post('dest_village');
		
		$this->load->model('popedom_model');
		$is_ok = $this->popedom_model->do_add_village($popedom_id, $village_ids);
	
		echo parent::write_json($is_ok);
	}
	
}

/* End of file popedom.php */
/* Location: ./application/controllers/admin/village.php */