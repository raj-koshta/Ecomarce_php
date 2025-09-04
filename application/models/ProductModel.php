<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    public function get_all_products()
    {
        $qry = $this->db->get('tbl_product');

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function add_Product($post)
    {
        $post['added_on'] = date('d M, Y');
        $post['slug'] = $this->slug($post['product_name']);
        $qry = $this->db->insert('tbl_product', $post);
        if ($qry) {
            $this->session->unset_userdata('product_id');
            return true;
        }

        return false;
    }

    public function update_product($post)
    {
        $qry = $this->db->where('product_id', $post['product_id'])->update('tbl_product', $post);
        if ($qry) {
            return true;
        } else {
            return false;
        }
    }


    public function fetch_category_id($slug)
    {
        $qry = $this->db->select('category_id')->where('slug', $slug)->get('tbl_category');
        if ($qry->num_rows()) {
            return $qry->row()->category_id;
        } else {
            return false;
        }
    }

    public function fetch_product_category_id($slug)
    {
        $qry = $this->db
            ->select("CASE 
                    WHEN sub_category IS NULL OR sub_category = '' OR sub_category = '0' 
                    THEN category 
                    ELSE sub_category 
                  END as category_id", false)
            ->where('slug', $slug)
            ->get('tbl_product');

        if ($qry->num_rows()) {
            return $qry->row()->category_id;
        } else {
            return false;
        }

    }

    public function fetch_product($category_id, $sort = null)
    {
        $this->db->where(['status' => 1]);
        $this->db->like(['category' => $category_id]);
        $this->db->or_like(['sub_category' => $category_id]);

        // ✅ Apply sorting
        if ($sort === 'lowtohigh') {
            $this->db->order_by('selling_price', 'ASC');
        } elseif ($sort === 'hightolow') {
            $this->db->order_by('selling_price', 'DESC');
        } elseif ($sort === 'newadded') {
            $this->db->order_by('id', 'DESC'); // assuming 'id' is auto-increment (newest first)
        }

        $qry = $this->db->get('tbl_product');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function fetch_product_by_price($category_id, $min_price, $max_price, $is_sub_cate)
    {
        $this->db->where('status', 1);

        $this->db->where('selling_price >=', $min_price);
        $this->db->where('selling_price <=', $max_price);

        if ($is_sub_cate == 'true') {
            $this->db->where('sub_category', $category_id);
        } else {
            $this->db->where('category', $category_id);
        }

        $qry = $this->db->get('tbl_product');

        if ($qry->num_rows() > 0) {
            return $qry->result();
        } else {
            return false;
        }
    }


    public function get_product_by_id($product_id)
    {
        $qry = $this->db->where('product_id', $product_id)->get('tbl_product');

        if ($qry->num_rows()) {
            return $qry->row();
        } else {
            return false;
        }
    }

    public function get_product_main_image($product_id)
    {
        $qry = $this->db->where('product_id', $product_id)->get('tbl_product');

        if ($qry->num_rows()) {
            return $qry->row()->product_main_image;
        } else {
            return false;
        }
    }

    public function delete_product($product_id)
    {
        return $this->db->where('product_id', $product_id)->delete('tbl_product');
    }

    public function slug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return $slug;
    }



}