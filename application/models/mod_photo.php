<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_photo extends CI_Model {
    
    var $table = "images_gallery";
    var $pk = "idimagegallery";
    
    public function get_album_name($id) {

        $row = $this->db
                ->select('album_name')
                ->where("idimagealbum", $id)
                ->get('image_albums')
                ->row();
        return $row->album_name;
        
    }
    
    public function get_total_entries($id) {

        $num_rows = $this->db
                ->select('*')
                ->where("idimagealbum", $id)
                ->get($this->table)
                ->num_rows();
        return $num_rows;
        
    }
    
    public function get_entries($num, $offset, $id){
        $table = $this->table;
        $result = $this->db
                ->select("*")
                ->order_by("priority",'asc')
                ->where("idimagealbum", $id)
                ->get("$table s", $num, $offset)
                ->result();
        return $result;
    }

}