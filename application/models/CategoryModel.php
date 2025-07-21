<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
    public function add_category($port){
        $post['added_on'] = date('d M, Y');
        $post['category_id'] = mt_rand(11111,99999);
        $qry = $this->db->insert('tbl_category', $post);
        if($qry){
            return true;
        }

        return false;
    }
 
}