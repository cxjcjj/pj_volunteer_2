<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fill extends CI_Controller {
    protected $relation = ['2' => '父亲', '3' => '母亲', '4' => '其他'];
    protected $abilitys = ['ability_literary', 'ability_science', 'ability_paint', 'ability_dance', 'ability_music',
        'ability_language', 'ability_handwork', 'ability_sport', 'ability_photograph', 'ability_cook'];
    protected $services = ['service_security', 'service_tour', 'service_photograph', 'service_library',
        'service_culture', 'service_communication', 'service_activity', 'service_maintenance', 'service_network'];
    protected $tutors = ['tutor_sinology', 'tutor_art', 'tutor_science', 'tutor_environment', 'tutor_security', 'tutor_handmade',
        'tutor_psychology', 'tutor_revolution', 'tutor_bodybuilding'];
    protected $lectures = ['lecture_education', 'lecture_law', 'lecture_diet'];

    public function __construct() {
        parent::__construct();
        $this->load->model('school_model');
        $this->load->model('child_model');
        $this->load->model('parent_model');
        $this->load->model('volunteer_model');
    }

	public function index($data = null) {
        $school = $this->school_model->get_all();

        $data['school'] = [];
        for ($i = 0; $i < 6 && isset($school[$i]); $i++) {
            $data['school'][$school[$i]->entrance] = $school[$i]->class_num;
        }
        $data['school_json'] = json_encode($data['school']);
        $data['page_id'] = 1;
		$this->load->view('fill', $data);
    }

    public function check() {
        $this->form_validation->set_rules('child_name', '学生姓名', 'required', ['required' => '请填写%s']);
        $this->form_validation->set_rules('birthday', '学生生日', 'required', ['required' => '请填写%s']);

        $input = $this->input->post();

        if ($this->form_validation->run() == false) {
            return $this->index(['message' => validation_errors(), 'origin' => $input]);
        }
        //TODO:优化
        $student_info = $this->child_model->get_student_by_class_info($input['entrance'], $input['class'], $input['child_sex'], $input['child_name']);
        //不存在这个学生
        if (count($student_info) != 1) {
            return $this->index(['message' => '不存在该学生，请重新填写', 'origin' => $input]);
        } else {
            $student = $student_info[0];
        }

        //生日输入错误
        if ($student->birthday != $input['birthday']) {
            return $this->index(['message' => '生日填写错误，请检查', 'origin' => $input]);
        }

        $data['hidden']['child_id'] = $student->child_id;
        $data['hidden']['child_name'] = $student->name;
        $data['hidden']['parent_id'] = substr($student->child_id, 0, 9) . $input['relationship'];
        $data['hidden']['relation'] = $input['relationship'];
        $data['hidden']['relation_name'] = $this->parent_model->get_relation_name($input['relationship'], $input['relationship_name']);

        $relation = json_decode($student->relationship, true);
        if (isset($relation[$input['relationship']])) {
            $data['parent'] = $this->parent_model->get_by_id($data['hidden']['parent_id'])[0];

            if ($data['parent']->is_volunteer == 1 || $data['parent']->is_organ == 1) {
                $data['volunteer'] = $this->volunteer_model->get_by_parent_id($data['hidden']['parent_id'])[0];
            }
        }
        //为了和输入错误时的返回一致
        $data['parent']->ability_other_name = $data['parent']->ability_others;
        $data['volunteer']->service_other_name = $data['volunteer']->service_others;
        $data['volunteer']->tutor_other_name = $data['volunteer']->tutor_others;
        $data['volunteer']->lecture_other_name = $data['volunteer']->lecture_others;
        $data['volunteer']->week_other_content = $data['volunteer']->week_other;

        $data['page_id'] = 2;
        $this->load->view('fill', $data);
    }

    public function basic_info() {


        $input = $this->input->post();
        $this->form_validation->set_rules('parent_name', '家长姓名', 'required', ['required' => '请填写%s']);
        $this->form_validation->set_rules('phone', '联系电话', 'required|integer', ['required' => '请填写%s', 'integer' => '%s必须符合规范']);

        if ($this->form_validation->run() == false) {

            $data['hidden']['child_id'] = $input['child_id'];
            $data['hidden']['child_name'] = $input['child_name'];
            $data['hidden']['parent_id'] = $input['parent_id'];
            $data['hidden']['relation'] = $input['relation'];
            $data['hidden']['relation_name'] = $input['relation_name'];

            $parent = new stdclass();
            $volunteer = new stdclass();
            if (isset($input['parent_name'])) {
                $parent->name = $input['parent_name'];
            }
            if (isset($input['parent_sex'])) {
                $parent->sex = $input['parent_sex'];
            }
            if (isset($input['workspace'])) {
                $parent->workspace = $input['workspace'];
            }
            if (isset($input['phone'])) {
                $parent->phone = $input['phone'];
            }

            foreach ($this->abilitys as $key => $ability) {
                if (isset($input[$ability])) {
                    $parent->{$ability} = $input[$ability];
                }
            }
            if (isset($input['ability_other_name'])) {
                $parent->ability_other_name = $input['ability_other_name'];
            }
            if (isset($input['is_volunteer'])) {
                $parent->is_volunteer = $input['is_volunteer'];
            }
            if (isset($input['is_organ'])) {
                $parent->is_organ = $input['is_organ'];
            }

            foreach ($this->services as $key => $service) {
                if (isset($input[$service])) {
                    $volunteer->{$service} = $input[$service];
                }
            }
            if (isset($input['service_other_name'])) {
                $volunteer->service_other_name = $input['service_other_name'];
            }

            foreach ($this->tutors as $key => $tutor) {
                if (isset($input[$tutor])) {
                    $volunteer->{$tutor} = $input[$tutor];
                }
            }
            if (isset($input['tutor_other_name'])) {
                $volunteer->tutor_other_name = $input['tutor_other_name'];
            }
            foreach ($this->lectures as $key => $lecture) {
                if (isset($input[$lecture])) {
                    $volunteer->{$lecture} = $input[$lecture];
                }
            }

            if (isset($input['lecture_other_name'])) {
                $volunteer->lecture_other_name = $input['lecture_other_name'];
            }
            $volunteer->timerange = '';
            for ($i = 1; $i <= 21; $i++) {
                $volunteer->timerange .= isset($input['timerange_' . $i]) ? '1' : '0';
            }


            if (isset($input['week_other_content'])) {
                $volunteer->week_other_content = $input['week_other_content'];
            }
            if (isset($input['slogan'])) {
                $volunteer->slogan = $input['slogan'];
            }
            if (isset($input['suggest1'])) {
                $parent->suggest1 = $input['suggest1'];
            }
            if (isset($input['suggest2'])) {
                $parent->suggest2 = $input['suggest2'];
            }
            $data['parent'] = $parent;
            $data['volunteer'] = $volunteer;

            $data['page_id'] = 2;
            $data['message'] = validation_errors();
            return $this->load->view('fill', $data);
        }

        //parent表信息存储
        $parent['parent_id'] = substr($input['child_id'], 0, 9) . $input['relation'];
        $parent['child_id'] = $input['child_id'];
        $parent['name'] = $input['parent_name'];
        $parent['sex'] = $input['parent_sex'];
        $parent['relation'] = $input['relation'];
        $parent['workspace'] = $input['workspace'];
        $parent['phone'] = $input['phone'];
        $parent['is_volunteer'] = $input['is_volunteer'];
        $parent['is_organ'] = $input['is_organ'];
        $parent['suggest1'] = $input['suggest1'];
        $parent['suggest2'] = $input['suggest2'];

        foreach ($this->abilitys as $key => $ability) {
            $parent[$ability] = (isset($input[$ability])) ? 1 : 0;
        }

        $parent['ability_others'] = isset($input['ability_other_name']) ? $input['ability_other_name'] : null;

        if (count($this->parent_model->get_by_id($parent['parent_id'])) == 0) {
            $this->parent_model->insert_info($parent);
            $child = $this->child_model->get_by_id($parent['child_id'])[0];
            $relation = json_decode($child->relationship, true);
            $relation[$input['relation']] = $input['relation_name'];
            $this->child_model->update_info(['relationship' => json_encode($relation), 'child_id' => $input['child_id']]);
        } else {
            $this->parent_model->update_info($parent);
        }


        if ($parent['is_volunteer'] || $parent['is_organ']) {
            //volunteer表信息存储
            $volunteer['parent_id'] = $parent['parent_id'];
            foreach ($this->services as $key => $service) {
                $volunteer[$service] = (isset($input[$service])) ? 1 : 0;
            }
            $volunteer['service_others'] = isset($input['service_other_name']) ? $input['service_other_name'] : null;

            foreach ($this->tutors as $key => $tutor) {
                $volunteer[$tutor] = (isset($input[$tutor])) ? 1 : 0;
            }
            $volunteer['tutor_others'] = isset($input['tutor_other_name']) ? $input['tutor_other_name'] : null;

            foreach ($this->lectures as $key => $lecture) {
                $volunteer[$lecture] = (isset($input[$lecture])) ? 1 : 0;
            }
            $volunteer['lecture_others'] = isset($input['lecture_other_name']) ? $input['lecture_other_name'] : null;

            $volunteer['timerange'] = '';
            for ($i = 1; $i <= 21; $i++) {
                $volunteer['timerange'] .= isset($input['timerange_' . $i]) ? '1' : '0';
            }


            $volunteer['slogan'] = $input['slogan'];

            $volunteer['week_other'] = isset($input['week_other_content']) ? $input['week_other_content'] : null;

            if (count($this->volunteer_model->get_by_parent_id($parent['parent_id'])) == 0) {
                $this->volunteer_model->insert_info($volunteer);
            } else {
                $this->volunteer_model->update_info($volunteer);
            }
        }

        $this->load->view('thanks.php');
    }
}
