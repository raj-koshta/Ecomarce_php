<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartModel extends CI_Model
{

    public function get_userid(){
        if(!empty($this->session->userdata('login_id'))){
            return $this->session->userdata('login_id');
        } else {
            return $this->session->userdata('user_id');
        }
    }

    public function get_cart()
    {
        $qry = $this->db->where('user_id',$this->get_userid())->get('tbl_cart');
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }


    public function delete($product_id){
        $qry = $this->db->where(['product_id'=>$product_id,'user_id'=>$this->get_userid()])->delete('tbl_cart');

        if($qry){
            return true;
        } else {
            return false;
        }
    }

    public function update($post){
        $count = count($post['up_qty']);
        for($i = 0; $i < $count; $i++){
            $qry = $this->db->where(['product_id'=>$post['up_product_id'][$i],'user_id'=>$this->get_userid()])->update('tbl_cart',['product_qty'=>$post['up_qty'][$i]]);
        }
        return true;
    }

    public function add($post)
    {

        $exist = $this->db->where(['product_id'=>$post['product_id'], 'user_id'=>$this->get_userid()])->get('tbl_cart'); 
        if($exist->num_rows()){
            return false;
        } else {
            $qry = $this->db->select('product_name,selling_price,mrp,slug,product_main_image')->where('product_id', $post['product_id'])->get('tbl_product');
    
            if ($qry->num_rows()) {
                $prod = $qry->row();
                echo "<pre>";
                $data['cart_id'] = mt_rand(11111, 99999);
                $data['user_id'] = $this->get_userid();
                $data['product_id'] = $post['product_id'];
                $data['product_name'] = $prod->product_name;
                $data['product_qty'] = $post['product_qty'];
                $data['selling_price'] = $prod->selling_price;
                $data['mrp'] = $prod->mrp;
                $data['slug'] = $prod->slug;
                $data['product_image'] = $prod->product_main_image;
                $data['added_on'] = date('d M, Y');
                $this->db->insert('tbl_cart',$data);
                return true;
            } else {
                return false;
            }
        }


    }

    public function get_charge_by_pincode($pincode = null){
        $qry = $this->db->where(['pincode' => $pincode, 'status' => 1])->get('tbl_pincode');

        if($qry->num_rows()){
            return $qry->row()->delivery_charge;
        } else {
            return false;
        }
    }

    public function total(){
        $qry = $this->db->select('sum(selling_price * product_qty) as total_price')->where('user_id',$this->get_userid())->get('tbl_cart');
        if($qry->num_rows()){
            $total = $qry->row()->total_price;
            if($total > 999){
                return array('subtotal'=>$total,'grandtotal'=>$total,'delivery'=>0);
            } else {
                return array('subtotal'=>$total,'grandtotal'=>$total+40,'delivery'=> 40);
            }
        } else {
            return false;
        }
    }

    public function delete_all(){
        $qry = $this->db->where(['user_id'=>$this->get_userid()])->delete('tbl_cart');

        if($qry){
            return true;
        } else {
            return false;
        }
    }

}