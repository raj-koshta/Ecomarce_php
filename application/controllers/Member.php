<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_id')) {

        } else {
            $this->session->set_userdata('user_id', mt_rand(11111, 99999));
        }

        $this->load->model('LoginModel');
        $this->load->model('HomeModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('RegisterModel');
        $this->load->model('CartModel');
        $this->load->model('UserModel');
        $this->load->model('CheckoutModel');
        $this->load->model('WishlistModel');
    }

    public function index()
    {
        $data['banners'] = $this->HomeModel->get_banners();
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $data['products'] = $this->HomeModel->get_products();

        $this->load->view('member/index', $data);
    }

    public function login()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        if ($this->form_validation->run()) {
            $check = $this->LoginModel->login($post);
            if ($check) {
                redirect('member');
            } else {
                $this->session->set_flashdata('loginErrorMsg', 'Please enter valid Email and Password.');
                redirect('member/login');
            }
        } else {
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $this->load->view('member/login', $data);
        }

    }

    public function register()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('username', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_users.email]', ['is_unique' => 'The email is already exist']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        if ($this->form_validation->run()) {
            $check = $this->RegisterModel->register($post);
            if ($check) {
                $this->session->set_flashdata('registerSuccessMsg', "Registration successful.");
                redirect('member/login');
            } else {
                $this->session->set_flashdata('registerErrorMsg', "Registration Failed. Please try again.");
                $data['data'] = $post;
                $data['parentCategories'] = $this->HomeModel->get_parent_categories();
                $this->load->view('member/register', $data);
            }
        } else {
            $data['data'] = $post;
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $this->load->view('member/register', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function product_details($slug = null)
    {
        $data['product'] = $this->HomeModel->get_product_details($slug);
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/product_details', $data);
    }

    public function cart()
    {
        $data['carts'] = $this->CartModel->get_cart();
        $data['total_price'] = $this->CartModel->total();
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/cart', $data);
    }

    public function update_cart()
    {
        $post = $this->input->post();
        $check = $this->CartModel->update($post);
        if ($check) {
            $this->session->set_flashdata('successMsg', 'Cart Updated Successfully');
        } else {
            $this->session->set_flashdata('errorMsg', 'Product already in cart.');
        }
        redirect('member/cart');

    }

    public function delete_cart($product_id)
    {

        $check = $this->CartModel->delete($product_id);
        if ($check) {
            $this->session->set_flashdata('successMsg', 'Product deleted Successfully');
        } else {
            $this->session->set_flashdata('errorMsg', 'Unable to delete the Product. Please try again..');
        }
        redirect('member/cart');

    }

    public function add_to_cart()
    {
        $post = $this->input->post();
        $check = $this->CartModel->add($post);
        if ($check) {
            $this->session->set_flashdata('successMsg', 'Product Added Successfully');
        } else {
            $this->session->set_flashdata('errorMsg', 'Unable to add the product. Please try again..');
        }
        redirect('member/cart');
    }

    public function product_by_category($slug1, $slug2 = null)
    {
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $category_id = $this->ProductModel->fetch_category_id(empty($slug2) ? $slug1 : $slug2);
        $data['products'] = $this->ProductModel->fetch_product($category_id);
        $this->load->view('member/product', $data);
    }

    public function category()
    {
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $data['allCategories'] = $this->HomeModel->get_all_categories();
        $this->load->view('member/category', $data);
    }

    public function get_product_details_by_id($id)
    {
        $product = $this->HomeModel->get_product_by_id($id);

        if ($product) {
            echo json_encode([
                'status' => 'success',
                'data' => $product
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Product not found'
            ]);
        }
    }

    public function profile()
    {
        if (!empty($this->session->userdata('login_id'))) {
            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $data['addresses'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('tbl_address')->result();
            $data['orders'] = $this->UserModel->get_orders();
            $this->load->view('member/profile', $data);
        } else {
            redirect('member/login');
        }
    }

    public function upload_profile_image()
    {
        if (!empty($_FILES['image']['name'])) {
            $uploadPath = './uploads/profile/';

            // Create the folder if it does not exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // true allows recursive creation
            }
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $fileName = $uploadData['file_name'];

                // Save in DB
                $userId = $this->input->post('user_id');

                $check = $this->UserModel->update_profile_picture($userId, $fileName);
                if ($check) {

                    echo json_encode([
                        'status' => 'success',
                        'image_url' => base_url('uploads/profile/' . $fileName)
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Profile Upload Failed..'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                ]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No image uploaded']);
        }
    }

    public function update_profile_info()
    {
        $user_id = $this->session->userdata('user_obj')->user_id;
        $post = $this->input->post();

        $check = $this->UserModel->update_info($user_id, $post);

        if ($check) {
            $this->session->set_flashdata('successMsg', 'Information updated successfully.');

        } else {
            $this->session->set_flashdata('errorMsg', 'Failed to update Information.');

        }

        redirect('member/profile');

    }

    public function add_billing_address()
    {
        $post = $this->input->post();
        $post['user_id'] = $this->session->userdata('user_id');
        $post['added_on'] = date('Y-m-d');
        $qry = $this->db->insert('tbl_address', $post);

        if ($qry) {
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('successMsg', 'Address Added successfully.');
            }
        } else {
            $this->session->set_flashdata('errorMsg', 'Failed to add Address.');
        }
        redirect('member/profile');
    }

    public function update_address($id)
    {
        $post = $this->input->post([
            'first_name',
            'last_name',
            'email',
            'street',
            'city',
            'state',
            'phone',
            'zip_code',
            'country'
        ], TRUE);

        $post['updated_on'] = date('Y-m-d');
        $qry = $this->db->where('id', $id)->update('tbl_address', $post);

        if ($qry) {
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('successMsg', 'Address Updated successfully.');
            }
        } else {
            $this->session->set_flashdata('errorMsg', 'Failed to update Address.');
        }
        redirect('member/profile');
    }

    public function delete_address($address_id)
    {
        $qry = $this->db->where('id', $address_id)->delete('tbl_address');

        if ($qry) {
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('successMsg', 'Address Deleted successfully.');
            }
        } else {
            $this->session->set_flashdata('errorMsg', 'Failed to delete Address.');
        }
        redirect('member/profile');
    }

    public function check_old_password()
    {
        // Always set JSON header
        $this->output->set_content_type('application/json');

        $old_pass = $this->input->post('old_pass', TRUE);
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            echo json_encode(['valid' => false, 'error' => 'Not logged in']);
            return;
        }

        $stored_hash = $this->db->select('password')
            ->where('user_id', $user_id)
            ->get('tbl_users')
            ->row()
            ->password ?? '';


        $is_valid = password_verify($old_pass, $stored_hash);

        echo json_encode(['valid' => $is_valid]);
    }

    public function update_password()
    {
        $user_id = $this->session->userdata('user_id');
        $post = $this->input->post();
        $post['updated_on'] = date('Y-m-d');
        $qry = $this->db
            ->where([
                'user_id' => $user_id,
                'email' => $this->session->userdata('user_obj')->email
            ])
            ->update('tbl_users', [
                'password' => password_hash($post['new_pass'], PASSWORD_BCRYPT),
                'updated_on' => $post['updated_on']
            ]);

        if ($qry) {
            $this->session->set_flashdata('successMsg', 'Password updated successfully.');
        } else {
            $this->session->set_flashdata('errorMsg', 'Failed to update password.');
        }

        redirect('member/profile');
    }

    public function checkout()
    {
        if (!empty($this->session->userdata('login_id'))) {
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
            $this->output->set_header("Pragma: no-cache");

            // generate unique token for this checkout session
            $token = bin2hex(random_bytes(16));
            $this->session->set_userdata('checkout_token', $token);

            $data['checkout_token'] = $token;

            $data['parentCategories'] = $this->HomeModel->get_parent_categories();
            $data['billingAddresses'] = $this->UserModel->get_billing_addresses();
            $data['carts'] = $this->CartModel->get_cart();
            $data['total_price'] = $this->CartModel->total();
            $this->load->view('member/checkout', $data);
        } else {
            redirect('member/login');
        }
    }

    public function place_order()
    {
        $post = $this->input->post();
        $session_token = $this->session->userdata('checkout_token');

        // Check if valid token
        if (empty($post['checkout_token']) || $post['checkout_token'] !== $session_token) {
            $this->session->set_flashdata('errorMsg', 'Invalid or duplicate submission');
            redirect('member/cart'); // invalid/duplicate submission
            return;
        }

        // Invalidate token immediately (so it can’t be reused)
        $this->session->unset_userdata('checkout_token');

        $user_id = $this->session->userdata('user_id'); // assuming login required

        // If cart is already empty, don’t create a new order
        $carts = $this->CartModel->get_cart();
        if (empty($carts)) {
            $this->session->set_flashdata('errorMsg', 'Cart is Empty.');
            redirect('member/cart');
            return;
        }
        $address = null;

        // Step 1: Handle Billing Address
        if (empty($post['billing_address_id'])) {
            $addressData = [
                'user_id' => $user_id,
                'first_name' => $post['first_name'],
                'last_name' => $post['last_name'],
                'email' => $post['email'],
                'street' => $post['street'],
                'city' => $post['city'],
                'state' => $post['state'],
                'phone' => $post['phone'],
                'zip_code' => $post['zip_code'],
                'country' => $post['country'],
                'added_on' => date('Y-m-d')
            ];
            $address = $addressData['street'] . ' ' . $addressData['city'] . ' ' . $addressData['state'] . ' ' . $addressData['country'] . ' ' . $addressData['zip_code'];

            $billing_address_id = $this->CheckoutModel->insert_address($addressData);
        } else {
            $billing_address_id = $post['billing_address_id'];
            $address = $post['street'] . ' ' . $post['city'] . ' ' . $post['state'] . ' ' . $post['country'] . ' ' . $post['zip_code'];
        }

        // checking cart products are in stock or not
        $carts = $this->CartModel->get_cart(); // or however you load $carts

        foreach ($carts as $cart) {

            $product_stock = $this->db->where('product_id', $cart->product_id)->get('tbl_product')->row()->stock;

            if (!($product_stock >= $cart->product_qty)) {
                $this->session->set_flashdata('errorMsg', $cart->product_name . ' are out of stock.');
                redirect('member/cart');
                return;
            }
        }

        // Step 2: Insert Order
        $orderData = [
            'user_id' => $user_id,
            'recipient_name' => $post['first_name'] . ' ' . $post['last_name'],
            'recipient_email' => $post['email'],
            'recipient_phone' => $post['phone'],
            'address' => $address,
            'delivery_charges' => $post['delivery'],
            'total' => $post['grandtotal'],
            'payment_mode' => $post['payment'],
            'added_on' => date('Y-m-d'),
            'delivery_date' => date('Y-m-d', strtotime(date('Y-m-d') . ' +10 days')),
            'order_date' => date('Y-m-d'),
            'note' => $post['order_note'],
            'order_status' => 'Order Confirmed',
            'ip' => $_SERVER["REMOTE_ADDR"]
        ];

        $order_id = $this->CheckoutModel->insert_order($orderData);

        // Step 3: Insert Order Products
        

        foreach ($carts as $cart) {

            $product_stock = $this->db->where('product_id', $cart->product_id)->get('tbl_product')->row()->stock;

            $this->db->where('product_id', $cart->product_id)->update('tbl_product', ['stock'=> $product_stock - $cart->product_qty]);

            $productData = [
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product_name,
                'product_main_image' => $cart->product_image,
                'product_qty' => $cart->product_qty,
                'product_selling_price' => $cart->selling_price,
                'product_mrp' => $cart->mrp,
                'slug' => $cart->slug,
                'added_on' => date('Y-m-d')
            ];

            $this->CheckoutModel->insert_order_product($productData);
        }

        // Step 4: Clear cart
        $this->CartModel->delete_all();

        // Redirect to thank you page
        $this->session->set_userdata('order_id', $order_id);
        redirect('member/thank_you');
    }

    public function thank_you()
    {
        $order_id = $this->session->userdata('order_id');
        if (!$order_id) {
            redirect('member/index');
        }

        $data['order_id'] = $order_id;
        $this->session->unset_userdata('order_id'); // clear so refresh doesn’t repeat
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/thank_you', $data);
    }

    public function order_details($order_id)
    {
        $data['order'] = $this->UserModel->get_order_details($order_id);
        $data['orderProducts'] = $this->UserModel->get_order_products($order_id);
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        if (empty($data['order'])) {
            redirect('member/profile');
        } else {
            $this->load->view('member/invoice', $data);
        }
    }

    public function wishlist(){
        $data['wishlists'] = $this->WishlistModel->get_wishlists();
        $data['parentCategories'] = $this->HomeModel->get_parent_categories();
        $this->load->view('member/wishlist',$data);
    }

    public function add_to_wishlist(){
        $post = $this->input->post();
        $check = $this->WishlistModel->add($post['product_id']);
        if ($check) {
            $this->session->set_flashdata('successMsg', 'Product Added to wishlist Successfully');
        } else {
            $this->session->set_flashdata('errorMsg', 'Unable to add the product into wishlist. Please try again..');
        }
        redirect('member/wishlist');
    }

    public function delete_wishlist($wishlist_id){
        $check = $this->WishlistModel->delete($wishlist_id);
        if ($check) {
            $this->session->set_flashdata('successMsg', 'Wishlist deleted Successfully');
        } else {
            $this->session->set_flashdata('errorMsg', 'Unable to remove the Wishlist. Please try again..');
        }
        redirect('member/wishlist');
    }


}