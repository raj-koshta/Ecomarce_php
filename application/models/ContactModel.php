<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContactModel extends CI_Model
{
    public function add($post){
        return $this->db->insert('tbl_inquiry', $post);
    }
}