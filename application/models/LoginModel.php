<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{

    public function login($post)
    {

        $email = $post['email'];
        $password = $post['password'];

        $qry = $this->db->where(['email' => $email, 'status' => 1])->get('tbl_users');

        if ($qry->num_rows()) {
            $arr = $qry->row();
            $db_pass = $arr->password;
            $user_id = $arr->user_id;
            $username = $arr->username;
            if (password_verify($password, $db_pass)) {
                
                $this->db->where('user_id', $this->session->userdata('user_id'))->update('tbl_cart', ['user_id' => $user_id]);
                $this->db->where('user_id', $this->session->userdata('user_id'))->update('tbl_wishlist',['user_id'=> $user_id]);
                // setting user object

                $this->session->set_userdata('login_id', $user_id);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('username', $username);

                $this->db->select('user_id, email, username, image, status');
                $this->db->from('tbl_users');
                $this->db->where('email', $email);
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $user = $query->row(); // Get single row as object

                    // Store whole object in session
                    $this->session->set_userdata('user_obj', $user);
                }
                return true;
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
