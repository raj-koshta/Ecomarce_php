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

    public function get_parent_categories(){
        $qry = $this->db->where(['status'=> '1', 'parent_id' => ''])->get('tbl_category');
   
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

    public function get_category_name($id = null){
        $qry = $this->db->where('category_id', $id)->get('tbl_category');
        if($qry->num_rows()){
            return $qry->row()->category_name;
        } else {
            return false;
        }
    }

    public function get_product_details($slug = null){
        $qry = $this->db->where(['slug' => $slug, 'status'=>'1'])->get('tbl_product');
   
        if($qry->num_rows()){
            return $qry->row();
        } else {
            return false;
        }
    }

    public function check_subcategory($category_id){
        $qry = $this->db->where(['status'=> '1', 'parent_id' => $category_id])->get('tbl_category');
   
        if($qry->num_rows()){
            return true;
        } else {
            return false;
        }
    }

    public function get_sub_categories($category_id){
        $qry = $this->db->where(['status'=> '1', 'parent_id' => $category_id])->get('tbl_category');
   
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }
}