<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('HomeModel');
    }

    public function index()
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
        redirect('cart');
        
    }

    public function delete_cart($product_id){
        
        $check = $this->CartModel->delete($product_id);
        if($check){
            $this->session->set_flashdata('successMsg', 'Product deleted Successfully');
        } else {
            $this->session->set_flashdata('errorMsg','Unable to delete the Product. Please try again..');
        }
        redirect('cart');
        
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
        redirect('cart');
    }

}