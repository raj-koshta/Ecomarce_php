<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingsModel');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('AdminModel');
    }

    public function dashboard()
    {
        $this->load->view('admin/index');
    }

    public function pincode()
    {
        $data['pincodes'] = $this->SettingsModel->get_all_pincode();
        $this->load->view('admin/pincode', $data);
    }

    public function add_pincode()
    {
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
        $this->form_validation->set_rules('delivery_charge', 'Delivery charge', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        if ($this->form_validation->run()) {
            $post = $this->input->post();
            $check = $this->SettingsModel->add_pincode($post);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Pincode Inserted successfully");
                redirect('admin/pincode');
            } else {
                $this->session->set_flashdata('errorMsg', "unable to add pincode");
                redirect('admin/pincode');
            }
        } else {
            $this->load->view('admin/add_pincode');
        }
    }

    public function update_pincode($id)
    {

        $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
        $this->form_validation->set_rules('delivery_charge', 'Delivery charge', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        if ($this->form_validation->run()) {
            $post = $this->input->post();
            $post['id'] = $id;
            $check = $this->SettingsModel->update_pincode($post);
            // print_r($check); die;

            if ($check) {
                $this->session->set_flashdata('successMsg', "Pincode Updated successfully");
                redirect('admin/pincode');
            } else {
                $this->session->set_flashdata('errorMsg', "unable to update pincode");
                redirect('admin/update_pincode/' . $id);
            }
        } else {
            $data['pincode'] = $this->SettingsModel->get_pincode_by_id($id);
            $this->load->view('admin/add_pincode', $data);
        }
    }

    public function update_pincode_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if ($id !== null) {
            $update = $this->db->where('id', $id)
                ->update('tbl_pincode', ['status' => $status]);

            if ($update) {
                echo json_encode(['success' => true, 'msg' => $status == 1 ? 'Actived Pincode' : 'Deactivated Pincode']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to change status']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Pincode in records']);
        }
    }

    public function delete_pincode($id)
    {
        $qry = $this->db->where('id', $id)->delete('tbl_pincode');
        if ($qry) {
            $this->session->set_flashdata('successMsg', "Pincode Deleted successfully");
            redirect('admin/pincode');
        } else {
            $this->session->set_flashdata('errorMsg', "Unable to delete Pincode!!");
            redirect('admin/pincode');
        }
    }

    public function banner()
    {
        $data['banners'] = $this->SettingsModel->get_all_banners();
        $this->load->view('admin/banner', $data);
    }

    public function add_banner()
    {
        if (empty($_FILES['bann_image']['name'])) {
            $this->form_validation->set_rules('bann_image', 'Banner Image', 'required|trim');
        }
        $this->form_validation->set_rules('title', 'title', 'required|trim');
        $this->form_validation->set_rules('description', 'description', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        if ($this->form_validation->run()) {
            $post = $this->input->post();
            $config = array(
                'upload_path' => './uploads/banner',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('bann_image');

            $image = $this->upload->data();
            $post['bann_image'] = $image['file_name'];

            $check = $this->SettingsModel->add_banner($post);


            if ($check) {
                $this->session->set_flashdata('successMsg', "Banner added successfully");
                redirect('admin/banner');
            } else {
                $this->session->set_flashdata('errorMsg', "Unable to add banner.");
                redirect('admin/add_banner');
            }
        } else {
            $this->load->view('admin/add_banner');
        }
    }

    public function update_banner($bann_id)
    {
        if ($this->input->method() === 'post') {

            $this->form_validation->set_rules('title', 'title', 'required|trim');
            $this->form_validation->set_rules('description', 'description', 'required|trim');
            $this->form_validation->set_rules('status', 'status', 'required|trim');
            if ($this->form_validation->run()) {
                $post = $this->input->post();
                if (!empty($_FILES['bann_image']['name'])) {
                    $config = array(
                        'upload_path' => './uploads/banner',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                    );
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('bann_image');

                    $image = $this->upload->data();
                    $post['bann_image'] = $image['file_name'];
                }
                $post['bann_id'] = $bann_id;
                $post['updated_on'] = date('d M, Y');

                $check = $this->SettingsModel->update_banner($post);

                if ($check) {
                    $this->session->set_flashdata('successMsg', "Banner updated successfully");
                    redirect('admin/banner');
                } else {
                    $this->session->set_flashdata('errorMsg', "Unable to update banner.");
                    redirect('admin/update_banner/' . $bann_id);
                }
            } else {
                $data['banner'] = $this->SettingsModel->get_Banner_by_id($bann_id);
                $this->load->view('admin/add_banner', $data);
            }
        } else {
            $data['banner'] = $this->SettingsModel->get_Banner_by_id($bann_id);
            $this->load->view('admin/add_banner', $data);
        }
    }

    public function delete_banner($bann_id, $bann_image = null)
    {
        // Delete image file if exists
        if (!empty($bann_image)) {
            $file_path = FCPATH . 'uploads/banner/' . $bann_image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete record from DB
        $check = $this->SettingsModel->delete_banner($bann_id);

        if ($check) {
            $this->session->set_flashdata('successMsg', "Banner deleted successfully");
        } else {
            $this->session->set_flashdata('errorMsg', "Unable to delete banner.");
        }

        redirect('admin/banner');
    }


    public function update_banner_status()
    {
        $bann_id = $this->input->post('bann_id');
        $status = $this->input->post('status');

        if ($bann_id !== null) {
            $update = $this->db->where('bann_id', $bann_id)
                ->update('tbl_banner', ['status' => $status]);

            if ($update) {
                echo json_encode(['success' => true, 'msg' => $status == 1 ? 'Active Banner' : 'Deactivate Banner']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to change status']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Banner in records']);
        }
    }

    public function category()
    {
        $data['categories'] = $this->CategoryModel->get_all_category();
        $this->load->view('admin/category', $data);
    }

    public function add_category()
    {

        $this->form_validation->set_rules('category_name', 'category name', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Category Image', 'required|trim');
        }

        if ($this->form_validation->run()) {
            $post = $this->input->post();

            $config = array(
                'upload_path' => './uploads/products/',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $data = $this->upload->data();
            $post['image'] = $data['raw_name'] . $data['file_ext'];

            $check = $this->CategoryModel->add_category($post);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Category added successfully");
                redirect('admin/category');
            } else {
                $this->session->set_flashdata('errorMsg', "Unable to add category. Please try again..");
                redirect('admin/add_category');
            }
        } else {
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $this->load->view('admin/add_category', $data);
        }

    }


    public function update_category_status()
    {
        $category_id = $this->input->post('category_id');
        $status = $this->input->post('status');

        if ($category_id !== null) {
            // 🔹 First get category details
            $category = $this->db->where('category_id', $category_id)
                ->get('tbl_category')
                ->row();

            if (!$category) {
                echo json_encode(['success' => false, 'msg' => 'Category not found']);
                return;
            }

            // 🔹 Update category status
            $update = $this->db->where('category_id', $category_id)
                ->update('tbl_category', ['status' => $status]);

            if ($update) {
                if (!empty($category->parent_id) && $category->parent_id != 0) {
                    // ===========================
                    // Case 1: It's a Subcategory
                    // ===========================
                    $this->db->where('sub_category', $category_id)
                        ->update('tbl_product', ['status' => $status]);
                } else {
                    // ===========================
                    // Case 2: It's a Parent Category
                    // ===========================
                    // Update products under parent
                    $this->db->where('category', $category_id)
                        ->update('tbl_product', ['status' => $status]);

                    // Find all subcategories of this parent
                    $subcategories = $this->db->where('parent_id', $category_id)
                        ->get('tbl_category')
                        ->result();

                    if (!empty($subcategories)) {
                        foreach ($subcategories as $subcat) {
                            // Update subcategory status
                            $this->db->where('category_id', $subcat->category_id)
                                ->update('tbl_category', ['status' => $status]);

                            // Update products under subcategory
                            $this->db->where('sub_category', $subcat->category_id)
                                ->update('tbl_product', ['status' => $status]);
                        }
                    }
                }

                echo json_encode([
                    'success' => true,
                    'msg' => $status == 1
                        ? 'Category and Products Activated Successfully'
                        : 'Category and Products Deactivated Successfully'
                ]);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Failed to change category status']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Category records']);
        }
    }


    public function update_category($category_id)
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('category_name', 'category name', 'required|trim');
            $this->form_validation->set_rules('status', 'status', 'required|trim');

            if ($this->form_validation->run()) {
                $post = $this->input->post();

                // 🔹 Image upload
                if (!empty($_FILES['image']['name'])) {
                    $config = array(
                        'upload_path' => './uploads/products/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                    );
                    $this->load->library('upload', $config);

                    $is_upload = $this->upload->do_upload('image');

                    if ($is_upload) {
                        $db_image = $this->CategoryModel->get_category_image($category_id);
                        if (!empty($db_image)) {
                            $old_file_path = './uploads/products/' . $db_image;

                            // Check if file exists before deleting
                            if (file_exists($old_file_path)) {
                                unlink($old_file_path); // delete old file
                            }
                        }
                    }
                    $data = $this->upload->data();
                    $post['image'] = $data['raw_name'] . $data['file_ext'];
                }

                $post['updated_on'] = date('d M, Y');
                $post['category_id'] = $category_id;
                $post['slug'] = $this->CategoryModel->slug($post['category_name']);

                $check = $this->CategoryModel->update_category($post);

                if ($check) {
                    
                    $this->session->set_flashdata('successMsg', "Category and Products updated Successfully");
                    redirect('admin/category');
                } else {
                    $this->session->set_flashdata('errorMsg', "Unable to update category. Please try again..");
                    redirect('admin/update_category/' . $category_id);
                }
            } else {
                $data['cate'] = $this->CategoryModel->get_category_by_id($category_id);
                $data['categories'] = $this->CategoryModel->get_all_categories();
                $this->load->view('admin/add_category', $data);
            }
        } else {
            $data['cate'] = $this->CategoryModel->get_category_by_id($category_id);
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $this->load->view('admin/add_category', $data);
        }
    }

    public function delete_category($category_id)
    {
        // Get category details first (to fetch image path)
        $category = $this->CategoryModel->get_category_by_id($category_id);

        if ($category) {

            // 🔹 Step 1: Check if any products exist in this category
            $this->db->where('category', $category_id);
            $this->db->or_where('sub_category', $category_id); // if you also want to check subcategories
            $product_count = $this->db->count_all_results('tbl_product');

            if ($product_count > 0) {
                // Products found → don’t delete
                $this->session->set_flashdata('errorMsg', "Cannot delete category. Products already exist in this category.");
                redirect('admin/category');
                return;
            }

            // If category has an image, try deleting it from local folder
            if (!empty($category->image)) {
                $image_path = FCPATH . 'uploads/products/' . $category->image; // Adjust path if different

                if (file_exists($image_path)) {
                    unlink($image_path); // Delete the image
                }
            }

            // Now delete the category from DB
            $check = $this->CategoryModel->delete_category($category_id);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Category deleted successfully.");
            } else {
                $this->session->set_flashdata('errorMsg', "Unable to delete category. Please try again.");
            }
        } else {
            $this->session->set_flashdata('errorMsg', "Category not found.");
        }

        redirect('admin/category');
    }

    public function product()
    {
        $data['products'] = $this->ProductModel->get_all_products();
        $this->load->view('admin/product', $data);
    }

    public function add_product()
    {
        $this->form_validation->set_rules('product_id', 'Product ID', 'required|trim');
        $this->form_validation->set_rules('category', 'category', 'required|trim');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
        $this->form_validation->set_rules('brand', 'brand', 'required|trim');
        $this->form_validation->set_rules('features', 'features', 'required|trim');
        $this->form_validation->set_rules('highlights', 'highlights', 'required|trim');
        $this->form_validation->set_rules('description', 'description', 'required|trim');
        $this->form_validation->set_rules('stock', 'stock', 'required|trim');
        $this->form_validation->set_rules('mrp', 'mrp', 'required|trim');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if (empty($_FILES['product_main_image']['name'])) {
            $this->form_validation->set_rules('product_main_image', 'Product Image', 'required|trim');
        }

        if ($this->form_validation->run()) {
            $post = $this->input->post();

            $config = array(
                'upload_path' => './uploads/products/',
                'allowed_types' => 'gif|jpg|png|jpeg',
            );

            $this->load->library('upload', $config);
            $this->upload->do_upload('product_main_image');
            $data = $this->upload->data();
            $post['product_main_image'] = $data['raw_name'] . $data['file_ext'];
            $check = $this->ProductModel->add_Product($post);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Product added successfully");
                redirect('admin/product');
            } else {
                $this->session->set_flashdata('errorMsg', "Product Faild to add");
                redirect('admin/add_product');
            }
        } else {
            if ($this->session->userdata('product_id') != "") {
                $product_id = $this->session->userdata('product_id');
            } else {
                $this->session->set_userdata('product_id', mt_rand(11111, 99999));
                $product_id = $this->session->userdata('product_id');
            }
            $data['categories'] = $this->CategoryModel->get_all_categories();
            $data['product_id'] = $product_id;
            $this->load->view('admin/add_product', $data);
        }
    }

    public function update_product_status()
    {
        $product_id = $this->input->post('product_id');
        $status = $this->input->post('status');

        if ($product_id !== null) {
            $update = $this->db->where('product_id', $product_id)
                ->update('tbl_product', ['status' => $status]);

            if ($update) {
                echo json_encode(['success' => true, 'msg' => $status == 1 ? 'Active Product' : 'Deactivate Product']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to change status']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Product records']);
        }
    }

    public function update_product($product_id)
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('product_id', 'Product ID', 'required|trim');
            $this->form_validation->set_rules('category', 'category', 'required|trim');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
            $this->form_validation->set_rules('brand', 'brand', 'required|trim');
            $this->form_validation->set_rules('features', 'features', 'required|trim');
            $this->form_validation->set_rules('highlights', 'highlights', 'required|trim');
            $this->form_validation->set_rules('description', 'description', 'required|trim');
            $this->form_validation->set_rules('stock', 'stock', 'required|trim');
            $this->form_validation->set_rules('mrp', 'mrp', 'required|trim');
            $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|trim');
            $this->form_validation->set_rules('status', 'status', 'required|trim');

            if ($this->form_validation->run()) {
                $post = $this->input->post();

                if (!empty($_FILES['product_main_image']['name'])) {
                    $config = array(
                        'upload_path' => './uploads/products/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                    );
                    $this->load->library('upload', $config);
                    $is_upload = $this->upload->do_upload('product_main_image');

                    if ($is_upload) {
                        $db_main_image = $this->ProductModel->get_product_main_image($product_id);
                        if (!empty($db_main_image)) {
                            $old_file_path = './uploads/products/' . $db_main_image;

                            // Check if file exists before deleting
                            if (file_exists($old_file_path)) {
                                unlink($old_file_path); // delete old file
                            }
                        }
                    }

                    $data = $this->upload->data();
                    $post['product_main_image'] = $data['raw_name'] . $data['file_ext'];

                }

                $post['updated_on'] = date('d M, Y');
                $post['product_id'] = $product_id;
                $post['slug'] = $this->ProductModel->slug($post['product_name']);

                $check = $this->ProductModel->update_product($post);
                // $check = false;
                if ($check) {
                    $this->session->set_flashdata('successMsg', "Product updated successfully");
                    redirect('admin/product');
                } else {
                    $this->session->set_flashdata('errorMsg', "Unable to update product. Please try again..");
                    redirect('admin/update_product/' . $product_id);
                }
            } else {
                $data['categories'] = $this->CategoryModel->get_all_categories();
                $data['product_id'] = $product_id;
                $data['product'] = $this->ProductModel->get_product_by_id($product_id);
                $this->load->view('admin/add_product', $data);
            }
        } else {

            $data['categories'] = $this->CategoryModel->get_all_categories();
            $data['product_id'] = $product_id;
            $data['product'] = $this->ProductModel->get_product_by_id($product_id);
            $this->load->view('admin/add_product', $data);
        }
    }

    public function delete_product($product_id)
    {
        // Get category details first (to fetch image path)
        $product = $this->ProductModel->get_product_by_id($product_id);

        if ($product) {
            // If category has an image, try deleting it from local folder
            if (!empty($product->product_main_image)) {
                $image_path = FCPATH . 'uploads/products/' . $product->product_main_image; // Adjust path if different

                if (file_exists($image_path)) {
                    unlink($image_path); // Delete the image
                }
            }

            // Now delete the category from DB
            $check = $this->ProductModel->delete_product($product_id);

            if ($check) {
                $this->session->set_flashdata('successMsg', "Product deleted successfully.");
            } else {
                $this->session->set_flashdata('errorMsg', "Unable to delete product. Please try again.");
            }
        } else {
            $this->session->set_flashdata('errorMsg', "Category not found.");
        }

        redirect('admin/product');
    }

    public function get_sub_categories()
    {
        $category_id = $this->input->post('category_id');
        echo $this->CategoryModel->get_subcategories($category_id); // Echo only here
    }

    public function order(){
        $data['orders'] = $this->AdminModel->get_all_orders();
        $this->load->view('admin/order', $data);
    }
    
    public function update_order_status(){
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('order_status');
        
        if($order_id !== null){
            $update = $this->db->where('id',$order_id)->update('tbl_orders',['order_status' => $status]);
            
            if ($update) {
                echo json_encode(['success' => true, 'msg' => 'Order status Updated']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to update status']);
            }
            
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find Order in records']);
        }
        
    }
    
    public function inquiry(){
        $data['inquiries'] = $this->AdminModel->get_all_inquiries();
        $this->load->view('admin/inquiry', $data);
    }

    public function update_inquiry_status(){
        $id  = $this->input->post('id');
        $status = $this->input->post('status');

        if($id !== null){
            $update = $this->db->where('id',$id)->update('tbl_inquiry',['status' => $status]);
            
            if ($update) {
                echo json_encode(['success' => true, 'msg' => 'Inquiry status Updated.']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to update status.']);
            }
        } else {
            echo json_encode(['success' => false, 'msg' => 'Unable to find inquiry in records.']);
        }
    }
}