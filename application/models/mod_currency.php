<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_currency extends CI_Model {
    
    var $table = "tm_currency";
    var $pk = "currency_id";
    
    public function get_all_entries() {

        $result = $this->db
                ->select('*')
                ->where('status', 1)
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
                ->where('status', 1)
                ->order_by('benefit_id')
                ->get($this->table, $num, $offset)
                ->result();
		#echo $this->db->last_query();
        return $result;
        
    }

	function getAllCurrency()
    {
 
        $query = $this->db->query('SELECT currency_id,currency_name FROM '.$this->table.' where status=1 order by my_order asc');
     
        return $query->result();
		
		

    }

}