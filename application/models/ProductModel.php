<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    public function get_all_products(){
        $qry = $this->db->get('tbl_product');

        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function add_Product($post)
    {
        $post['added_on'] = date('d M, Y');
        $post['slug'] = $this->slug($post['product_name']);
        $qry = $this->db->insert('tbl_product', $post);
        if ($qry) {
            $this->session->unset_userdata('product_id');
            return true;
        }

        return false;
    }


    public function fetch_category_id($slug)
    {
        $qry = $this->db->select('category_id')->where('slug', $slug)->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->row()->category_id;
        } else {
            return false;
        }
    }

    public function fetch_product($category_id)
    {
        $this->db->where(['status'=>1]);
        $this->db->like(['category'=>$category_id]);
        $this->db->or_like(['sub_category'=>$category_id]);
        $qry = $this->db->get('tbl_product');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_product_by_id($product_id){
        $qry = $this->db->where('product_id', $product_id)->get('tbl_product');

        if($qry->num_rows()){
            return $qry->row();
        } else {
            return false;
        }
    }

    public function slug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return $slug;
    }

}