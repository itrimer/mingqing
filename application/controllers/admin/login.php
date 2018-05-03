<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		$this->need_login = false;//控制是否需要登录
		parent::__construct ();
	}
	
	public function index()
	{
		$data['username'] = '';
		$data['password'] = '';
		$this->load->view('admin/login_view.php', $data);
	}
	
	private function valid_sign(){
		$verify_code = $this->input->post('verify_code');
		$verify_code_md5 = md5 ( $this->config->item ( 'captcha_pre' )
				. $verify_code . $this->config->item ( 'captcha_end' ) );
		$captcha_code_in_session = $this->session->userdata($this->config->item ( 'captcha_code' ));
		
		if($verify_code_md5 != $captcha_code_in_session) {
			return '验证码错误';
		}
		return 'OK';
	}
	
	public function login_do()
	{
		$username = $this->input->post('username');
		$data['username'] = $username;
		$data['password'] = $this->input->post('password');
		
// 		$verify_code_sign = $this->valid_sign();
// 		if('OK' != $verify_code_sign){
// 			$data['error_msg'] = $verify_code_sign;
// 			$this->load->view('admin/login_view.php', $data);
// 			return;
// 		}
		
		$this->load->model('user_model');
		$login_sign = $this->user_model->check_login(
				$this->input->post('username'),
				$this->input->post('password')
		);
		if ($login_sign == 'true') {
			$this->input->set_cookie ( '_login_value_', $username, 86400, '/', '/', null );
			
			echo parent::write_json('OK');
		} else {
			echo parent::write_json($login_sign);
		}
	}
	
	public function logout() {
		$user_id = $this->session->userdata ( 'user_id' );
		$session_id = $this->session->userdata('login_sess_id');
		$ip_address = $this->session->userdata('ip_address');

		$this->load->model('session_model');
		$this->session_model->delete_login($user_id, $session_id, $ip_address);
		
		$this->session->sess_destroy();  
		redirect ( base_url ( '/admin/login/' ) );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */