<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndexAction extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
	}

	public function index()
	{
		$data = $this->default_page_data('index');
		
		$this->load->view('admin/index_view', $data);
		
	}
}

/* End of file notfound.php */
/* Location: ./application/controllers/notfound.php */