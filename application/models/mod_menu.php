<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_menu extends CI_Model {
    
    var $table = "menu";
    var $pk = "idmenu";
    
    public function get_all_entries() {

        $row = $this->db
                ->select('*')
                ->get($this->table)
                ->result();
        return $row;
        
    }
    
    public function get_an_entry($id) {

        $row = $this->db
                ->select('*')
                ->where($this->pk, $id)
                ->get($this->table)
                ->row();
        return $row;
        
    }
    
    public function profil(){
        $result = $this->db
                ->select('idmenu, menu')
                ->where('idparent', 2)
                ->get($this->table)
                ->result();
        return $result;
    }
    public function footer_profil(){
        $result = $this->db
                ->select('idmenu, menu')
                ->where('idparent', 2)
				->where('active','1')
                ->get($this->table)
                ->result();
        return $result;
    }	

}