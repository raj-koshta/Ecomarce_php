<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
    }

    public function index()
    {
        $data['banners'] = $this->HomeModel->get_banners();
        $data['categories'] = $this->HomeModel->get_categories();
        $data['products'] = $this->HomeModel->get_products();
        $this->load->view('frontend/index',$data);
    }

}