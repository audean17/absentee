<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_hit_counter extends CI_Model {

    var $table = "hit_counter";
    
    public function __construct() {
        parent::__construct();
    }

    public function insert() {
        $data = array(
            'ip' => $_SERVER['REMOTE_ADDR'], // menangkap ip pengunjung
            'location' => $_SERVER['PHP_SELF'],
            'timestamp' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->table, $data);
    }
    
    public function count(){
        $table = $this->table;
        $result = $this->db
                ->query("select distinct ip from $table")
                ->num_rows();
        return $result;
    }
}