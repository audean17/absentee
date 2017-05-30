<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Start extends CI_Controller {
	var $base;
	var $css;
	
    public function __construct() {
        parent::__construct();
//        $this->base=$this->confg->item('base_url');
//		$this->css=$this->confg->item('faucss');
		
    }
    
    public function Start(){
        $this->base='';
		$this->css='faustyle.css';
			
    }

  
    public function hello($name){
		$data['css']="faustyle.css";
		$data['base']=base_url();
		$data['mytitle']="Welcom to this site";
		$data['mytext']="Hello, $name, now we are getting dynamic";
		$this->load->view('testview',$data);
			
    }
}