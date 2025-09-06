<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewModel extends CI_Model
{
    public function add($review_data)
    {
        $result = $this->db->insert('tbl_reviews', $review_data);

        if ($result && $this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_reviews($product_id)
    {
        $qry = $this->db->select('tbl_reviews.*, tbl_users.*')
            ->from('tbl_reviews')
            ->join('tbl_users', 'tbl_users.user_id = tbl_reviews.user_id') // or 'inner'
            ->where('tbl_reviews.product_id', $product_id)
            ->get();


        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_reviews_count($product_id)
    {
        return $this->db->where('product_id', $product_id)->count_all_results('tbl_reviews');

    }

    public function get_review_stats($product_id)
    {
        $this->db->select('rating, COUNT(*) as count');
        $this->db->from('tbl_reviews');
        $this->db->where('product_id', $product_id);
        $this->db->group_by('rating');
        $query = $this->db->get();

        $result = $query->result_array();

        $stats = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];
        $total = 0;

        foreach ($result as $row) {
            $stats[$row['rating']] = $row['count'];
            $total += $row['count'];
        }

        return ['stats' => $stats, 'total' => $total];
    }


}