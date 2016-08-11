<?php

class Volunteer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_info($data) {
        return $this->db->insert($this->db->dbprefix('volunteer_info'), $data);
    }

    public function get_all() {
        return $this->db->select('*')->get($this->db->dbprefix('volunteer_info'))->result();
    }

    public function get_by_parent_id($id) {
        return $this->db->select('*')->from($this->db->dbprefix('volunteer_info'))->where('parent_id', $id)->get()->result();
    }

    public function update_info($data) {
        $where = "parent_id = {$data['parent_id']}";
        return $this->db->update($this->db->dbprefix('volunteer_info'), $data, $where);
    }
}
