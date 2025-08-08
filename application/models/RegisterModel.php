<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegisterModel extends CI_Model
{

    public function register($post){

        $data['user_id'] = mt_rand(11111,99999);
        $data['username'] = $post['username'];
        $data['email'] = $post['email'];
        
        $data['password'] = password_hash( $post['password'],PASSWORD_BCRYPT);
        $data['status'] = 1;
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $data['added_on'] = date('Y-m-d');

        $result = $this->db->insert('tbl_users',$data);

        if($result){
            if ($this->db->affected_rows() > 0){
                return true;
            }
        } else {
            return false;
        }
    }
}
