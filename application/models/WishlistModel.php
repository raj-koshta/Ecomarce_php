<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WishlistModel extends CI_Model
{

    public function get_userid()
    {
        if (!empty($this->session->userdata('login_id'))) {
            return $this->session->userdata('login_id');
        } else {
            return $this->session->userdata('user_id');
        }
    }

    public function add($product_id)
    {
        $exist = $this->db->where(['product_id' => $product_id, 'user_id' => $this->get_userid()])->get('tbl_wishlist');
        if ($exist->num_rows()) {
            return false;
        } else {
            $qry = $this->db->select('product_name,selling_price,slug,product_main_image')->where('product_id', $product_id)->get('tbl_product');

            if ($qry->num_rows()) {
                $prod = $qry->row();
                echo "<pre>";
                $data['user_id'] = $this->get_userid();
                $data['wishlist_id'] = mt_rand(11111,99999);
                $data['product_id'] = $product_id;
                $data['product_name'] = $prod->product_name;
                $data['product_price'] = $prod->selling_price;
                $data['slug'] = $prod->slug;
                $data['product_image'] = $prod->product_main_image;
                $data['added_on'] = date('d M, Y');
                $this->db->insert('tbl_wishlist', $data);
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_wishlists(){
        $qry = $this->db->where('user_id',$this->get_userid())->get('tbl_wishlist');
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function delete($wishlist_id){
        $qry = $this->db->where(['wishlist_id'=>$wishlist_id,'user_id'=>$this->get_userid()])->delete('tbl_wishlist');

        if($qry){
            return true;
        } else {
            return false;
        }
    }
}