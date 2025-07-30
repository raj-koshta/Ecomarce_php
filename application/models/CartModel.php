<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartModel extends CI_Model
{

    public function add($post)
    {

        $qry = $this->db->select('product_name,selling_price,mrp,slug,product_main_image')->where('product_id', $post['product_id'])->get('tbl_product');

        if ($qry->num_rows()) {
            $prod = $qry->row();

            $data['cart_id'] = mt_rand(11111, 99999);
            $data['user_id'] = mt_rand(11111, 99999);
            $data['product_id'] = $post['product_id'];
            $data['product_name'] = $prod->product_name;
            $data['product_qty'] = $post['product_qty'];
            $data['selling_price'] = $prod->selling_price;
            $data['mrp'] = $prod->mrp;
            $data['slug'] = $prod->slug;
            $data['product_image'] = $prod->product_main_image;
            $data['added_on'] = date('d M, Y');
        } else {
            return false;
        }


    }

}