<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View_mod extends CI_Model {
    
    public function content($id) {

        $row['cp'] = $this->db
                ->select('*')
                ->where('idmenu', $id)
                ->get('menu')
                ->row();
        return $row;
        
    }

    public function product($id) {

        $row = $this->db
                ->select('*')
                ->where('idproduct', $id)
                ->get('product')
                ->row();
        return $row;
        
    }

    public function news($id) {
        
        $row = $this->db
                ->select('*')
                ->join('news_category c', 'c.idnewscategory = n.idnewscategory')
                ->where('n.idnews', $id)
                ->get('news n')
                ->row();

        return $row;
        
    }
    
    public function images_news($id) {
        
        $row = $this->db->select('*')
                ->from('images_news n')
                ->join('images i', 'n.idimage = i.idimage')
                ->join('news b', 'n.idnews = b.idnews')
                ->where('b.idnews', $id)
                ->get('news');

        return $row->row();
        
    }
    
    

    public function display_populer($row, $webTitle = "", $webContent = "", $contentTitle = "") {
        $row['webTitle'] = $webTitle;
        $row['webContent'] = $webContent;
        $row['contentTitle'] = $contentTitle;
        $row['berita'] = $this->db->select('*')->where('publish', 1)->order_by('hit', 'asc')->get('news');

        $row = array_merge($row, $this->sidebar());

        return $row;
    }

    public function display_category($row, $webTitle = "", $webContent = "", $contentTitle = "", $id) {
        $row['webTitle'] = $webTitle;
        $row['webContent'] = $webContent;
        $row['contentTitle'] = $contentTitle;
        $where = array(
            'publish' => 1,
            'idnewscategory' => $id
        );
        $row['berita'] = $this->db->select('*')->where($where)->order_by('hit', 'asc')->get('news');

        $row = array_merge($row, $this->sidebar());

        return $row;
    }
    
    public function display_photo($row, $webTitle = "", $webContent = "", $contentTitle = "", $id) {
        $row['webTitle'] = $webTitle;
        $row['webContent'] = $webContent;
        $row['contentTitle'] = $contentTitle;
        
        $where = array(
            'idimagealbum' => $id
        );

        $row = array_merge($row, $this->sidebar());
        
        $row['photos'] = $this->db->select('*')->where($where)->order_by('priority', 'asc')->get('images_gallery');

        return $row;
    }
    
    public function display_video($row, $webTitle = "", $webContent = "", $contentTitle = "", $id) {
        $row['webTitle'] = $webTitle;
        $row['webContent'] = $webContent;
        $row['contentTitle'] = $contentTitle;
        
        $where = array(
            'idvideoalbum' => $id
        );

        $row = array_merge($row, $this->sidebar());
        
        $row['load_video_player'] = 1;
        
        $row['videos'] = $this->db->select('*')->where($where)->order_by('priority', 'asc')->get('videos_gallery');
        //echo $this->db->last_query();
        
        return $row;
    }

    public function getAnItem($tablename, $item, $pk, $pk_val) {
        $where = array(
            $pk => $pk_val
        );
        $row = $this->db->select($item)->where($where)->get($tablename)->row();
        return $row;
    }

}