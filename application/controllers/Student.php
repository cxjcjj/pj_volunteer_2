<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'My_Controller.php';

class Student extends My_Controller {

    public function __construct () {
        parent::__construct();
        $this->load->model('child_model');
        $this->load->model('school_model');
    }

    public function index ($data = null) {
        $data['students'] = $this->child_model->get_all();
        $data['title'] = '学生列表';
        $data['url'] = 'student_list';
		echo $this->load->view('student_list', $data);
    }

    public function add () {
        $school = $this->school_model->get_all();

        $data['school'] = [];
        for ($i = 0; $i < 6 && isset($school[$i]); $i++) {
            $data['school'][$school[$i]->entrance] = $school[$i]->class_num;
        }
        $data['school_json'] = json_encode($data['school']);

        $data['title'] = '新增学生';
        $data['url'] = 'student_edit';
        $this->load->view('student_edit', $data);
    }

    public function store () {
        $this->form_validation->set_rules('child_id', '班级学生编号', 'required|integer|max_length[3]', ['required' => '%s为必填项', 'integer' => '%s必须符合规范', 'max_length' => '%s不能超过三位']);
        $this->form_validation->set_rules('name', '学生姓名', 'required', ['required' => '%s为必填项']);
        $this->form_validation->set_rules('birthday', '学生生日', 'required', ['required' => '%s为必填项']);

        $input = $this->input->post();

        if ($this->form_validation->run() == false) {
            $school = $this->school_model->get_all();

            $data['school'] = [];
            for ($i = 0; $i < 6 && isset($school[$i]); $i++) {
                $data['school'][$school[$i]->entrance] = $school[$i]->class_num;
            }
            $data['school_json'] = json_encode($data['school']);
            $data['student']->child_id = sprintf("%s%02d%03d1", $input['entrance'], $input['class'], $input['child_id']);
            $data['student']->name = $input['name'];
            $data['student']->sex = $input['sex'];
            $data['student']->entrance = $input['entrance'];
            $data['student']->class = $input['class'];
            $data['student']->birthday = $input['birthday'];
            $data['message'] = validation_errors();
            $data['title'] = '新增学生';
            $data['url'] = 'student_edit';
            return $this->load->view('student_edit', $data);
        }
        $input['child_id'] = sprintf("%s%02d%03d1", $input['entrance'], $input['class'], $input['child_id']);

        $student = $this->child_model->get_by_id($input['child_id']);

        if (count($student) == 0) {
            $result = $this->child_model->insert_info($input);
        } else {
            $result = $this->child_model->update_info($input);
        }

        if ($result) {
            return $this->index(['message' => '成功']);
        } else {
            return $this->index(['message' => '失败']);
        }
    }

    public function edit ($id) {
        $school = $this->school_model->get_all();

        $data['school'] = [];
        for ($i = 0; $i < 6 && isset($school[$i]); $i++) {
            $data['school'][$school[$i]->entrance] = $school[$i]->class_num;
        }
        $data['school_json'] = json_encode($data['school']);
        $data['student'] = $this->child_model->get_by_id($id)[0];
        $data['title'] = '修改学生';
        $data['url'] = 'student_edit';
        $this->load->view('student_edit', $data);
    }

    public function delete ($id) {
        $this->child_model->delete($id);
        // var_dump($id);
        $data['students'] = $this->child_model->get_all();
        $data['title'] = '学生列表';
        $this->load->view('student_list', $data);
    }
}
