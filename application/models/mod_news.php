<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_news extends CI_Model {
    
    var $table = "news";
    var $pk = "idnews";
    
    public function hit($id){
        $row = $this->db->select('hit')->where($this->pk, $id)->get($this->table)->row();
        $hit = $row->hit;
        $hit++;
        $this->db->where($this->pk, $id)->update($this->table, array('hit' => $hit));
    }
    
    public function get_an_entry($id) {

        $row = $this->db
                ->select('*')
                ->where($this->pk, $id)
                ->get($this->table)
                ->row();
        return $row;
        
    }
    
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
    
    public function get_pg_entries($num, $offset) {

        $row = $this->db
                ->select('*')
                ->where('publish', 1)
                ->get($this->table, $num, $offset)
                ->result();
        return $row;
        
    }
    
    public function get_total_entries() {

        $num_rows = $this->db
                ->select('*')
                ->where('publish', 1)
                ->get($this->table)
                ->num_rows();
        return $num_rows;
        
    }
    
    public function get_entries_category($num, $offset, $id) {

        $where = array(
            'idnewscategory' => $id,
            'publish' => 1
        );
        $row = $this->db
                ->select('*')
                ->where($where)
                ->get($this->table, $num, $offset)
                ->result();
        return $row;
        
    }
    
    public function get_total_entries_category($id) {

        $where = array(
            'idnewscategory' => $id,
            'publish' => 1
        );
        $num_rows = $this->db
                ->select('*')
                ->where($where)
                ->get($this->table)
                ->num_rows();
        return $num_rows;
        
    }
    
    public function get_sidebar_popular($num = 0, $offset = 0){
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
                ->order_by('hit', 'desc')
                ->order_by('created_date', 'desc')
                ->get("$table s", $num, $offset)
                ->result();
        //$this->db->last_query();
        return $result;
    }
    
    public function get_popular($num, $offset){
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
                ->order_by('hit', 'desc')
                ->order_by('created_date', 'desc')
                ->get("$table s", $num, $offset)
                ->result();
        //$this->db->last_query();
        return $result;
    }

}