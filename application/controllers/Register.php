<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('name','Full Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim|min_length[6]');
        if($this->form_validation->run()){
            echo "Yes";
        } else {
            $data['data'] = $post;
            $this->load->view('frontend/register',$data);
        }
    }

}