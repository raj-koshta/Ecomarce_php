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
            <?php } ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title"><?= !empty($cate) ? 'Update' : 'Add' ?> Category</h5>
                                    <p class="card-title-desc text-danger">Note: Categories that do not have a parent
                                        category are considered parent categories.</p>
                                    <?php if (!empty($cate)): ?>
                                        <?= form_open_multipart('admin/update-category/' . $cate->category_id); ?>
                                    <?php else: ?>
                                        <?= form_open_multipart('admin/add_category'); ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="parent_id" name="parent_id">
                                                    <option value="" selected>Select Parent Category</option>
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?= $category->category_id ?>" <?= !empty($cate) && $cate->parent_id == $category->category_id ? 'selected' : '' ?>>
                                                            <?= $category->category_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="parent_id">Parent Category</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="category_name"
                                                    name="category_name" placeholder="Enter Your Category Name"
                                                    value="<?= set_value('category_name', !empty($cate) ? $cate->category_name : '') ?>">
                                                <label for="category_name">Category Name</label>
                                                <?= form_error('category_name') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="statusSelect" name="status">
                                                    <option value="" <?= !empty($cate) && $cate->status == '' ? 'selected' : '' ?>>select Status</option>
                                                    <option value="1" <?= !empty($cate) && $cate->status == '1' ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= !empty($cate) && $cate->status == '0' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                                <label for="statusSelect">Status</label>
                                                <?= form_error('status') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" id="image" name="image">
                                                <label for="image">Image</label>
                                                <?= form_error('image') ?>
                                                <?php if (!empty($cate) && !empty($cate->image)): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url('uploads/products/' . $cate->image) ?>"
                                                            alt="Current Banner" class="img-thumbnail"
                                                            style="max-height: 100px;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($cate) && !empty($cate->image)): ?>
                                        <input type="hidden" name="image" value="<?= $cate->image ?>">
                                    <?php endif; ?>

                                    <div>
                                        <button type="submit"
                                            class="btn btn-primary w-md"><?= !empty($cate) ? 'Update' : 'Submit' ?></button>
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

    <?php $this->load->view('admin/footer'); ?>