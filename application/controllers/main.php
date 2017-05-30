<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Main extends CI_Controller {

  // private $table = "tm_users";
  // // Primary key table
  // private $primary = "user_id";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index() {
        $data['contentPage'] = "dashboard";
        $data['mainMenu'] = "dashboard";
        $data['jsChart'] = 1;

//        $this->load->view('mainPageVw', $data);
		 redirect('headline');
    }

    public function do_logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

//     function change_password() {
//
//         $data['password'] = 'login/password';
//         $this->load->view('incPasswordVw', $data);
// }

  }
