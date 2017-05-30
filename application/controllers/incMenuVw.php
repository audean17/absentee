<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  Design by 	: SAY
  email		: simon.ardhi@gmail.com
  Phone Number: 085311990078/081317755078
 */

class Menu extends CI_Controller {

    // Nama table
    private $table = "menu";
    // Primary key table
    private $primary = "idmenu";
    // Field-field data yang ada di database
    private $fields = array(
        'idmenu', 
        'menu', 
        'menu_title', 
        'link_type', 
        'content', 
        'file_name', 
        'logo', 
        'image', 
        'priority', 
        'level', 
        'leaf', 
        'idparent', 
        'active');
    // Link controller
    private $linkController = "incMenuVw";
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('iduser')) {
            redirect('login');
        }
    }

    public function index() {
        $datatable_fields = array(
                    'ID', 
                    'Menu',
                    'Parent',
                    'Prioritas',
                    'Lihat',
                    'Edit',
                    'Hapus'
                    );
        $data['contentPage'] = "table";
        $data['contentTitle'] = "Menu";
        $data['mainMenu'] = "halamanutama";
        $data['subMenu'] = "menu";
        $data['linkDatatable'] = site_url($this->linkController.'/lists');
        $data['linkAdd'] = site_url($this->linkController.'/add');
        $data['datatableFields'] = $datatable_fields;
        $this->load->view('mainPageVw', $data);
    }
  
}