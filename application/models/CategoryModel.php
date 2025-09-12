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


    public function update_category($post)
    {



        $qry = $this->db->where('category_id', $post['category_id'])->update('tbl_category', $post);

        if ($qry) {
            // ==================================
            // 🔹  Product Status Update
            // ==================================
            $status = $post['status'];

            // Get current category details
            $category = $this->CategoryModel->get_category_by_id($post['category_id']);

            if ($category) {
                if (!empty($category->parent_id) && $category->parent_id != 0) {
                    // Case 1: Subcategory → update products under this subcategory only
                    $this->db->where('sub_category', $post['category_id'])
                        ->update('tbl_product', ['status' => $status]);
                } else {
                    // Case 2: Parent category
                    // Update products under parent
                    $this->db->where('category', $post['category_id'])
                        ->update('tbl_product', ['status' => $status]);

                    // Update subcategories + their products
                    $subcategories = $this->db->where('parent_id', $post['category_id'])
                        ->get('tbl_category')
                        ->result();

                    if (!empty($subcategories)) {
                        foreach ($subcategories as $subcat) {
                            // Update subcategory status
                            $this->db->where('category_id', $subcat->category_id)
                                ->update('tbl_category', ['status' => $status]);

                            // Update products under this subcategory
                            $this->db->where('sub_category', $subcat->category_id)
                                ->update('tbl_product', ['status' => $status]);
                        }
                    }
                }
            }
            // ==================================
            return true; // update successful
        } else {
            return false; // update failed
        }
    }

    public function delete_category($category_id)
    {
        return $this->db->where('category_id', $category_id)->delete('tbl_category');
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

    public function get_all_category()
    {
        $qry = $this->db->order_by('parent_id', 'desc')->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
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

    public function get_category_by_id($category_id)
    {
        $qry = $this->db->where('category_id', $category_id)->get('tbl_category');

        if ($qry->num_rows()) {
            return $qry->row();
        } else {
            return false;
        }
    }

    public function get_category_image($category_id)
    {
        $qry = $this->db->where('category_id', $category_id)->get('tbl_category');

        if ($qry->num_rows()) {
            return $qry->row()->image;
        } else {
            return false;
        }
    }

    public function is_sub_category($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->group_start()
            ->where('parent_id', '')
            ->or_where('parent_id IS NULL', null, false)
            ->group_end();
        $qry = $this->db->get('tbl_category');

        if ($qry->num_rows() > 0) {
            return false;   // parent_id is NULL or ''
        } else {
            return true;  // parent exists
        }

    }

    public function get_categories_count(){
        return $this->db->count_all_results('tbl_category');
    }

    public function get_active_categories_count(){
        return $this->db->where('status',1)->count_all_results('tbl_category');
    }

    public function get_inactive_categories_count(){
        return $this->db->where('status',0)->count_all_results('tbl_category');
    }

    public function get_active_categories(){
        $qry = $this->db->where('status',1)->order_by('parent_id', 'desc')->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_inactive_categories(){
        $qry = $this->db->where('status',0)->order_by('parent_id', 'desc')->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function slug($category_name)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));
        return $slug;
    }

}