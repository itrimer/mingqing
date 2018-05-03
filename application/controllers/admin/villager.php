<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Villager extends MY_Controller {
	
	public function __construct() {
		$this->need_login = true;//控制是否需要登录
		parent::__construct ();
	}

	/**
	 * 公民信息,个人
	 */
	public function index()
	{
		$villager_name = $this->input->get('villager_name');
		$search_by_name = false;

		$init_data = array();
		if($villager_name){
			$search_by_name = true;
		} else {
			$init_data['relation_ship']='1';
		}
		if ($this->need_check_village()) {
			$init_data['village_id'] = $this->login_village_id;
		}
		
		$data = parent::init_search('villager', 'v_villager',  array (
				'villager_name' => array('compare_type' => 'like'),
				'village_id' => array('compare_type' => 'equal'),
				'identity_dy' => array('compare_type' => 'equal'),
				'sex' => array('compare_type' => 'equal')
			),  array ('page_url' => '/admin/villager/?', 
					'order_by' => array( '1' => "health_code",
							'2' => "harmony_code", 
							'3' => 'economy_code',
							'default'=>'record_time')
			), $init_data);
		
		$this->load->model('villager_model');
		foreach ($data['query'] as $key => $row){
			$families = $this->villager_model->get_families($row['villager_id']);
			$data['query'][$key]['families'] = $families;
		}
		
		$data['villages'] = $this->get_auth_villages(true);
		
		$this->load->model('dict_model');
		$data['dict_map'] = $this->dict_model->all_code_map();
		
		$data['popedoms'] = $this->get_popedoms();
		$this->load->view('admin/villager/villager_manager.php', $data);
	}

	/**
	 * 完结任务
	 */
	public function handle_task()
	{
		$this->exception_tasks('wait_handle_task');
	}
	public function finished_handle_task()
	{
		$this->exception_tasks('finished_handle_task');
	}
	
	/**
	 * 等待处理异常
	 */
	public function exception_tasks($page_type)
	{
		$login_user_id = $this->session->userdata('user_id');
		$init_data = '';
		if($this->login_role_id != 1){
			$init_data = " (record_user_id=$login_user_id or (handle_user_id=$login_user_id or handle_user_id is null) or (receive_user_id=$login_user_id or receive_user_id is null) )";
		}
		
		if ($this->need_check_village()) {
			if(strlen($init_data) > 0){
				$init_data = "(".$init_data." or village_id = $this->login_village_id)";
			} else {
				$init_data = " village_id = $this->login_village_id";
			}
		}
		
		$data = parent::init_search($page_type, 'v_exception_task',  array (
				'villager_name' => array('compare_type' => 'like'),
				'village_id' => array('compare_type' => 'equal'),
				'handle_status' => array('compare_type' => 'in'),
				'sex' => array('compare_type' => 'equal'),
				'identity_dy' => array('compare_type' => 'equal'),
				'exception_type' => array('compare_type' => 'equal')
		),  array ('page_url' => '/admin/villager/handle_task?',
				'order_by' => array( '1' => "handle_status",
						'default'=>'record_time')
			), $init_data);

		$data['villages'] = $this->get_auth_villages(true);
		
		$this->load->model('dict_model');
		$data['dict_map'] = $this->dict_model->all_code_map();
	
		$data['popedoms'] = $this->get_popedoms();
		$this->load->view('admin/villager/wait_handle_tasks.php', $data);
	}
	
	private function get_popedoms(){
		$this->load->model('popedom_model');
		$popedoms = $this->popedom_model->get_all();
		
		$this->load->model('village_model');
		for($i = 0; $i < count($popedoms); $i++){
			$villages = $this->village_model->get_all(array('popedom_id'=>$popedoms[$i]['popedom_id']));
			$popedoms[$i]['villages'] = $villages;
		}
		return $popedoms;
	}
	
	public function record_exception($id)
	{
		$this->load->model ( 'villager_model' );
		$row = $this->villager_model->get ( $id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
		
		if ($row['relation_ship'] != '1') {
			echo parent::write_json('只能通过户主去登记异常');
			return;
		}
		
		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
				
		$data['act'] = 'update';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/villager/record_exception.php', $data, true);
		
		echo $buffer;
	}

	public function do_record_exception()
	{
		$villager_id = $this->input->post('villager_id');
		$exception_type = $this->input->post('exception_type');
		if(!$exception_type) {
			echo parent::write_json('请选择异常类型');
			return;
		}
		$post_data = array();
		$file_key = '';
		$exception_code = '';
		$exception_code_text = '';
		if($exception_type == 'economy_code'){
			$exception_code = $this->input->post('economy_code');
			if(!$exception_code) {
				echo parent::write_json('和谐指数不能为空');
				return;
			}
			$exception_code_text = $this->input->post('economy_code_text');
			
			$file_key = 'economy_img';
		} else if($exception_type == 'harmony_code'){
			$exception_code = $this->input->post('harmony_code');
			if(!$exception_code) {
				echo parent::write_json('和谐指数不能为空');
				return;
			}
			$exception_code_text = $this->input->post('harmony_code_text');
			$file_key = 'harmony_img';
		} else if($exception_type == 'health_code'){
			$exception_code = $this->input->post('health_code');
			if(!$exception_code) {
				echo parent::write_json('健康指数不能为空');
				return;
			}
			$exception_code_text = $this->input->post('health_code_text');
			$file_key = 'health_img';
		}
		
		//上传图片
		$upload_data = array();
		$this->load->library('upload');
		$file = $_FILES[$file_key];
		if($file['name']) {
			if(!$this->upload->do_upload($file_key)){
				$upd_err = $this->upload->display_errors('<p>', '</p>');
				$upload_err[$key] = $upd_err;
				$err = implode(",", $upload_err);
				if($err){
					echo parent::write_json($err);
					return;
				}
			}
		
			$upload_data[$file_key] = $this->upload->data();
		}
	
		$post_data['exception_addr'] = $this->input->post('exception_addr');
		$post_data['exception_time'] = $this->input->post('exception_time');
		$post_data['exception_condition'] = $this->input->post('exception_condition');
		
		$this->load->model('villager_model');
		$edit_back = $this->villager_model->do_record_exception($villager_id, $exception_type,
				 $exception_code, $exception_code_text, $post_data, $upload_data);
	
		echo parent::write_json($edit_back);
	}
	public function for_feedback($id)
	{
		$this->load->model ( 'villager_model' );
		$row = $this->villager_model->get ( $id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
		
		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
				
		$data['row'] = $row;
		$buffer = $this->load->view('admin/villager/feedback.php', $data, true);
		
		echo $buffer;
	}
	public function save_feedback()
	{
		$this->load->library('form_validation');
	
		$post_data['villager_id'] = $this->input->post('villager_id');
		$post_data['harmony_code'] = $this->input->post('harmony_code');
		$post_data['health_code'] = $this->input->post('health_code');
		$post_data['economy_code'] = $this->input->post('economy_code');
		$post_data['health_code_text'] = $this->input->post('health_code_text');
		$post_data['economy_code_text'] = $this->input->post('economy_code_text');
		$post_data['harmony_code_text'] = $this->input->post('harmony_code_text');
		
		$post_data['exception_feedback'] = $this->input->post('exception_feedback');
		
		$this->load->model('villager_model');
	
		$edit_back = $this->villager_model->save_feedback($post_data);
	
		echo parent::write_json($edit_back);
	}
	
	public function add()
	{
		$village_param = array();
		if ($this->need_check_village()) {
			$village_param['village_id'] = $this->login_village_id;
		}
		
		$this->load->model('villager_model');
		$data['villagers'] = $this->villager_model->get_all($village_param);
	
		$data['villages'] = $this->get_auth_villages();
		
		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
	
		$data['page_title'] = '新增村民';
		$data['act'] = 'insert';
		$data['row'] = $this->get_post_data();
	
		$buffer = $this->load->view('admin/villager/villager_edit.php', $data, true);
	
		echo $buffer;
	}

	public function edit($id)
	{
		$this->load->model ( 'villager_model' );
		$row = $this->villager_model->get ( $id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
	
		$village_param = array();
		if ($this->need_check_village()) {
			$village_param['village_id'] = $this->login_village_id;
		}
		
		$data['villagers'] = $this->villager_model->get_all($village_param);
	
		$this->load->model('village_model');
		$data['villages'] = $this->village_model->get_all($village_param);
	
		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
	
		$data['act'] = 'update';
		$data['page_title'] = '编辑村民';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/villager/villager_edit.php', $data, true);
	
		echo $buffer;
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->load->library('upload');
		
		$this->form_validation->set_rules('villager_name','姓名','trim|required|max_length[20]');
		$this->form_validation->set_rules('village_id','村庄','required');
		if($this->form_validation->run() == false){
			$e = validation_errors();
			$e = str_replace("\n", "", $e);
			
			echo parent::write_json($e);
			return;
		}

		$upload_err = array();
		$upload_data = array();
		foreach ($_FILES as $key => $file){
			if($file['name']) {
				if(!$this->upload->do_upload($key)){
					$upd_err = $this->upload->display_errors('<p>', '</p>');
					$upload_err[$key] = $upd_err;
					continue;
				}
		
				$upload_data[$key] = $this->upload->data();
			}
		}
		
		$err = implode(",", $upload_err);
		if($err){
			echo parent::write_json($err);
			return;
		}
		
		$this->load->model('dict_model');
		$dict_map = $this->dict_model->all_code_map();
		
		$act = $this->input->post('act');
		$post_data = $this->get_post_data();
		$this->load->model('villager_model');
		$edit_back = $this->villager_model->edit($act, $post_data, $upload_data, $dict_map);
		
		echo parent::write_json($edit_back);
	}
	
	private function get_post_data(){
		$data['villager_id'] = $this->input->post('villager_id');
		$data['villager_name'] = $this->input->post('villager_name');
		$data['village_id'] = $this->input->post('village_id');
		$data['identity_card'] = $this->input->post('identity_card');
		$data['father_id'] = $this->input->post('father_id');
		$data['mother_id'] = $this->input->post('mother_id');
		$data['spouse_id'] = $this->input->post('spouse_id');
		$data['sex'] = $this->input->post('sex');
		$data['birth_day'] = $this->input->post('birth_day');
		$data['relation_ship'] = $this->input->post('relation_ship');
		$data['address'] = $this->input->post('address');
		$data['blood_type'] = $this->input->post('blood_type');
		$data['marital_status'] = $this->input->post('marital_status');
		$data['education_degree'] = $this->input->post('education_degree');
		$data['mobile'] = $this->input->post('mobile');
		$data['phone'] = $this->input->post('phone');
		$data['house_no'] = $this->input->post('house_no');
		$data['height'] = $this->input->post('height');
		$data['is_work_out'] = $this->input->post('is_work_out');
		$data['work_address'] = $this->input->post('work_address');
		$data['remark'] = $this->input->post('remark');
		$data['industry'] = $this->input->post('industry');
		$data['identity_property'] = $this->input->post('identity_property');
		$data['special_tech'] = $this->input->post('special_tech');
		$data['health_condition'] = $this->input->post('health_condition');
		
		return $data;
	}
	
	public function view_exception($task_id)
	{
		$this->load->model ( 'excep_task_model' );
		$row = $this->excep_task_model->get ( $task_id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
	
		$this->load->model ( 'user_model' );
		$record_user_row = $this->user_model->get ( $row['record_user_id'] );
		$data['record_user_row'] = $record_user_row;
		
		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
	
		$this->load->model('handle_record_model');
		$handle_records = $this->handle_record_model->gets_by_task($task_id);
		$data['handle_records'] = $handle_records;
		
		$data['page_title'] = '查看民情';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/villager/view_exception.php', $data, true);
	
		echo $buffer;
	}
	public function set_families($id)
	{
		$this->load->model ( 'villager_model' );
		$row = $this->villager_model->get ( $id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
	
		$data['villagers'] = $this->villager_model->get_villagers(array('village_id'=>$row['village_id']));
		
		$data['page_title'] = '设置家庭关系';
		$data['row'] = $row;
		$buffer = $this->load->view('admin/villager/set_families.php', $data, true);
	
		echo $buffer;
	}
	
	public function save_families()
	{
		$data['villager_id'] = $this->input->post('villager_id');
		$data['house_holder_id'] = $this->input->post('house_holder_id');
		$data['father_id'] = $this->input->post('father_id');
		$data['mother_id'] = $this->input->post('mother_id');
		$data['spouse_id'] = $this->input->post('spouse_id');
		
		$this->load->model ( 'villager_model' );
		$resp = $this->villager_model->save_families($data);
	
		echo parent::write_json($resp);
	}
	
	public function assign_exception($id)
	{
		$this->load->model('excep_task_model');
		$row = $this->excep_task_model->get ( $id );
		if (! $row) {
			echo parent::write_json('数据不存在或被删除 ！');
			return;
		}
		
// 		if ($row['handle_status'] != 5) {
// 			echo parent::write_json('已经安排处理，不需要重复安排');
// 			return;
// 		}

		$this->load->model('handle_record_model');
		$handle_records = $this->handle_record_model->gets_by_task($id);
		
		$this->load->model ( 'user_model' );
		$data['users'] = $this->user_model->gets();

		$this->load->model('dict_model');
		$data['code_map'] = $this->dict_model->all_code_map();
	
		$data['page_title'] = '安排处理异常';
		$data['row'] = $row;
		$data['handle_records'] = $handle_records;
		$buffer = $this->load->view('admin/villager/assign_exception.php', $data, true);
	
		echo $buffer;
	}
	public function do_assign_exception() {
		$task_id = $this->input->post('task_id');
		$post_data['villager_id'] = $this->input->post('villager_id');
		$post_data['handle_type'] = $this->input->post('handle_type');
		if(!$post_data['handle_type']){
			echo parent::write_json('请选择处理方式');
			return;
		} 
		
		$this->load->model('villager_model');
		$this->load->model('excep_task_model');
		if('10' == $post_data['handle_type']){
			$handle_user_id = $this->input->post('read_handle_user_id');
			$deal_handle_remark = $this->input->post('read_handle_remark');
			if(!$handle_user_id){
				echo parent::write_json('请选择处理人');
				return;
			}
			$edit_back = $this->excep_task_model->assign_exception_task($task_id,
					$handle_user_id, $deal_handle_remark, 10);
		} else if('20' == $post_data['handle_type']){
			$handle_user_id = $this->input->post('deal_handle_user_id');
			$deal_handle_remark = $this->input->post('deal_handle_remark');
			if(!$handle_user_id){
				echo parent::write_json('请选择处理人');
				return;
			}
			$edit_back = $this->excep_task_model->assign_exception_task($task_id,
					$handle_user_id, $deal_handle_remark, 20);
		} else if('40' == $post_data['handle_type']){
			$post_data['exception_result'] = $this->input->post('suspend_reason');
			if(!$this->input->post('suspend_reason')){
				echo parent::write_json('请输入挂起原因');
				return;
			}
			$edit_back = $this->excep_task_model->suspend_exception_task($task_id, $this->input->post('suspend_reason'));
		} else {
			$post_data['exception_result'] = $this->input->post('exception_result');
			$edit_back = $this->excep_task_model->finish_exception_task($task_id, $post_data['exception_result']);
		}
	
		echo parent::write_json($edit_back);
	}

	public function suspend($id)
	{
		$this->load->model('villager_model');
		$edit_back = $this->villager_model->suspend($id);
	
		echo parent::write_json($edit_back);
	}
	public function import()
	{
		$buffer = $this->load->view('admin/villager/villager_import.php', array(), true);
	
		echo $buffer;
	}
	
	public function do_import()
	{
		$this->load->library ( array( 'PHPExcel','PHPExcel/IOFactory'));

		$uploadfile = $_FILES['excel'];//获取上传成功的Excel
		$objReader = IOFactory::createReader('Excel5');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($uploadfile['tmp_name']);//加载目标Excel
		$sheet = $objPHPExcel->getSheet(0);//读取第一个sheet
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumn = $sheet->getHighestColumn(); // 取得总列数
		$succ_result=$error_result=0;//设置导入成功和失败的总数为0
		
		$sheetData =$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);		

		$this->load->model('dict_model');
		$dict_map = $this->dict_model->all_code_map();
		$this->load->model('village_model');
		$villages = $this->village_model->village_map();
		
		$this->load->model('villager_model');
		
		$buffer = '';
		foreach ($sheetData as $key => $excel_row){
			if($key >= 7){
				$isOK  = $this->insert_from_excel($this->villager_model, $excel_row, $dict_map, $villages);
				if($isOK != 'OK'){
					$error_result ++;
					$buffer .= $isOK . '<br/>';
				} else {
					$succ_result ++;
				}
			}
		}
		
		echo parent::write_json(strlen($buffer)==0?'OK':$buffer);
	}
	
	private function insert_from_excel($model, $excel_data, $dict_map, $villages)
	{
		$data['villager_name'] = $excel_data['A'];
		$data['village_id'] = $this->getKeyByName($villages, $excel_data['B']);
		$data['identity_card'] = $excel_data['C'];
		$data['house_no'] = $excel_data['D'];
		
		$relation_ship = $excel_data ['E'];
		$relation_ship = str_replace ( "（", "(", $relation_ship );
		$relation_ship = str_replace ( "）", ")", $relation_ship );
		$relation_ship = str_replace ( "其它", "其他", $relation_ship );
		$relation_ship = str_replace ( "不明", "其他", $relation_ship );
		$data['relation_ship'] = $this->getKeyByName($dict_map['relation_ship'], $relation_ship);
		
		$data['sex'] = $this->getKeyByName($dict_map['sex'], $excel_data['F']);
		$data['birth_day'] = str_replace("/", "-", $excel_data['G']);
		$data['height'] = $excel_data['H'];
		$data['blood_type'] = $this->getKeyByName($dict_map['blood_type'], $excel_data['I']);
		$data['identity_property'] = $this->getKeyByName($dict_map['identity_property'], $excel_data['J']);
		$data['education_degree'] = $this->getKeyByName($dict_map['education_degree'], $excel_data['K']);
		$data['mobile'] = $excel_data['L'];
		$data['phone'] = $excel_data['M'];
		$data['industry'] = $this->getKeyByName($dict_map['industry'], $excel_data['N']);
		$data['special_tech'] = $excel_data['O'];
		$data['health_condition'] = $this->getKeyByName($dict_map['health_condition'], $excel_data['P']);
		$data['address'] = $excel_data['Q'];
		$data['work_address'] = $excel_data['R'];
		$data['is_work_out'] = $this->getKeyByName($dict_map['yes_or_no'], $excel_data['S']);
		$data['is_work_out'] = $data['is_work_out']?$data['is_work_out']:'0';

		$data['economy_code'] = $this->getKeyByName($dict_map['economy_code'], $excel_data['T']);
		$data['harmony_code'] = $this->getKeyByName($dict_map['harmony_code'], $excel_data['U']);
		$data['health_code'] = $this->getKeyByName($dict_map['health_code'], $excel_data['V']);
		$data['remark'] = $excel_data['W'];
		
		if(!$data['villager_name'] ){
			return '姓名不能为空';
		}
		if(!$data['house_no'] ){
			return '门牌号不能为空';
		}
		if(!$data['village_id'] ){
			return $data['villager_name'].',未知村庄：'.$excel_data['B'];
		}
		if(!$data['sex'] ){
			return $data['villager_name'].'性别不能为空';
		}
		if(!$data['relation_ship'] ){
			return $data['villager_name'].'与户主关系不正确:'.$relation_ship;
		}
		
		return $model->edit('insert', $data);
	}
	
	private function getKeyByName($dict, $name){
		$data = array_flip($dict);
		return isset($data[$name])?$data[$name]:'';
	}
	
	public function party_step($villager_id)
	{
		$this->load->model ( 'villager_model' );
		$row = $this->villager_model->get ( $villager_id );
		
		$data = $this->default_page_data('party_step');
	
		$this->load->model('party_step_model');
		$data['steps'] = $this->party_step_model->villager_steps($villager_id);
	
		$data['row'] = $row;
		$this->load->view('admin/villager/party_step.php', $data);
	}
	
	public function do_join_party()
	{
		$login_user_id = $this->session->userdata('user_id');
		$villager_id = $this->input->post('villager_id');
		$party_index = $this->input->post('party_index');
	
		$this->load->model('party_step_model');
		$is_ok = $this->party_step_model->insert_or_update($villager_id, $party_index, $login_user_id);
	
		echo parent::write_json($is_ok);
	}
	public function sub_handle_task($task_id) {
		$this->load->model('excep_task_model');
		$row = $this->excep_task_model->get ( $task_id );
		if (! $row) {
			echo parent::write_json ( '数据不存在或被删除 ！' );
			return;
		}
		
		if($row['handle_status'] != 20){
			echo parent::write_json('该异常不是等待处理状态，当前不能处理');
			return;
		}

		$login_user_id = $this->session->userdata('user_id');
		if($row['receive_user_id'] != $login_user_id){
			echo parent::write_json('你不是相应处理人，当前不能处理');
			return;
		}
		
		$this->load->model('handle_record_model');
		$handle_records = $this->handle_record_model->gets_by_task($task_id);
		
		$data['page_title'] = '处理异常';
		$data['row'] = $row;
		$data['handle_records'] = $handle_records;
		$buffer = $this->load->view('admin/villager/sub_handle_task.php', $data, true);
		
		echo $buffer;
	}
	public function do_sub_handle_task() {
		$task_id = $this->input->post('task_id');
		$exception_process = $this->input->post('exception_process');
		$exception_result = $this->input->post('exception_result');
		$exception_suggest = $this->input->post('exception_suggest');
		if(!$exception_result){
			echo parent::write_json('请输入处理结果');
			return;
		}
	
		$this->load->model('excep_task_model');
		$edit_back = $this->excep_task_model->sub_handle_task($task_id,
					$exception_process, $exception_result, $exception_suggest);
	
		echo parent::write_json($edit_back);
	}
	
	public function delete($villager_ids)
	{
		if(!$villager_ids){
			echo parent::write_json('请选择村民信息！');
			return ;
		}
		$villager_id_array = explode(',', $villager_ids);
		$buffer = '';
		foreach ($villager_id_array as $key => $id){
			$isOK = $this->delete_one($id);
			if('OK' != $isOK){
				$buffer .= $isOK.'<br/>';
			}
		}
	
		if($isOK){
			echo parent::write_json($buffer);
		} else {
			echo parent::write_json('OK');
		}
	}
	private function delete_one($villager_id)
	{
		if(!$villager_id){
			return '请选择村民信息！';
		}
		
		if(!isset($this->villager_model)){
			$this->load->model('villager_model');
		}
		$isOK = $this->villager_model->delete($villager_id, $this->login_user_id);
		return $isOK;
	}

	public function download_template()
	{
		$type = $this->input->get('type');
		if($type == 'villager'){
			$data = file_get_contents('images/upload/villager_upload_template.xls');
			$share_name = '公民信息登记模板';
			$ext = ".xls";
		} else if($type == 'user'){
			$data = file_get_contents('images/upload/user_upload_template.xls');
			$share_name = '用户导入模板';
			$ext = ".xls";
		} else {
			echo '<script>alert("不支持的类型:'.$type.'");window.close();</script>';
			return;
		}

		
		$this->load->helper('download');
		force_download($share_name.$ext, $data);
	}

}

/* End of file villager.php */
/* Location: ./application/controllers/admin/villager.php */