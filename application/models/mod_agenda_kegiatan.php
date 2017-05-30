<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_agenda_kegiatan extends CI_Model {
    
    var $table = "agenda_kegiatan";
    var $pk = "idagendakegiatan";
    
    public function get_all_entries() {

        $result = $this->db
                ->select('*')
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
                ->order_by('date', desc)
                ->get($this->table, $num, $offset)
                ->result();

        return $result;
        
    }

}