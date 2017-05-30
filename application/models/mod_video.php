<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_video extends CI_Model {
    
    var $table = "videos_gallery";
    var $pk = "idvideogallery";
    
    public function get_album_name($id) {

        $row = $this->db
                ->select('album_name')
                ->where("idvideoalbum", $id)
                ->get('video_albums')
                ->row();
        return $row->album_name;
        
    }
    
    public function get_total_entries($id) {

        $num_rows = $this->db
                ->select('*')
                ->where("idvideoalbum", $id)
                ->get($this->table)
                ->num_rows();
        return $num_rows;
        
    }
    
    public function get_entries($num, $offset, $idvideoalbum){
        $table = $this->table;
        $result = $this->db
                ->select("*")
                ->order_by("priority",'asc')
                ->where("idvideoalbum", $idvideoalbum)
                ->get("$table s", $num, $offset)
                ->result();
        return $result;
    }
    
    public function get_an_entry($id){
        $table = $this->table;
        $row = $this->db
                ->select("*")
                ->where($this->pk, $id)
                ->get($table)
                ->row();
        return $row;
    }

}