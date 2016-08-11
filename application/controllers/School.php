<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'My_Controller.php';

class School extends My_Controller{

	public function __construct(){
		parent::__construct();
        $this->load->model('school_model');
        $this->load->model('child_model');
	}

	public function index($data = null){
        $data['school'] = $this->school_model->get_all();
        foreach ($data['school'] as $key => $school) {
            $data['school'][$key]->grade = $this->child_model->getEntranceByGrade($school->entrance);
        }
		$data['title'] = '班级列表';
		$data['url'] = 'school_list';
		echo $this->load->view('school_list',$data);
	}

	public function edit($id){
		$data['school'] = $this->school_model->getById($id)[0];
		$data['title'] = '修改班级';
		$data['url'] = 'school_edit';
		$this->load->view('school_edit',$data);
	}

	public function delete($id){
		$this->school_model->delete($id);
        $data['school'] = $this->school_model->get_all();
        foreach ($data['school'] as $key => $school) {
            $data['school'][$key]->grade = $this->child_model->getEntranceByGrade($school->entrance);
        }
        $data['title'] = '班级列表';
        $data['url'] = 'school_list';
        echo $this->load->view('school_list',$data);
	}

	public function add(){
		$data['title'] = '新增班级';
		$data['url'] = 'school_edit';
		$this->load->view('school_edit',$data);
	}

	public function store(){
        $input = $this->input->post();

        $this->form_validation->set_rules('entrance', '入学年份', 'required|integer', ['required' => '请填写%s', 'integer' => '%s必须符合规范']);
        $this->form_validation->set_rules('class_num', '班级数', 'required|integer', ['required' => '请填写%s', 'integer' => '%s必须符合规范']);

        if ($this->form_validation->run() == false) {
            $data['message'] = validation_errors();
            $data['school']->entrance = $input['entrance'];
            $data['class_num']->class_num = $input['class_num'];
            $data['title'] = '新增班级';
            $data['url'] = 'school_edit';
            return $this->load->view('school_edit', $data);
        }

		$school = $this->school_model->getByEntrance($input['entrance']);

		if(count($school) == 0){
			$result = $this->school_model->insert_info($input);
		} else {
			$result = $this->school_model->update_info($input);
        }
        if ($result) {
            return $this->index(['message' => '成功']);
        } else {
            return $this->index(['message' => '失败']);
        }
	}
}
