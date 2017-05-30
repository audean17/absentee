<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_header extends CI_Model {
    
    var $table = "header";
    
    public function get_all_entries(){
        $result = $this->db
                ->select('*')
                ->where('publish', 1)
                ->order_by('priority')
                ->get($this->table)
                ->result();
        return $result;
    }
	
    public function get_header(){
        $result = $this->db->query("SELECT CONCAT(image_path,image) as images FROM header WHERE publish = '1'");
        return $result->row();

    }	
}