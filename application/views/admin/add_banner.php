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
                                    <h4 class="card-title mb-0 flex-grow-1"><?= !empty($banner) ? 'Update' : 'Add' ?>
                                        Banner</h4>
                                    <!-- <a href="javascript: void(0);"
                                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                            class="mdi mdi-arrow-right ms-1"></i></a> -->
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($banner)): ?>
                                        <?= form_open_multipart('admin/update-banner/' . $banner->bann_id); ?>
                                    <?php else: ?>
                                        <?= form_open_multipart('admin/add_banner'); ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Enter Your Category Name"
                                                    value="<?= set_value('title', !empty($banner) ? $banner->title : '') ?>">
                                                <label for="title">Banner Title</label>
                                                <?= form_error('title') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="description"
                                                    name="description" placeholder="Enter Your Category Name"
                                                    value="<?= set_value('description', !empty($banner) ? $banner->description : '') ?>">
                                                <label for="description">Banner description</label>
                                                <?= form_error('description') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" id="bann_image"
                                                    name="bann_image" placeholder="Choose file for banner">
                                                <label for="bann_image">Banner</label>
                                                <?= form_error('bann_image') ?>
                                                <?php if (!empty($banner) && !empty($banner->bann_image)): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url('uploads/banner/' . $banner->bann_image) ?>"
                                                            alt="Current Banner" class="img-thumbnail"
                                                            style="max-height: 100px;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="statusSelect" name="status">
                                                    <option value="" selected>select Status</option>
                                                    <option value="1" <?= !empty($banner) && $banner->status == '1' ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= !empty($banner) && $banner->status == '0' ? 'selected' : '' ?>>Deactive</option>
                                                </select>
                                                <label for="statusSelect">Status</label>
                                                <?= form_error('status') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="bann_image" value="<?= $banner->bann_image?>">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">
                                            <?= !empty($banner) ? 'Update' : 'Submit' ?>
                                        </button>
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