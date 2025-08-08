<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingsModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
    }

    public function dashboard(){
        $this->load->view('admin/index');
    }

    public function add_pincode()
    {
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
        $this->form_validation->set_rules('delivery_charge', 'Delivery charge', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        if ($this->form_validation->run()) {
            $post = $this->input->post();
            $check = $this->SettingsModel->add_pincode($post);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Data Inserted successfully");
                redirect('admin/pincode');
            } else {

            }
        } else {
            $this->load->view('admin/pincode');
        }
    }

    public function add_banner()
    {
        if (empty($_FILES['bann_image']['name'])) {
            $this->form_validation->set_rules('bann_image', 'Banner Image', 'required|trim');
        }
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        if ($this->form_validation->run()) {

            $post = $this->input->post();
            $config = array(
                'upload_path' => './uploads/banner',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('bann_image');

            $image = $this->upload->data();
            $post['bann_image'] = $image['file_name'];

            $check = $this->SettingsModel->add_banner($post);


            if ($check) {
                $this->session->set_flashdata('successMsg', "Data Inserted successfully");
                redirect('admin/banner');
            } else {

            }
        } else {
            $this->load->view('admin/banner');
        }
    }

    public function add_category()
    {
        $this->form_validation->set_rules('category_name', 'category name', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Category Image', 'required|trim');
        }

        if ($this->form_validation->run()) {
            $post = $this->input->post();

            $config = array(
                'upload_path' => './uploads/products/',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $data = $this->upload->data();
            $post['image'] = $data['raw_name'] . $data['file_ext'];

            $check = $this->CategoryModel->add_category($post);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Data Inserted successfully");
                redirect('admin/add_category');
            } else {

            }
        } else {
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $this->load->view('admin/category', $data);
        }

    }

    public function add_product()
    {
        $this->form_validation->set_rules('product_id', 'Product ID', 'required|trim');
        $this->form_validation->set_rules('category', 'category', 'required|trim');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
        $this->form_validation->set_rules('brand', 'brand', 'required|trim');
        $this->form_validation->set_rules('features', 'features', 'required|trim');
        $this->form_validation->set_rules('highlights', 'highlights', 'required|trim');
        $this->form_validation->set_rules('description', 'description', 'required|trim');
        $this->form_validation->set_rules('stock', 'stock', 'required|trim');
        $this->form_validation->set_rules('mrp', 'mrp', 'required|trim');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        
        if(empty($_FILES['product_main_image']['name'])){
            $this->form_validation->set_rules('product_main_image', 'Product Image', 'required|trim');
        }

        if ($this->form_validation->run()) {
            $post = $this->input->post();

            $config = array(
                'upload_path' => './uploads/products/',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );

            $this->load->library('upload', $config);
            $this->upload->do_upload('product_main_image');
            $data = $this->upload->data();
            $post['product_main_image'] = $data['raw_name'].$data['file_ext'];
            $check = $this->ProductModel->add_Product($post);

            if($check){
                $this->session->set_flashdata('successMsg', "Product added successfully");
                redirect('admin/add_product');
            } else {
                $this->session->set_flashdata('errorMsg', "Product Faild to add");
                redirect('admin/add_product');
            }
        } else {
            if($this->session->userdata('product_id') != ""){
                $product_id = $this->session->userdata('product_id');
            } else {
                $this->session->set_userdata('product_id', mt_rand(11111,99999));
                $product_id = $this->session->userdata('product_id');
            }
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $data['product_id'] = $product_id;
            $this->load->view('admin/product', $data);
        }
    }

    public function get_sub_categories()
    {
        $category_id = $this->input->post('category_id');
        echo $this->CategoryModel->get_subcategories($category_id); // Echo only here
    }

}