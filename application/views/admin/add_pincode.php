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
                                    <h4 class="card-title mb-0 flex-grow-1"><?= !empty($pincode) ? 'Update ' : ''?>Pincode</h4>

                                </div>
                                <div class="card-body">
                                    <?php if(!empty($pincode)): ?>
                                        <?= form_open('admin/update_pincode/'.$pincode->id); ?>
                                    <?php else: ?>
                                        <?= form_open('admin/add_pincode'); ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="pincode" name="pincode"
                                                    placeholder="Enter Your Pincode" value="<?= set_value('pincode',!empty($pincode)? $pincode->pincode : '')?>">
                                                <label for="pincode">Pincode</label>
                                                <?= form_error('pincode') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="delivery_charge"
                                                    name="delivery_charge" placeholder="Enter Your Delivery Charges" value="<?= set_value('delivery_charge',!empty($pincode)? $pincode->delivery_charge : '')?>">
                                                <label for="delivery_charge">Delivery Charges</label>
                                                <?= form_error('delivery_charge') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="statusSelect" name="status">
                                                    <option value="">select Status</option>
                                                    <option value="1" <?= !empty($pincode) && $pincode->status =='1' ? 'selected': ''?>>Active</option>
                                                    <option value="0" <?= !empty($pincode) && $pincode->status =='0' ? 'selected': ''?>>Inactive</option>
                                                </select>
                                                <label for="statusSelect">Status</label>
                                                <?= form_error('status') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">
                                            <?= !empty($pincode) ? 'Update' : 'Submit'?>
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