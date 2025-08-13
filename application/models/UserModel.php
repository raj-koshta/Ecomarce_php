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
}