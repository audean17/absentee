<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_situs_terkait extends CI_Model {
    
    var $table = "situs_terkait";
    var $pk = "idsitusterkait";
    
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
    
    public function get_entries_by_limit($limit) {
        
        $result = $this->db
                ->select('*')
                ->where('publish', 1)
                ->order_by('priority')
                ->limit($limit)
                ->get($this->table);

        return $result->result();
        
    }
    
    public function get_sidebar(){
        $table = $this->table;
        $result = $this->db
                ->select("
                    *,
                    (
                        SELECT 
                            path 
                        FROM 
                            images 
                        JOIN 
                            images_news
                                ON images_news.idimage = images.idimage 
                        WHERE 
                            idnews = s.idnews 
                        LIMIT 1
                    ) as path,
                    (
                        SELECT 
                            image_name 
                        FROM 
                            images 
                        JOIN 
                            images_news
                                ON images_news.idimage = images.idimage 
                        WHERE 
                            idnews = s.idnews 
                        LIMIT 1
                    ) as image_name
                    ")
                ->where('publish', 1)
                ->limit(3)
                ->order_by('hit', 'asc')
                ->get("$table s")
                ->result();
        return $result;
    }

}