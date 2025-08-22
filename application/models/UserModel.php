<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function update_profile_picture($userId, $fileName)
    {
        $qry = $this->db->where('user_id', $userId)->update('tbl_users', ['image' => $fileName]);

        if ($qry) {

            // Get the stored session object
            $user = $this->session->userdata('user_obj');

            // Change the property
            $user->image = $fileName;

            // Store it back in the session
            $this->session->set_userdata('user_obj', $user);

            return true;
        } else {
            return false;
        }
    }

    public function update_info($userId,$post){
        $qry = $this->db->where('user_id', $userId)->update('tbl_users',['phone'=>$post['phone'],'bio'=>$post['bio'],'gender'=>$post['gender']]);

        if($qry){
            $user_obj = $this->session->userdata('user_obj');

            $user_obj->phone = $post['phone'];
            $user_obj->bio = $post['bio'];
            $user_obj->gender = $post['gender'];

            $this->session->set_userdata('user_obj', $user_obj);
            return true;
        } else {
            return false;
        }
    }

    public function get_billing_addresses(){
        $qry = $this->db->where(['user_id'=>$this->session->userdata['user_id']])->get('tbl_address');

        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_orders(){
        $qry = $this->db->where('user_id',$this->session->userdata('user_id'))->get('tbl_orders');
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_order_details($order_id){
        $qry = $this->db->where('id',$order_id)->get('tbl_orders');
        if($qry->num_rows()){
            return $qry->row();
        } else {
            return false;
        }
    }

    public function get_order_products($order_id){
        $qry = $this->db->where('order_id',$order_id)->get('tbl_order_products');
        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }
}