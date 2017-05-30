<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_product extends CI_Model {
    
    var $table = "product";
    var $pk = "idproduct";
    
    public function get_all_entries() {

        $result = $this->db
                ->select('*')
                ->where('publish', 1)
                ->get($this->table)
                ->result();
        return $result;
        
    }
    
    public function get_an_entry($id) {

        $row = $this->db
                ->select('*')
                ->where($this->pk, $id)
                ->get($this->table)
                ->row();
        return $row;
        
    }
    
    public function get_entries($num, $offset=0) {
        
        $result = $this->db
                ->select('*')
                ->where('publish', 1)
                ->order_by('priority')
                ->get($this->table, $num, $offset)
                ->result();
		#echo $this->db->last_query();
        return $result;
        
    }

}