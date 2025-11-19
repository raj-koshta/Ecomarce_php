<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingsModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('AdminModel');

        // Allow public methods
        $public_methods = ['login', 'logout', 'index'];

        if (!in_array($this->router->fetch_method(), $public_methods)) {
            check_admin_login();
            check_is_superadmin();
        }

    }

    public function admins_list()
    {
        $data['title'] = "Admin's List";
        $data['admins'] = $this->AdminModel->get_admins();
        $data['roles'] = $this->AdminModel->get_all_roles();
        $this->load->view('admin/super_admin/admins_list', $data);
    }

    public function update_role()
    {
        $admin_id = $this->input->post('admin_id');
        $role_id = $this->input->post('role_id');

        if ($admin_id !== null) {
            $update = $this->db->where('admin_id', $admin_id)
                ->update('tbl_admins', ['role_id' => $role_id]);

            if ($update) {
                $this->session->set_userdata('is_super_admin', $role_id == 1 ? true : false);
                echo json_encode(['success' => true, 'msg' => 'Role Updated Successfully']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to update role']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Admin record']);
        }
    }

    public function update_status()
    {
        $admin_id = $this->input->post('admin_id');
        $status = $this->input->post('status');

        if ($admin_id !== null) {
            $update = $this->db->where('admin_id', $admin_id)
                ->update('tbl_admins', ['status' => $status]);

            if ($update) {
                $this->session->set_userdata('is_admin_active', $status == 1 ? true : false);
                echo json_encode(['success' => true, 'msg' => $status == 1 ? 'Actived Admin Account' : 'Deactivated Admin Account']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to update account status']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Admin record']);
        }
    }

    public function add_admin()
    {
        $data['title'] = "Add Admin";
        $data['roles'] = $this->AdminModel->get_all_roles();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_admins.email]', ['is_unique' => 'The email is already exist']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run()) {
            $post = $this->input->post();

            $data = [
                'name' => $post['name'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'role_id' => $post['role_id'],
                'gender' => $post['gender'],
                'phone' => $post['phone'],
                'status' => $post['status'],
                'ip' => $_SERVER["REMOTE_ADDR"],
                'added_on' => date('Y-m-d')
            ];

            if ($this->AdminModel->add($data)) {
                $this->session->set_flashdata('successMsg', 'Admin Added Successfully');
            } else {
                $this->session->set_flashdata('errorMsg', 'Unable to add admin. Please Try again later.');
            }
            redirect('superadmin/add_admin');

        } else {
            $this->load->view('admin/super_admin/add_admin', $data);
        }
    }

    public function role_control()
    {

        $data['title'] = "Role Access Controls";
        $data['admins'] = $this->AdminModel->get_subadmins();

        // Static labels (what you already had)
        $data['accesses'] = (object) [
            'all_products_list' => 'All Products List',
            'add_product' => 'Add Product',
            'active_products' => 'Active Products',
            'inactive_products' => 'Inactive Products',
            'oos_products' => 'Out Of Stock Products',
            'all_category_list' => 'All Category List',
            'add_category' => 'Add Category',
            'active_category' => 'Active Category',
            'inactive_category' => 'Inactive Category',
            'all_orders_list' => 'All Orders List',
            'pending_orders' => 'Pending Orders',
            'completed_orders' => 'Completed Orders',
            'cancelled_orders' => 'Cancelled Orders',
            'today_placed_orders' => 'Today Placed Orders',
            'all_inquiry_list' => 'All Inquiry List',
            'open_inquiries' => 'Open Inquiries',
            'closed_inquiries' => 'Closed Inquiries',
            'pincode' => 'Pincode',
            'banner' => 'Banner',
        ];

        // If an admin is selected, get their access row
        $admin_id = $this->input->get('admin_id');
        $data['selected_admin'] = $admin_id;
        $data['admin_access'] = [];

        if ($admin_id) {
            $data['admin_access'] = $this->db
                ->where('admin_id', $admin_id)
                ->get('tbl_role_access_controls')
                ->row_array(); // returns array like [all_products_list=>1, add_product=>0, ...]
        }

        $this->load->view('admin/super_admin/role_access_controls', $data);
    }

    public function update_role_access()
    {
        $admin_id = $this->input->post('admin_id');
        $postData = $this->input->post();
        unset($postData['admin_id']);

        // Convert ON/OFF → 1/0
        $data = [];
        foreach ($postData as $key => $val) {
            $data[$key] = ($val == "on") ? 1 : 0;
        }

        // Update DB
        $check = $this->AdminModel->update_role_access_controls($admin_id, $data);

        if($check){
            $this->session->set_flashdata('successMsg', 'Role access updated successfully.');
        } else {
            $this->session->set_flashdata('errorMsg', 'Unable to update Role access. Please try again later.');
        }

        redirect('superadmin/role-control?admin_id=' . $admin_id);
    }

}