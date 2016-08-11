<?php

class School_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->select('*')->order_by('entrance', 'DESC')->get($this->db->dbprefix('school'))->result();
    }

    public function getById($id){
        return $this->db->select('*')->from($this->db->dbprefix('school'))->where('id',$id)->get()->result();
    }

    public function getByEntrance($entrance){
        return $this->db->select('*')->from($this->db->dbprefix('school'))->where('entrance',$entrance)->get()->result();
    }

    public function insert_info($data){
    	return $this->db->insert($this->db->dbprefix('school'), $data);
    }

    public function update_info($data){
    	return $this->db->update($this->db->dbprefix('school'), $data, array('entrance' => $data['entrance']));
    }

    public function delete($school_id){
    	return $this->db->delete($this->db->dbprefix('school'), array('id' => $school_id ));
    }
}
