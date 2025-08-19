<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CheckoutModel extends CI_Model
{

    public function insert_address($data)
    {
        $this->db->insert('tbl_address', $data);
        return $this->db->insert_id();
    }

    public function insert_order($data)
    {
        $this->db->insert('tbl_orders', $data);
        return $this->db->insert_id();
    }

    public function insert_order_product($data)
    {
        $this->db->insert('tbl_order_products', $data);
    }
}
