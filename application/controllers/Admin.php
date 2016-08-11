<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
    {
        if (isset($this->session->pattern) && $this->session->pattern == true) {
            return $this->load->view('admin_main');
        } else {
            return $this->load->view('login');
        }
	}
}
