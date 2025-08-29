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

    public function delete_pincode($id)
    {
        $qry = $this->db->where('id', $id)->delete('tbl_pincode');
        if ($qry && $this->db->affected_rows() > 0) {
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
                    $this->session->set_flashdata('successMsg', "Data Inserted successfully");
                    redirect('admin/banner');
                } else {
                    $this->session->set_flashdata('errorMsg', "Unable to add banner.");
                    redirect('admin/update_banner');
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
            $update = $this->db->where('category_id', $category_id)
                ->update('tbl_category', ['status' => $status]);

            if ($update) {
                echo json_encode(['success' => true, 'msg' => $status == 1 ? 'Active Category' : 'Deactivate Category']);
            } else {
                echo json_encode(['success' => false, 'msg' => 'Faild to change status']);
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

                if (!empty($_FILES['image']['name'])) {
                    $config = array(
                        'upload_path' => './uploads/products/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                    );
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('image');
                    $data = $this->upload->data();
                    $post['image'] = $data['raw_name'] . $data['file_ext'];

                }

                $post['updated_on'] = date('d M, Y');
                $post['category_id'] = $category_id;
                $post['slug'] = $this->CategoryModel->slug($post['category_name']);

                $check = $this->CategoryModel->update_category($post);

                if ($check) {
                    $this->session->set_flashdata('successMsg', "Category updated successfully");
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
                redirect('admin/add_product');
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
                    $this->upload->do_upload('image');
                    $data = $this->upload->data();
                    $post['product_main_image'] = $data['raw_name'] . $data['file_ext'];

                }

                $post['updated_on'] = date('d M, Y');
                $post['product_id'] = $product_id;
                $post['slug'] = $this->CategoryModel->slug($post['category_name']);
                echo "<pre>"; print_r($post);
                die;
                // $check = $this->CategoryModel->update_category($post);
                $check = false;
                if ($check) {
                    $this->session->set_flashdata('successMsg', "Category updated successfully");
                    redirect('admin/product');
                } else {
                    $this->session->set_flashdata('errorMsg', "Unable to update category. Please try again..");
                    redirect('admin/update_product/' . $product_id);
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
                $data['product'] = $this->ProductModel->get_product_by_id($product_id);
                $this->load->view('admin/add_product', $data);
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
            $data['product'] = $this->ProductModel->get_product_by_id($product_id);
            $this->load->view('admin/add_product', $data);
        }
    }

    public function get_sub_categories()
    {
        $category_id = $this->input->post('category_id');
        echo $this->CategoryModel->get_subcategories($category_id); // Echo only here
    }

}