<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{
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

    public function slug($string){
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/','-', $string)));
        return $slug;
    }

    // public function get_all_categories() {
    //     $qry = $this->db->where(['status'=> 1, 'parent_id'=>''])->get('tbl_category');
    //     if($qry->num_rows()){
    //         return $qry->result();
    //     }
    // }

    // public function get_subcategories($category_id) {
    //     $qry = $this->db->where(['status'=> 1, 'parent_id'=>$category_id])->get('tbl_category');
    //     if($qry->num_rows()){
    //         $output = ' <option value="" selected>Select Sub Category</option>';
    //         foreach($qry->result() as $sub_cat){
    //             $output.='<option value="'.$sub_cat->category_id.'">'.$sub_cat->category_name.'</option>';
    //         }
    //         echo $output;
    //     }
    // }

}