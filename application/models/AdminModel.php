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

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }

    }

    public function get_orders_count()
    {
        return $this->db->count_all_results('tbl_orders');
    }

    public function get_pending_orders_count()
    {
        return $this->db->where_not_in('order_status', [5, 6])->count_all_results('tbl_orders');
    }

    public function get_completed_orders_count()
    {
        return $this->db->where('order_status', 6)->count_all_results('tbl_orders');
    }

    public function get_cancelled_orders_count()
    {
        return $this->db->where('order_status', 5)->count_all_results('tbl_orders');
    }

    public function get_today_orders_count()
    {
        return $this->db->where('order_date', date('Y-m-d'))->count_all_results('tbl_orders');
    }

    public function get_pending_orders()
    {
        $qry = $this->db->select('tbl_orders.*,tbl_users.user_id, tbl_users.username, tbl_order_status.*')
            ->from('tbl_orders')
            ->join('tbl_users', 'tbl_orders.user_id = tbl_users.user_id')
            ->join('tbl_order_status', 'tbl_orders.order_status = tbl_order_status.order_status_id ')
            ->where_not_in('order_status', [5, 6])
            ->get();

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_completed_orders()
    {
        $qry = $this->db->select('tbl_orders.*,tbl_users.user_id, tbl_users.username, tbl_order_status.*')
            ->from('tbl_orders')
            ->join('tbl_users', 'tbl_orders.user_id = tbl_users.user_id')
            ->join('tbl_order_status', 'tbl_orders.order_status = tbl_order_status.order_status_id ')
            ->where('order_status', 6)
            ->get();

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_cancelled_orders()
    {
        $qry = $this->db->select('tbl_orders.*,tbl_users.user_id, tbl_users.username, tbl_order_status.*')
            ->from('tbl_orders')
            ->join('tbl_users', 'tbl_orders.user_id = tbl_users.user_id')
            ->join('tbl_order_status', 'tbl_orders.order_status = tbl_order_status.order_status_id ')
            ->where('order_status', 5)
            ->get();

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_today_orders()
    {
        $qry = $this->db->select('tbl_orders.*,tbl_users.user_id, tbl_users.username, tbl_order_status.*')
            ->from('tbl_orders')
            ->join('tbl_users', 'tbl_orders.user_id = tbl_users.user_id')
            ->join('tbl_order_status', 'tbl_orders.order_status = tbl_order_status.order_status_id ')
            ->where('order_date', date('Y-m-d'))
            ->get();

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_inquiries_count()
    {
        return $this->db->count_all_results('tbl_inquiry');
    }

    public function get_open_inquiries_count()
    {
        return $this->db->where('status', 1)->count_all_results('tbl_inquiry');
    }

    public function get_closed_inquiries_count()
    {
        return $this->db->where('status', 0)->count_all_results('tbl_inquiry');
    }

    public function get_open_inquiries()
    {
        $qry = $this->db->where('status', 1)->get('tbl_inquiry');

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_closed_inquiries()
    {
        $qry = $this->db->where('status', 0)->get('tbl_inquiry');

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_account_details()
    {
        $qry = $this->db->where(['admin_id' => $this->session->userdata('admin_login_id'), 'status' => 1])->get('tbl_admins');

        if ($qry->num_rows()) {
            return $qry->row();
        } else {
            return false;
        }
    }

    public function get_all_roles()
    {
        $qry = $this->db->get('tbl_roles');

        if ($qry->num_rows()) {
            return $qry->result();
        } else {
            return false;
        }
    }

    public function update_admin_info($post)
    {
        $this->db->where('admin_id', $post['admin_id']);
        $this->db->update('tbl_admins', [
            'name' => $post['name'],
            'gender' => $post['gender'],
            'phone' => $post['phone']
        ]);

        return ($this->db->affected_rows() > 0);
    }

    public function get_admins(){
        $qry = $this->db->get('tbl_admins');

        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }

    public function get_subadmins(){
        $qry = $this->db->where('role_id !=',1)->get('tbl_admins');

        if($qry->num_rows()){
            return $qry->result();
        } else {
            return false;
        }
    }
    
    public function check_is_active($email){
        $qry = $this->db->where('email',$email)->get('tbl_admins');

        if($qry->num_rows()){
            return $qry->row()->status == 1 ? true : false;
        } else {
            return false;
        }
    }

    public function add($data){
        $qry = $this->db->insert('tbl_admins',$data);

        if($qry){
            $admin_id = $this->db->insert_id();

            $this->db->insert('tbl_role_access_controls',['admin_id' =>$admin_id,'added_on' => date('Y-m-d')]);

            return true;

        } else {
            return false;
        }

    }

    public function update_role_access_controls($admin_id, $data){
        $qry = $this->db->where('admin_id', $admin_id)->update('tbl_role_access_controls', $data);

        return $qry;
    }

    public function get_access_details($admin_id){
        $qry = $this->db->where('admin_id', $admin_id)->get('tbl_role_access_controls');

        if($qry->num_rows()){
            return $qry->row();
        } else {
            return false;
        }
    }

}