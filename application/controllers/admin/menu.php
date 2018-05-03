<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
		$this->page_type = 'menu';
	}

	public function index()
	{
		$init_data['is_button']='20';
		
		$data = parent::init_search($this->page_type, 'mq_menu', array (
				'menu_name' => array('compare_type'=>'like')
		),  array ('page_url'=>'/admin/menu/index?',
				'order_by' => array(
					'1' => "menu_name",
					'default'=>'seq')
		), $init_data);
		
		$this->load->view('admin/menu/menu_manager.php', $data);
	}
	
	public function role()
	{
		$data = parent::init_search('role', 'mq_role', array (
				'role_name' => array('compare_type'=>'like')
		),  array ('page_url'=>'/admin/menu/role?',
				'order_by' => array(
						'1' => "role_id",
						'2' => "role_name",
						'default'=>'role_id')
		) );
	
		$this->load->view('admin/menu/role_manager.php', $data);
	}
	
	public function show_buttons($menu_id)
	{
		$this->load->model('menu_role_model');
		$menu = $this->menu_role_model->get_menu($menu_id);
		if (!$menu) {
			echo parent::write_json('该角色不存在或被删除！');
			return;
		}
	
		$this->load->model('menu_role_model');
		$buttons = $this->menu_role_model->get_buttons($menu_id);
	
		$data['buttons'] = $buttons;
		$data['row'] = $menu;
		$data['page_title'] = '查看按钮';
		$buffer = $this->load->view('admin/menu/show_buttons.php', $data, true);
	
		echo $buffer;
	}
	
	public function set_role_auth($role_id)
	{
		$this->load->model('menu_role_model');
		$role = $this->menu_role_model->get_role($role_id);
		if (!$role) {
			echo parent::write_json('该角色不存在或被删除！');
			return;
		}
		
		$data['menus'] = $this->menu_role_model->get_menus(array('is_button'=>20));
		foreach ($data['menus'] as $key => $menu){
			$button_menus = $this->menu_role_model->get_menus(array('parent_id'=>$menu['menu_id'], 'is_button'=>10));
			if($button_menus) {
				$data['menus'][$key]['buttons'] = $button_menus;
			} else {
				$data['menus'][$key]['buttons'] = array();
			}
		}
		
		$authed_menu = $this->menu_role_model->get_role_menus($role_id);
		foreach ($authed_menu as $key => $menu){
			$data['authed_menu'][$menu['menu_id']] = $menu;
		}

		$data['act'] = 'update';
		$data['row'] = $role;
		$data['page_title'] = '设置权限';
		$buffer = $this->load->view('admin/menu/set_role_auth.php', $data, true);
		
		echo $buffer;
	}
	
	public function do_save_role_auth(){
		$role_id = $this->input->post('role_id');
		$menu_ids = $this->input->post('menu_id');
		
		$this->load->model('menu_role_model');
		$isOk = $this->menu_role_model->save_role_auth($role_id, $menu_ids);
		
		echo parent::write_json($isOk);
	}
	
	public function add_menu()
	{
		$row = $this->get_menu_post_data();
		
		$data['page_title'] = '新增菜单';
		$data['act'] = 'insert';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/menu/menu_edit.php', $data, true);

		echo $buffer;
	}
	public function edit_menu($menu_id)
	{
		$this->load->model('menu_role_model');
		$menu = $this->menu_role_model->get_menu($menu_id);
		if (!$menu) {
			echo parent::write_json('该菜单不存在或被删除！');
			return;
		}
	
		$data['row'] = $menu;
		$data['page_title'] = '编辑菜单';
		$data['act'] = 'update';
		$buffer = $this->load->view('admin/menu/menu_edit.php', $data, true);
	
		echo $buffer;
	}
	
	public function save_menu()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('menu_name','菜单','trim|required|max_length[20]');
		$this->form_validation->set_rules('page_url','菜单地址','trim|required');
		if($this->form_validation->run() == false){
			$e = validation_errors();
			$e = "{\"code\": \"" . ("OK" == $e?"success":$e) . "\"}";
			$e = str_replace("\n", "", $e);
			echo $e;
			return;
		}
		
		$this->load->model('menu_role_model');
		$edit_back = $this->menu_role_model->save_menu();
		
		echo parent::write_json($edit_back);
	}
	
	
	private function get_menu_post_data(){
		$data['menu_id'] = $this->input->post('menu_id');
		$data['menu_name'] = $this->input->post('menu_name');
		$data['page_url'] = $this->input->post('page_url');
		return $data;
	}
	
}

/* End of file menu.php */
/* Location: ./application/controllers/admin/menu.php */