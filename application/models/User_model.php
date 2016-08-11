<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->select('*')->get($this->db->dbprefix('user'))->result();
    }

    public function get_by_account($account){
        return $this->db->select('*')->from($this->db->dbprefix('user'))->where('useraccount',$account)->get()->result();
    }

    public function insert_info($data){
    	return $this->db->insert($this->db->dbprefix('user'), $data);
    }

    public function update_info($data){
    	return $this->db->update($this->db->dbprefix('user'), $data, array('useraccount' => $data['useraccount']));
    }

    public function delete($useraccount){
    	return $this->db->delete($this->db->dbprefix('user'), array('useraccount' => $useraccount));
    }

    public function check_password($account, $password) {
        $user = $this->get_by_account($account);
        if (count($user) == 0) {
            return false;
        } else {
            return password_verify($password, $user[0]->password);
        }
    }

    public function set_session($account) {
        $user = $this->get_by_account($account)[0];
        $this->session->set_userdata([
            'useraccount' => $account,
            'username' => $user->username
        ]);
    }
}
