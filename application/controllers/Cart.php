<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
    }

    public function index()
    {
        
    }

    public function add_to_cart()
    {
        $post = $this->input->post();
        $this->CartModel->add($post);
        // $this->load->view('frontend/product_details', $data);
    }

}