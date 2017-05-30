<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_benefit extends CI_Model {
    
    var $table = "tm_benefits";
    var $pk = "benefit_id";
    
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

	function getAllBenefit()
    {
 
//        $query = $this->db->query('SELECT benefit_id,benefit_name,benefit_type_name FROM '.$this->table.' a inner join tm_benefits_type b on a.benefit_type_id=b.benefit_type_id where a.status=1 order by benefit_type_name,benefit_id asc');
        $query = $this->db->query("select * from ( select b.benefit_type_name,a.benefit_name,a.benefit_id from tm_benefits a inner join tm_benefits_type b on a.benefit_type_id=b.benefit_type_id union select benefit_type_name, '' as benefit_name, '' as benefit_id from tm_benefits_type
) a order by benefit_type_name,benefit_id");
        return $query->result();
		
		

    }

	function getAllBenefitForBussnis($projectId)
    {
 
//        $query = $this->db->query('SELECT benefit_id,benefit_name,benefit_type_name FROM '.$this->table.' a inner join tm_benefits_type b on a.benefit_type_id=b.benefit_type_id where a.status=1 order by benefit_type_name,benefit_id asc');
        $query = $this->db->query("select * from ( select b.benefit_type_name,a.benefit_name,a.benefit_id from tm_benefits a inner join tm_benefits_type b on a.benefit_type_id=b.benefit_type_id where a.status=1 and a.benefit_id not in (select benefit_id from tp_bussnis_benefit where project_id='".$projectId."') union select benefit_type_name, '' as benefit_name, '' as benefit_id from tm_benefits_type
) a order by benefit_type_name,benefit_id");
        return $query->result();
		
		

    }	
}