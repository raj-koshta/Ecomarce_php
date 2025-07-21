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
    <?php $this->load->view('links'); ?>

</head>

<?php $this->load->view('header'); ?>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Category</h4>
                                    <a href="javascript: void(0);"
                                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                            class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Floating labels</h5>
                                    <p class="card-title-desc">Create beautifully simple form labels that float over
                                        your input fields.</p>

                                    <?= form_open(); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="parent_id" name="parent_id">
                                                        <option value="" selected>Select Parent Category</option>
                                                    </select>
                                                    <label for="parent_id">Parent Category</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="category_name" name="category_name"
                                                        placeholder="Enter Your Category Name">
                                                    <label for="category_name">Category Name</label>
                                                    <?= form_error('category_name')?>
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
                                                    <?= form_error('status')?>
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

    <?php $this->load->view('footer'); ?>