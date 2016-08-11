<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'My_Controller.php';

class User extends My_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
    }

	public function index($data = null) {
        $data['users'] = $this->user_model->get_all();
		$data['title'] = '后台登录人员管理';
		$data['url'] = 'user_list';
		echo $this->load->view('user_list', $data);
    }

    public function add() {
        $data['title'] = '管理员新增';
        $data['url'] = 'user_add';
        $this->load->view('user_add', $data);
    }

    public function store() {
        $input = $this->input->post();

        $this->form_validation->set_rules('useraccount', '用户名', 'required', ['required' => '请填写%s']);
        $this->form_validation->set_rules('username', '姓名', 'required', ['required' => '请填写%s']);
        $this->form_validation->set_rules('phone', '电话', 'integer', ['integer' => '请规范填写%s']);

        if ($this->form_validation->run() == false) {
            $data['message'] = validation_errors();
            $data['class_num']->class_num = $input['class_num'];
            $data['user']->username = $input['username'];
            $data['user']->useraccount = $input['useraccount'];
            $data['user']->email = $input['email'];
            $data['user']->phone = $input['phone'];
            if ($input['model'] == 'edit') {
                $data['title'] = '修改用户';
                $data['url'] = 'user_edit';
                return $this->load->view('user_edit', $data);
            } else {
                $data['title'] = '新增用户';
                $data['url'] = 'user_add';
                return $this->load->view('user_add', $data);
            }
        }

        unset($input['model']);

		$user = $this->user_model->get_by_account($input['useraccount']);

        if(count($user) == 0){
            $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
			$result = $this->user_model->insert_info($input);
		} else {
			$result = $this->user_model->update_info($input);
        }

        $data['message'] = $result ? '成功' : '失败';
        return $this->index($data);
    }

    public function edit($account) {
        $data['user'] = $this->user_model->get_by_account($account)[0];
        $data['title'] = '管理员修改';
        $data['url'] = 'user_edit';
        $this->load->view('user_edit', $data);
    }

    public function changepw($account) {
        $data['account'] = $account;
        $data['title'] = '修改密码';
        $data['url'] = 'user_edit_password';
        $this->load->view('user_edit_password', $data);
    }

    public function store_pw() {
        $input = $this->input->post();

        $this->form_validation->set_rules('password', '密码', 'required', ['required' => '请填写%s']);
        $this->form_validation->set_rules('passconf', '确认密码', 'required|matches[password]', ['required' => '请填写%s', 'matches' => '两次密码不一致']);

        if ($this->form_validation->run() == false) {
            $data['message'] = validation_errors();
            $data['title'] = '修改密码';
            $data['url'] = 'user_edit_password';
            return $this->load->view('user_edit_password', $data);
        }
        $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
        unset($input['passconf']);
        $result = $this->user_model->update_info($input);
        $data['message'] = $result ? '成功' : '失败';
        $data['users'] = $this->user_model->get_all();
        $data['title'] = '后台登录人员管理';
        echo $this->load->view('user_list',$data);
    }

	public function delete($id){
		 $this->user_model->delete($id);
         $data['users'] = $this->user_model->get_all();
        $data['title'] = '后台登录人员管理';
        $data['url'] = 'user_list';
        echo $this->load->view('user_list', $data);
	}
}
