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
                                    <?php if (!empty($product)): ?>
                                        <?= form_open_multipart('admin/update_product/'.$product->product_id); ?>
                                    <?php else: ?>
                                        <?= form_open_multipart('admin/add_product'); ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="product_id"
                                                    name="product_id" placeholder="Enter product name"
                                                    value="<?= set_value('product_id', $product_id) ?>" readonly>
                                                <label for="product_id">Product ID</label>
                                                <?= form_error('product_id') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select category"
                                                    onchange="get_subcategories(this.value)" id="category"
                                                    name="category">
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?= $category->category_id ?>" <?= !empty($product) && $product->category == $category->category_id ? 'selected' : ''?>>
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
                                                    name="product_name" placeholder="Enter product name" 
                                                    value="<?= set_value('product_name', !empty($product) ? $product->product_name : '')?>">
                                                <label for="product_name">Product Name</label>
                                                <?= form_error('product_name') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="brand" name="brand"
                                                    placeholder="Enter product brand"
                                                    value="<?= set_value('brand', !empty($product) ? $product->brand : '')?>">
                                                <label for="brand">Product Brand</label>
                                                <?= form_error('brand') ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="features" name="features">
                                                    <option value="" selected>Select Features</option>
                                                    <option value="1" <?= !empty($product) && $product->features == '1' ? 'selected' : ''?>>Deal of the month</option>
                                                    <option value="2" <?= !empty($product) && $product->features == '2' ? 'selected' : ''?>>New arrivals</option>
                                                </select>
                                                <label for="features">Features</label>
                                                <?= form_error('features') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="highlights"
                                                    id="highlights"><?= !empty($product) ? $product->highlights : ''?></textarea>
                                                <label for="highlights">Highlights</label>
                                                <?= form_error('highlights') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="description"
                                                    id="description"><?= !empty($product) ? $product->description : ''?></textarea>
                                                <label for="description">Description</label>
                                                <?= form_error('description') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    placeholder="Enter product Stock"
                                                    value="<?= set_value('stock', !empty($product) ? $product->stock : '')?>">
                                                <label for="stock">Product Stock</label>
                                                <?= form_error('stock') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="mrp" name="mrp"
                                                    placeholder="Enter product MRP"
                                                    value="<?= set_value('mrp', !empty($product) ? $product->mrp : '')?>">
                                                <label for="mrp">Product MRP</label>
                                                <?= form_error('mrp') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="selling_price"
                                                    name="selling_price" placeholder="Enter product Selling Price"
                                                    value="<?= set_value('selling_price', !empty($product) ? $product->selling_price : '')?>">
                                                <label for="selling_price">Product Selling Price</label>
                                                <?= form_error('selling_price') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_title"
                                                    name="meta_title" placeholder="Enter Meta Title"
                                                    value="<?= set_value('meta_title', !empty($product) ? $product->meta_title : '')?>">
                                                <label for="meta_title">Meta Title</label>
                                                <?= form_error('meta_title') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_keywords"
                                                    name="meta_keywords" placeholder="Enter Meta Keywords"
                                                    value="<?= set_value('meta_keywords', !empty($product) ? $product->meta_keywords : '')?>">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <?= form_error('meta_keywords') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="meta_description"
                                                    name="meta_description" placeholder="Enter Meta Description"
                                                    value="<?= set_value('meta_description', !empty($product) ? $product->meta_description : '')?>">
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
                                                <?php if (!empty($product) && !empty($product->product_main_image)): ?>
                                                    <div class="mt-2 d-inline">
                                                        <img src="<?= base_url('uploads/products/' . $product->product_main_image) ?>"
                                                            alt="Current Banner" class="img-thumbnail"
                                                            style="max-height: 100px;">
                                                    </div>
                                                <?php endif; ?>
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
                                                    <option value="1" <?= !empty($product) && $product->status == '1' ? 'selected' : ''?>>Active</option>
                                                    <option value="0" <?= !empty($product) && $product->status == '0' ? 'selected' : ''?>>Deactive</option>
                                                </select>
                                                <label for="statusSelect">Status</label>
                                                <?= form_error('status') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($product) && !empty($product->product_main_image)): ?>
                                        <input type="hidden" name="product_main_image" value="<?= $product->product_main_image ?>">
                                    <?php endif; ?>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-md"><?= !empty($product) ? "Update" : "Submit"?></button>
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
                    url: "<?php echo base_url('admin/get_sub_categories'); ?>", // Make sure this matches your route
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