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
       
    }

    public function product_by_category($slug1,$slug2 = null)
    {
       $category_id = $this->ProductModel->fetch_category_id(empty($slug2)? $slug1 : $slug2);
       $products = $this->ProductModel->fetch_product($category_id);
       echo "<pre>";
       print_r($products);
    }
}