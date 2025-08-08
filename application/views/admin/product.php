<?php

?>

<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:23 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Category</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <base href="<?php echo base_url() ?>">
    <?php $this->load->view('admin/links'); ?>

</head>

<?php $this->load->view('admin/header'); ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <?php if ($this->session->flashdata('successMsg')) { ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('successMsg'); ?>
                </div>
            <?php } else if ($this->session->flashdata('errorMsg')) { ?>
                    <div class="alert alert-danger">
                    <?= $this->session->flashdata('errorMsg'); ?>
                    </div>
            <?php } ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex pb-0">
                                    <h4 class="card-title mb-0 flex-grow-1">Product</h4>
                                    <a href="javascript: void(0);"
                                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                            class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Floating labels</h5>
                                    <p class="card-title-desc">Create beautifully simple form labels that float over
                                        your input fields.</p>

                                    <?= form_open_multipart(); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="product_id"
                                                    name="product_id" placeholder="Enter product name"
                                                    value="<?= set_value('product_id', $product_id) ?>">
                                                <label for="product_id">Product ID</label>
                                                <?= form_error('product_id') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select category" onchange="get_subcategories(this.value)"
                                                    id="category" name="category">
                                                    <option value="" selected>Select Category</option>
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?= $category->category_id ?>">
                                                            <?= $category->category_name ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <label for="category">Category</label>
                                                <?= form_error('category') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select sub_category" id="sub_category"
                                                    name="sub_category">
                                                    <option value="" selected>Select Sub Category</option>
                                                </select>
                                                <label for="sub_category">Sub Category</label>
                                                <?= form_error('sub_category') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="product_name"
                                                    name="product_name" placeholder="Enter product name">
                                                <label for="product_name">Product Name</label>
                                                <?= form_error('product_name') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="brand" name="brand"
                                                    placeholder="Enter product brand">
                                                <label for="brand">Product Brand</label>
                                                <?= form_error('brand') ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="features" name="features">
                                                    <option value="" selected>Select Features</option>
                                                    <option value="1">Deal of the month</option>
                                                    <option value="2">New arrivals</option>
                                                </select>
                                                <label for="features">Features</label>
                                                <?= form_error('features') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="highlights"
                                                    id="highlights"></textarea>
                                                <label for="highlights">Highlights</label>
                                                <?= form_error('highlights') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="description"
                                                    id="description"></textarea>
                                                <label for="description">Description</label>
                                                <?= form_error('description') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    placeholder="Enter product Stock">
                                                <label for="stock">Product Stock</label>
                                                <?= form_error('stock') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="mrp" name="mrp"
                                                    placeholder="Enter product MRP">
                                                <label for="mrp">Product MRP</label>
                                                <?= form_error('mrp') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="selling_price"
                                                    name="selling_price" placeholder="Enter product Selling Price">
                                                <label for="selling_price">Product Selling Price</label>
                                                <?= form_error('selling_price') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_title"
                                                    name="meta_title" placeholder="Enter Meta Title">
                                                <label for="meta_title">Meta Title</label>
                                                <?= form_error('meta_title') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_keywords"
                                                    name="meta_keywords" placeholder="Enter Meta Keywords">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <?= form_error('meta_keywords') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_description"
                                                    name="meta_description" placeholder="Enter Meta Description">
                                                <label for="meta_description">Meta Description</label>
                                                <?= form_error('meta_description') ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" id="product_main_image"
                                                    name="product_main_image" placeholder="Choose file for banner">
                                                <label for="product_main_image">Product Image</label>
                                                <?= form_error('product_main_image') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" id="gallary_iamge"
                                                    name="gallary_iamge" placeholder="Choose file for banner">
                                                <label for="gallary_iamge">Product Gallary Image</label>
                                                <?= form_error('gallary_iamge') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="statusSelect" name="status">
                                                    <option value="" selected>select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                </select>
                                                <label for="statusSelect">Status</label>
                                                <?= form_error('status') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="floatingCheck">
                                            <label class="form-check-label" for="floatingCheck">
                                                Check me out
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- END ROW -->



        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <script>
        function get_subcategories(category_id) {
            if (category_id !== "") {
                $(".sub_category").html('<option>Loading...</option>');
                $.ajax({
                    url: "<?php echo base_url('category/get_sub_categories'); ?>", // Make sure this matches your route
                    method: "POST",
                    data: { category_id: category_id },
                    success: function (response) {
                        $(".sub_category").html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $(".sub_category").html('<option value="">Error loading subcategories</option>');
                    }
                });
            } else {
                $(".sub_category").html('<option value="">Select Sub Category</option>');
            }
        }
    </script>


    <?php $this->load->view('admin/footer'); ?>