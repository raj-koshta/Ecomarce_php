<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
    }

    public function index()
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
                redirect('Product');
            } else {
                $this->session->set_flashdata('errorMsg', "Product Faild to add");
                redirect('Product');
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
}