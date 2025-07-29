<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
    public function add_pincode($post)
    {
        $qry = $this->db->insert('tbl_pincode', $post);
        if ($qry) {
            return true;
        }

        return false;
    }

    public function add_banner($post)
    {
        $post['added_on'] = date('d M, Y');
        $post['bann_id'] = mt_rand(11111,99999);
        $qry = $this->db->insert('tbl_banner', $post);
        if ($qry) {
            return true;
        }

        return false;
    }

    public function get_all_categories() {
        $qry = $this->db->where(['status'=> 1, 'parent_id'=>''])->get('tbl_category');
        if($qry->num_rows()){
            return $qry->result();
        }
    }

}