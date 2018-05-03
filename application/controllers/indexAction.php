<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndexAction extends CI_Controller {

	public function index()
	{
		$data = array();
		
// 		$this->load->model('news_model');
// 		$this->load->model('about_model');
		
// 		$data['newshtml'] = $this->news_model->getNewsListIndex(0, 1, 4, 0, 1, 0);
// 		$data['indexNews'] = $this->news_model->getIndexNews(1, 0);
// 		$data['indexAboutImg'] = $this->about_model->getAboutImg();
// 		$data['indexAboutContent'] = $this->about_model->getAboutContent(0, 1);
		
		$this->load->view('index_view', $data);
	}
}

/* End of file notfound.php */
/* Location: ./application/controllers/notfound.php */