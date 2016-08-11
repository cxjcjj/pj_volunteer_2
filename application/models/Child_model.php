<?php

class Child_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_student_by_class_info($entrance, $class, $sex, $name) {
        return $this->db->select('*')->from($this->db->dbprefix('child'))
            ->where('entrance', $entrance)
            ->where('class', $class)
            ->where('sex', $sex)
            ->where('name', $name)
            ->get()->result();
    }

    public function getEntranceByGrade($grade) {
        $year = (int)date('Y');
        $month = (int)date('m');

        if ($month <= 7) {
            return $year-$grade;
        } else {
            return $year+1-$grade;
        }
    }

    public function get_all() {
        $query =  $this->db->select('*')->from($this->db->dbprefix('child'))->get()->result();
        foreach ($query as $student) {
            $grade = $this->getEntranceByGrade($student->entrance);
            $student->grade = $grade;
            $students[] = $student;
        }
        return $students;
    }

    public function get_by_id($id) {
        return $this->db->select('*')->from($this->db->dbprefix('child'))->where('child_id', $id)->get()->result();
    }

    public function insert_info($data) {
        return $this->db->insert($this->db->dbprefix('child'), $data);
    }

    public function update_info($data) {
        $where = "child_id = {$data['child_id']}";
        return $this->db->update($this->db->dbprefix('child'), $data, $where);
    }

    public function delete($id) {
        return $this->db->delete($this->db->dbprefix('child'), ['child_id' => $id]);
    }

}
