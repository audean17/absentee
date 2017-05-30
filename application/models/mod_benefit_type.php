<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_benefit_type extends CI_Model {
    
    var $table = "tm_benefits_type";
    var $pk = "benefit_type_id";
    
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
                ->order_by('benefit_type_id')
                ->get($this->table, $num, $offset)
                ->result();
		#echo $this->db->last_query();
        return $result;
        
    }

	function getAllBenefitType()
    {
 
        $query = $this->db->query('SELECT benefit_type_id,benefit_type_name FROM '.$this->table.' where status=1 order by benefit_type_id asc');
        return $query->result();

    }
}