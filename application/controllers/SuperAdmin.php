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
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');

        if ($this->form_validation->run()) {
            // $post = $this->input->post();

        } else {
            $this->load->view('admin/super_admin/add_admin', $data);
        }
    }
}