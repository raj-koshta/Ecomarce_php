<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_id')){

        } else {
            $this->session->set_userdata('user_id', mt_rand(11111,99999));
        }
        $this->load->model('HomeModel');
    }

    public function index()
    {
        $data['banners'] = $this->HomeModel->get_banners();
        $data['categories'] = $this->HomeModel->get_categories();
        $data['products'] = $this->HomeModel->get_products();
        $this->load->view('frontend/index',$data);
    }

    public function product_details($slug = null){
        $data['product'] = $this->HomeModel->get_product_details($slug);
        $this->load->view('frontend/product_details',$data);
    }

}