<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function get_all_orders()
    {
        $qry = $this->db->select('tbl_orders.*,tbl_users.user_id, tbl_users.username, tbl_order_status.*')
            ->from('tbl_orders')
            ->join('tbl_users', 'tbl_orders.user_id = tbl_users.user_id')
            ->join('tbl_order_status', 'tbl_orders.order_status = tbl_order_status.order_status_id ')
            ->get();

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_all_order_status()
    {
        $qry = $this->db->get('tbl_order_status');

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_order_products($order_id)
    {
        $qry = $this->db->where('order_id', $order_id)->get('tbl_order_products');
        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_all_inquiries()
    {
        $qry = $this->db->order_by('added_on', 'ASC')->get('tbl_inquiry');

        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }

    }
}