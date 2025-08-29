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

    public function get_all_pincode()
    {
        $qry = $this->db->get('tbl_pincode');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_pincode_by_id($id)
    {
        $qry = $this->db->where('id', $id)->get('tbl_pincode');
        if ($qry->num_rows()) {
            return $qry->row();
        } else {
            return false;
        }
    }


    public function get_all_banners()
    {
        $qry = $this->db->get('tbl_banner');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_Banner_by_id($bann_id)
    {
        $qry = $this->db->where('bann_id', $bann_id)->get('tbl_banner');
        if ($qry->num_rows()) {
            return $qry->row();
        } else {
            return false;
        }
    }

    public function add_banner($post)
    {
        $post['added_on'] = date('d M, Y');
        $post['bann_id'] = mt_rand(11111, 99999);
        $qry = $this->db->insert('tbl_banner', $post);
        if ($qry) {
            return true;
        }

        return false;
    }

    public function delete_banner($bann_id)
    {
        return $this->db->where('bann_id', $bann_id)->delete('tbl_banner');
    }


    public function update_pincode($post)
    {
        $id = $post['id'];
        unset($post['id']); // remove id from update fields

        $qry = $this->db->where('id', $id)->update('tbl_pincode', $post);
        if ($qry && $this->db->affected_rows() > 0) {
            return true;   // update success
        } else {
            return false;  // no rows updated or failed
        }
    }

    public function update_banner($post)
    {
        $qry = $this->db->where('bann_id', $post['bann_id'])->update('tbl_banner', $post);
        if ($qry && $this->db->affected_rows() > 0) {
            return true;   // update success
        } else {
            return false;  // no rows updated or failed
        }
    }

    public function get_all_categories()
    {
        $qry = $this->db->where(['status' => 1, 'parent_id' => ''])->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

}