<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends CI_Model {
    public function get_banners(){
        $qry = $this->db->where('status', '1')->order_by('id', 'desc')->get('tbl_banner');
   
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_categories(){
        $qry = $this->db->where('status', '1')->get('tbl_category');
   
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_products(){
        $qry = $this->db->where('status', '1')->get('tbl_product');
   
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }
}