<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_news_category extends CI_Model {
    
    var $table = "news_category";
    var $pk = "idnewscategory";
    
    public function get_a_field($id, $field) {

        $row = $this->db
                ->select($field)
                ->where($this->pk, $id)
                ->get($this->table)
                ->row();
        return $row->$field;
        
    }
    
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
    
    public function get_entries_by_limit($limit) {
        
        $result = $this->db
                ->select('*')
                ->order_by('priority')
                ->limit($limit)
                ->get($this->table);

        return $result->result();
        
    }

}