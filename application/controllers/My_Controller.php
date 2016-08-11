<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
    }

    public function _remap($method, $param = []) {
        if (isset($this->session->username)) {
            call_user_func_array(array($this, $method), $param);
        } else {
            redirect(site_url('login/index'));
        }
    }
}
