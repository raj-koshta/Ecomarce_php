<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
    public function add_category($post)
    {
        $post['added_on'] = date('d M, Y');
        $post['category_id'] = mt_rand(11111, 99999);
        $post['slug'] = $this->slug($post['category_name']);
        $qry = $this->db->insert('tbl_category', $post);
        if ($qry) {
            return true;
        }

        return false;
    }

    public function get_all_categories()
    {
        $qry = $this->db->where(['status' => 1, 'parent_id' => ''])->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->result();
        }
    }

    public function get_subcategories($category_id)
    {
        $qry = $this->db->where(['status' => 1, 'parent_id' => $category_id])->get('tbl_category');

        $output = '<option value="" selected>Select Sub Category</option>';

        if ($qry->num_rows()) {
            foreach ($qry->result() as $sub_cat) {
                $output .= '<option value="' . $sub_cat->category_id . '">' . $sub_cat->category_name . '</option>';
            }
        } else {
            $output = '<option value="" selected>No Sub Category is available</option>';
        }

        return $output; // RETURN instead of echo
    }


    public function slug($category_name)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));
        return $slug;
    }

}