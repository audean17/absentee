<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_user_group extends CI_Model {
    
    var $table = "tm_user_groups";
    var $pk = "group_id";
    
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
                ->where('publish', 1)
                ->order_by('priority')
                ->get($this->table, $num, $offset)
                ->result();
		#echo $this->db->last_query();
        return $result;
        
    }

	function getAllGroups()
    {
 
        $query = $this->db->query('SELECT group_id,group_name FROM '.$this->table.' where status=1 order by group_id asc');
        return $query->result();

    }
}