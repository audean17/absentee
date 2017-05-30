<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_headline extends CI_Model {
    
    var $table = "headlines";
    
    public function get_all_entries(){
        $result = $this->db
                ->select('*')
                ->where('publish', 1)
                ->order_by('priority')
                ->get($this->table)
                ->result();
        return $result;
    }
	
	public function get_by_id($id)
	{
		        $row = $this->db
                ->select('*')
				->where('idheadline',$id)
                ->where('publish', 1)				
                ->get($this->table)
                ->row();
        return $row;
	}

}