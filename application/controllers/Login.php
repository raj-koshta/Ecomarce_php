<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!empty($this->session->userdata('login_id'))){
            redirect('checkout');
        }
        $this->load->model('LoginModel');
        $this->load->model('HomeModel');
        
    }

    public function index()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        if ($this->form_validation->run()) {
            $check = $this->LoginModel->login($post);
            if($check){
                redirect('checkout');
            }else{
                $this->session->set_flashdata('loginErrorMsg', 'Please enter valid Email and Password.');
                redirect('login');
            }
        } else {
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $this->load->view('member/login',$data);
        }

    }
}