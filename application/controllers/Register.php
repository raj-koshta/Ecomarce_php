<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegisterModel');
        $this->load->model('HomeModel');
       
    }
    public function index()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('username','Full Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[tbl_users.email]',['is_unique'=>'The email is already exist']);
        $this->form_validation->set_rules('password','Password','required|trim|min_length[6]');
        if($this->form_validation->run()){
            $check = $this->RegisterModel->register($post);
            if($check){
                $this->session->set_flashdata('registerSuccessMsg', "Registration successful.");
                redirect('login');
            } else {
                $this->session->set_flashdata('registerErrorMsg', "Registration Failed. Please try again.");
                $data['data'] = $post;
                $data['parentCategories'] = $this->HomeModel->get_parent_categories();
                $this->load->view('member/register',$data);
            }
        } else {
            $data['data'] = $post;
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $this->load->view('member/register',$data);
        }
    }

}