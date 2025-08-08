<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_id')){

        } else {
            $this->session->set_userdata('user_id', mt_rand(11111,99999));
        }

        $this->load->model('LoginModel');
        $this->load->model('HomeModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('RegisterModel');
        $this->load->model('CartModel');
    }

    public function index()
    {
        $data['banners'] = $this->HomeModel->get_banners();
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $data['products'] = $this->HomeModel->get_products();
        
        $this->load->view('member/index',$data);
    }

    public function login()
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
                redirect('member/login');
            }
        } else {
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $this->load->view('member/login',$data);
        }

    }

    public function register()
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

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function product_details($slug = null){
        $data['product'] = $this->HomeModel->get_product_details($slug);
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/product_details',$data);
    }

    public function product_by_category($slug1,$slug2 = null)
    {
       $category_id = $this->ProductModel->fetch_category_id(empty($slug2)? $slug1 : $slug2);
       $products = $this->ProductModel->fetch_product($category_id);
       echo "<pre>";
       echo $category_id;
       print_r($products);
    }

    public function cart()
    {
        $data['carts'] = $this->CartModel->get_cart();
        $data['total_price'] = $this->CartModel->total();
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/cart',$data);
    }

    public function update_cart(){
        $post = $this->input->post();
        $check = $this->CartModel->update($post);
        if($check){
            $this->session->set_flashdata('successMsg', 'Cart Updated Successfully');
        } else {
            $this->session->set_flashdata('errorMsg','Product already in cart.');
        }
        redirect('member/cart');
        
    }

    public function delete_cart($product_id){
        
        $check = $this->CartModel->delete($product_id);
        if($check){
            $this->session->set_flashdata('successMsg', 'Product deleted Successfully');
        } else {
            $this->session->set_flashdata('errorMsg','Unable to delete the Product. Please try again..');
        }
        redirect('member/cart');
        
    }

    public function add_to_cart()
    {
        $post = $this->input->post();
        $check = $this->CartModel->add($post);
        if($check){
            $this->session->set_flashdata('successMsg', 'Product Added Successfully');
        } else {
            $this->session->set_flashdata('errorMsg','Unable to add the product. Please try again..');
        }
        redirect('member/cart');
    }

    public function checkout(){
        if(!empty($this->session->userdata('login_id'))){
            echo "hello";
        } else {
            redirect('member/login');
        }
    }
}