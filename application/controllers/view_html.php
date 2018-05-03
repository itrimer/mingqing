<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_html extends MY_Controller {

	public function __construct() {
		$this->need_login = false;//控制是否需要登录
		parent::__construct ();
	}
	
	public function index()
	{
		echo 'aa';
	}
	
	public function login_view(){
		$data['title'] = '用户登录';
		$buffer = $this->load->view('admin/login_view_ajax.php', $data, true);
		
		echo $buffer;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */