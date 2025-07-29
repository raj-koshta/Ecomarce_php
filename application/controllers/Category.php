<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
    }

    public function index()
    {
        $this->form_validation->set_rules('category_name', 'category name', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        
        if(empty($_FILES['image']['name'])){
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
            $post['image'] = $data['raw_name'].$data['file_ext'];

            $check = $this->CategoryModel->add_category($post);

            if($check){
                $this->session->set_flashdata('successMsg', "Data Inserted successfully");
                redirect('Category');
            } else {

            }
        } else {
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $this->load->view('category', $data);
        }

    }

    public function get_sub_categories(){
        $category_id =  $this->input->post('category_id');
        echo $this->CategoryModel->get_subcategories($category_id);
        
    }
}