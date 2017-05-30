<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_running_text extends CI_Model {
    
    var $table = "running_text";
    var $pk = "idrunningtext";

    public function __construct() {
        parent::__construct();
    }

    public function get_all_entries() {
        $result = $this->db
                ->select('*')
                ->order_by("priority", "asc")
                ->get($this->table)
                ->result();
        return $result;
    }
    
    public function get_content_by_id($id) {
        $row = $this->db
                ->select('content, file_name, file_path')
                ->where($this->pk, $id)
                ->get($this->table)->row();
        return $row;
    }
}